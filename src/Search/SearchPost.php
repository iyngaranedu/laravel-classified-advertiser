<?php


namespace Iyngaran\Advertiser\Search;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Iyngaran\Advertiser\Models\Post;

class SearchPost extends Search
{
    public function getResults(FormRequest $filters)
    {
        return $this->apply($filters)->get();
    }

    public function getPaginatedResults(FormRequest $filters): ?LengthAwarePaginator
    {
        $currentPage = $filters->input('page');
        $reqPerPage = $filters->input('per-page');
        $reqSortBy = $filters->input('sort-by');
        $reqSortOrder = $filters->input('order');

        if (! $reqPerPage) {
            $reqPerPage = config('classified-advertiser.defaults.per-page');
        }

        if (! $reqSortBy) {
            $reqSortBy = config('classified-advertiser.defaults.order-by');
        }

        if (! $reqSortOrder) {
            $reqSortOrder = config('classified-advertiser.defaults.order-in');
        }


        Paginator::currentPageResolver(
            function () use ($currentPage) {
                return $currentPage;
            }
        );

        return $this->apply($filters, new Post())
            ->orderBy($reqSortBy, $reqSortOrder)
            ->paginate($reqPerPage);
    }
}
