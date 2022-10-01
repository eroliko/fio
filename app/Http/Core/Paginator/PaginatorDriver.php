<?php

declare(strict_types=1);

namespace App\Http\Core\Paginator;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

interface PaginatorDriver
{
    /**
     * @param Builder $queryBuilder
     * @param Request $request
     * @return array
     */
    public function run(Builder $queryBuilder, Request $request): array;
}