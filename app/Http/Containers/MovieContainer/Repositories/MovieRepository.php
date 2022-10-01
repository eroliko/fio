<?php

declare(strict_types=1);

namespace App\Http\Containers\MovieContainer\Repositories;

use App\Http\Containers\MovieContainer\Contracts\MovieQueryInterface;
use App\Http\Containers\MovieContainer\Contracts\MovieRepositoryInterface;
use App\Http\Containers\MovieContainer\Models\Movie;
use App\Http\Containers\MovieContainer\Queries\MovieQueryBuilder;
use Illuminate\Support\Collection;

final class MovieRepository implements MovieRepositoryInterface
{
    /**
     * @inheritDoc
     */
    public function get(int $id): Movie
    {
        /** @var Movie $movie */
        $movie = $this->query()->getById($id);
        return $movie;
    }

    /** @inheritDoc */
    public function getOrCreate(int $id, array $columns): Movie
    {
        /** @var Movie $movie */
        $movie = $this->query()->getFirstOrCreate($id, $columns);
        return $movie;
    }

    public function getAll(): Collection
    {
        return $this->query()->getAll();
    }

    public function create(array $data): Movie
    {
        $movie = new Movie();
        $movie->compactFill($data);
        $this->save($movie);

        return $movie;
    }

    public function save(Movie $movie): void
    {
        $movie->save();
    }

    public function delete(Movie $movie): void
    {
        $movie->delete();
    }

    public function query(): MovieQueryInterface
    {
        return new MovieQueryBuilder();
    }
}
