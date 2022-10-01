<?php

declare(strict_types=1);

namespace App\Http\Containers\MovieContainer\Contracts;

use App\Http\Core\Contracts\QueryBuilderInterface;

interface MovieQueryInterface extends QueryBuilderInterface
{
    public function whereMovieId(int $id): self;

    public function whereMovieName(string $name): self;
}
