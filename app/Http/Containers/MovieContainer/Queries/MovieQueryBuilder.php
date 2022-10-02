<?php

declare(strict_types=1);

namespace App\Http\Containers\MovieContainer\Queries;

use App\Http\Containers\ActorContainer\Models\Actor;
use App\Http\Containers\MovieContainer\Contracts\MovieQueryInterface;
use App\Http\Containers\MovieContainer\Models\Movie;
use App\Http\Core\Queries\QueryBuilder;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function allSortedByYear(): MovieQueryInterface
    {
        return $this
            ->with([Movie::RELATION_ACTORS => function (BelongsToMany $builder) {
                $builder->orderBy('pivot_year');
            }])
        ;
    }

    public function sharedAwardsOrderByName(): MovieQueryInterface
    {
        return $this->
            whereHas(Movie::RELATION_ACTORS, function (Builder $queryBuilder) {
                $queryBuilder
                    ->havingRaw('count(' . Actor::ATTR_GENDER . ') > ?', [1]);
            })
            ->with(Movie::RELATION_ACTORS)
            ->orderBy(Movie::ATTR_NAME)
        ;
    }
}
