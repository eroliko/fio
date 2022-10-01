<?php

declare(strict_types=1);

namespace App\Http\Containers\PaginationContainer;

use App\Http\Core\Paginator\PaginationClass;
use App\Http\Core\Paginator\PaginatorDriver;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

final class PaginationService extends PaginationClass implements PaginatorDriver
{
    /**
     * @param \Illuminate\Database\Eloquent\Builder $queryBuilder
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function run(Builder $queryBuilder, Request $request): array
    {
        $pageItems = !empty($request->input('limit')) ? ((int)$request->input('limit')) : 10;
        $page = !empty($request->input('page')) ? ((int)$request->input('page')) : 1;

        $result = $queryBuilder->paginate(
            $pageItems,
            page: $page
        );

        return [
            'data' => $result->items(),
            'pages' => $result->lastPage()
        ];
    }
}