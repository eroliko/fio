<?php

declare(strict_types=1);

namespace App\Http\Containers\ActorContainer\Queries;

use App\Http\Containers\ActorContainer\Contracts\ActorQueryInterface;
use App\Http\Containers\ActorContainer\Models\Actor;
use App\Http\Core\Queries\QueryBuilder;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class ActorQueryBuilder extends QueryBuilder implements ActorQueryInterface
{
    /**
     * Sets correct model
     */
    public function __construct()
    {
        $model = new Actor();
        $model->registerGlobalScopes($this);
        parent::__construct($model);
    }

    public function whereActorId(int $id): ActorQueryInterface
    {
        return $this->where(Actor::ATTR_ID, '=', $id);
    }

    public function whereActorName(string $name): ActorQueryInterface
    {
        return $this->where(Actor::ATTR_NAME, '=', $name);
    }

    public function whereActorGender(int $gender): ActorQueryInterface
    {
        return $this->where(Actor::ATTR_GENDER, '=', $gender);
    }

    public function allSortedByYear(): ActorQueryInterface
    {
        return $this
            ->with([Actor::RELATION_MOVIES => function (BelongsToMany $builder) {
                $builder->orderBy('pivot_year');
            }])
        ;
    }
}
