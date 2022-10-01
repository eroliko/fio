<?php

declare(strict_types=1);

namespace App\Http\Containers\MovieContainer\Contracts;

use App\Http\Containers\MovieContainer\Models\Movie;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Collection;

interface MovieRepositoryInterface
{
    /** @throws ModelNotFoundException */
    public function get(int $id): Movie;

    public function getAll(): Collection;

    /** @param array<mixed> $data */
    public function create(array $data): Movie;

    public function save(Movie $movie): void;

    public function delete(Movie $movie): void;

    public function query(): MovieQueryInterface;
}
