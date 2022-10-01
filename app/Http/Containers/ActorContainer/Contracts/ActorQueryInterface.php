<?php

declare(strict_types=1);

namespace App\Http\Containers\ActorContainer\Contracts;

use App\Http\Core\Contracts\QueryBuilderInterface;

interface ActorQueryInterface extends QueryBuilderInterface
{
    public function whereActorId(int $id): self;

    public function whereActorName(string $name): self;

    public function whereActorAge(int $age): self;

    public function whereActorGender(int $gender): self;
}
