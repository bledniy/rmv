<?php

namespace Database\Seeders;

use App\Enum\SliderTypeEnum;
use App\Models\Slider\Slider;
use App\Repositories\SliderRepository;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\Request;

class SliderTableSeeder extends AbstractSeeder
{
	use WithFaker;
	private $sliderRepository;

	public function __construct(SliderRepository $sliderRepository)
	{
		$this->setUpFaker();
		$this->sliderRepository = $sliderRepository;
		$this->reguard();
	}

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$slider = new Slider();
		$slider->fill(['key' => SliderTypeEnum::MAIN_PAGE, 'comment' => 'Слайдер на главной странице']);
		$request = new Request();//капец костыляра, legacy при чем не subaru
		$this->sliderRepository->save($request, $slider);
		$this->sliderRepository->storeSlideItem($request, $slider);
		foreach ($slider->getSlides() as $slide) {
			$slide->setAttribute('src', $this->image($this->faker->imageUrl(1920, 1080)));
			$slide->save();//тоже костыль
		}
	}
}
