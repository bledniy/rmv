<?php


namespace App\Repositories;

use App\Helpers\Media\ImageSaver;
use App\Models\Slider\Slider;
use App\Models\Slider\SliderItem;
use App\Models\Slider\SliderItemLang;
use App\Scopes\SortOrderScope;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

/**
 * Class MetaRepository.
 */
class SliderRepository extends AbstractRepository
{
    /**
     * @return string
     *  Return the model
     */
    public function model()
    {
        return Slider::class;
    }

    public function findForEdit(int $id): ?Slider
    {
        $this->with([
            'items' => function (HasMany $q) {
                $q->withGlobalScope('sort', new SortOrderScope);
            }, 'items.lang',
        ]);

        return $this->whereId($id)->first();
    }

    public function findForDisplayByKey(string $key): ?Slider
    {
        $this->with([
            'items' => function (HasMany $q) {
                $q->withGlobalScope('sort', new SortOrderScope);
            }, 'items.lang',
        ]);

        return $this->where('key', $key)->first();
    }

    public function storeSlideItem(Request $request, Slider $slider): bool
    {
        $sliderItem = new SliderItem;
        $inputItem = $request->input(inputNamesManager($sliderItem)->getNameInputRequest(), []);

        $sliderItem->setSlider($slider);
        $result = $sliderItem->fill($inputItem)->save();
        foreach ($this->getLanguagesList() as $language) {
            $sliderItemLang = new SliderItemLang;
            $inputItemLang = $request->input(inputNamesManager($sliderItemLang)->getNameInputRequest(), []);
            $sliderItemLang->fillExisting($inputItemLang);
            $sliderItemLang->sliderItem()->associate($sliderItem);
            $sliderItemLang->associateWithLanguage($language);
            $sliderItemLang->save();
        }

        return $result;
    }

    public function getListForAdmin()
    {
        return $this->paginate();
    }

    public function save(Request $request, Slider $slider)
    {
        $sliderItem = new SliderItem;
        $input = $request->input(inputNamesManager($slider)->getNameInputRequest());
        $input['active'] = $request->input(inputNamesManager($slider)->getNameInputRequestByKey('active'), 0);
        $slider->fillExisting($input);
        if ($result = $slider->save()) {
            if ($slider->wasRecentlyCreated) {
                $this->storeSlideItem($request, $slider);
            } else if ($request->has($sliderItem->getTable())) {
                /** @var  $sliderItem SliderItem */
                foreach ($slider->items as $sliderItem) {
                    $itemKey = inputNamesManager($sliderItem)->getNameInputRequest();
                    if ($input = $request->input($itemKey)) {
                        $input['active'] = $request->input(inputNamesManager($sliderItem)->getNameInputRequestByKey('active'), 0);
                        if ($request->hasFile(inputNamesManager($sliderItem)->getNameInputRequestByKey('src'))) {
                            $input['src'] = (new ImageSaver($request, inputNamesManager($sliderItem)->getNameInputRequestByKey('src'),
                                $sliderItem->getTable()))
                                ->setWithThumbnail(false)
                                ->saveFromRequest()
                            ;
                        }
                        $sliderItem->fillExisting($input);
                        $sliderItem->save();
                        /** @var  $sliderItemLang SliderItemLang */
                        if ($sliderItemLang = $sliderItem->lang) {
                            $inputLang = $request->input(inputNamesManager($sliderItemLang)->getNameInputRequest(), []);
                            $sliderItem->lang->fillExisting($inputLang)->save();
                        }
                    }
                }
            }
        }

        return $result;
    }

}
