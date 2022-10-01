<?php

declare(strict_types=1);

namespace App\Http\Containers\ActorContainer\Contracts;

use App\Http\Containers\ActorContainer\Models\Actor;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

interface ActorRepositoryInterface
{
    /** @throws ModelNotFoundException */
    public function get(int $id): Actor;

    public function getAll(): Collection;

    /** @param array<mixed> $data */
    public function create(array $data): Actor;

    public function save(Actor $actor): void;

    public function delete(Actor $actor): void;

    public function query(): ActorQueryInterface;
}
