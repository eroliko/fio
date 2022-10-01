<?php

declare(strict_types=1);

namespace App\Http\Containers\ActorContainer\Repositories;

use App\Http\Containers\ActorContainer\Contracts\ActorQueryInterface;
use App\Http\Containers\ActorContainer\Contracts\ActorRepositoryInterface;
use App\Http\Containers\ActorContainer\Models\Actor;
use App\Http\Containers\ActorContainer\Queries\ActorQueryBuilder;
use Illuminate\Support\Collection;

final class ActorRepository implements ActorRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function get(int $id): Actor
    {
        /** @var Actor $actor */
        $actor = $this->query()->getById($id);
        return $actor;
    }

    public function getAll(): Collection
    {
        return $this->query()->getAll();
    }

    public function create(array $data): Actor
    {
        $actor = new Actor();
        $actor->compactFill($data);
        $this->save($actor);

        return $actor;
    }

    public function save(Actor $actor): void
    {
        $actor->save();
    }

    public function delete(Actor $actor): void
    {
        $actor->delete();
    }

    public function query(): ActorQueryInterface
    {
        return new ActorQueryBuilder();
    }
}
