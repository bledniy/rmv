<?php

namespace App\Repositories;

use App\Criteria\ActiveCriteria;
use App\Criteria\SortCriteria;
use App\DataContainers\Page\PageSearchRequest;
use App\Models\Page\Page;
use App\Models\Page\PageLang;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class PageRepository extends AbstractRepository
{
    public function model()
    {
        return Page::class;
    }

    public function modelLang()
    {
        return PageLang::class;
    }


    public function addAdminCriteriaToQuery()
    {
        $this->pushCriteria($this->app->make(SortCriteria::class));
    }

    protected function addPublicCriteriaToQuery(): self
    {
        $this->pushCriteria($this->app->make(SortCriteria::class));
        $this->pushCriteria($this->app->make(ActiveCriteria::class));

        return $this;
    }

    public function getListPublic(): ?Collection
    {
        $this->addPublicCriteriaToQuery();

        return $this->with('lang')->get();
    }

    public function getForAdmin($pageId = []): ?Collection
    {
        $this->addAdminCriteriaToQuery();
        $query = $this->with('lang');
        if ($pageId) {
            $query->whereNotIn('id', [$pageId]);
        }

        return $query->get();
    }

    public function getListAdmin(PageSearchRequest $request): LengthAwarePaginator
    {
        $this->addAdminCriteriaToQuery();
        $query = $this->with('lang')->latest();
        if ($request->getSearch()) {
            $search = $request->getSearch();
            $query->join('pages_lang', 'page_id', 'id');
            $query->where(static function (Builder $builder) use ($search) {
                $builder->where('title', 'like', '%' . $search . '%')
                    ->orWhere('url', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%')
                ;
            });
        }

        return $query->paginate();
    }

    public function findPageByUrl($url): ?Page
    {
        return $this->findPageByColumn('url', $url);
    }


    public function findPageByPageType(string $type): ?Page
    {
        return $this->findPageByColumn('page_type', $type);
    }

    public function findPageByColumn(string $attribute, string $value): ?Page
    {
        $this->addPublicCriteriaToQuery();

        return $this->where($attribute, $value)->with('lang')->first();
    }

    public function findManualPageByUrl(string $url): ?Page
    {
        return $this->findPageByUrl($url);
    }

    public function getPageParents(Page $page): Collection
    {
        $parents = collect([]);
        if ($page->parent) {
            $parent = $page->parent;
            $parents->push($parent);
            while ($parent->parent !== null) {
                $parents->push($parent->parent);
                $parent = $parent->parent;
            }
        }

        return $parents->reverse();
    }

}
