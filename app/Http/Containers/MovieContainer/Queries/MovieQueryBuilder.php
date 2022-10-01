<?php

declare(strict_types=1);

namespace App\Http\Containers\MovieContainer\Queries;

use App\Http\Containers\MovieContainer\Contracts\MovieQueryInterface;
use App\Http\Containers\MovieContainer\Models\Movie;
use App\Http\Core\Queries\QueryBuilder;

final class MovieQueryBuilder extends QueryBuilder implements MovieQueryInterface
{
    /**
     * Sets correct model
     */
    public function __construct()
    {
        $model = new Movie();
        $model->registerGlobalScopes($this);
        parent::__construct($model);
    }

    public function whereMovieId(int $id): MovieQueryInterface
    {
        return $this->where(Movie::ATTR_ID, '=', $id);
    }

    public function whereMovieName(string $name): MovieQueryInterface
    {
        return $this->where(Movie::ATTR_NAME, '=', $name);
    }
}
