<?php
namespace App;
use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
/**
  * I solved the problem with the "page>2" which add numeric key to the object.
  * Gera a paginação dos itens de um array ou collection.
  * @param array|Collection $items
  * @param int $perPage
  * @param int $page
  * @param array $options
  *
  * @return LengthAwarePaginator
*/  
    class Paginater
    {



            public static function paginateWithoutKey($items, $perPage = 15, $page = null, $options = [])
            {

                $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

                $items = $items instanceof Collection ? $items : Collection::make($items);

            $lap = new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);

            return [
                'current_page' => $lap->currentPage(),
                'data' => $lap ->values(),
                'first_page_url' => $lap ->url(1),
                'from' => $lap->firstItem(),
                'last_page' => $lap->lastPage(),
                'last_page_url' => $lap->url($lap->lastPage()),
                'next_page_url' => $lap->nextPageUrl(),
                'per_page' => $lap->perPage(),
                'prev_page_url' => $lap->previousPageUrl(),
                'to' => $lap->lastItem(),
                'total' => $lap->total(),
            ];
            }
}
?>