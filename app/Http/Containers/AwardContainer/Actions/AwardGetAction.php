<?php

declare(strict_types=1);

namespace App\Http\Containers\AwardContainer\Actions;

use App\Http\Containers\ActorContainer\Contracts\ActorRepositoryInterface;
use App\Http\Containers\ActorContainer\Models\Actor;
use App\Http\Containers\MovieContainer\Contracts\MovieRepositoryInterface;
use App\Http\Containers\MovieContainer\Models\Movie;
use App\Http\Core\Actions\Action;
use App\Http\Core\Mappers\GenderMapper;
use App\Http\Core\Paginator\PaginatorDriver;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;

class AwardGetAction extends Action
{
    public function __construct(
        private readonly MovieRepositoryInterface $movieRepository,
        private readonly ActorRepositoryInterface $actorRepository,
        private readonly PaginatorDriver $paginator,
    ) {
    }

    public function getSharedAwards(Request $request): LengthAwarePaginator
    {
        return $this->paginator->run(
            $this->movieRepository->query()->sharedAwardsOrderByName(),
            $request,
        );
    }

    /** @return array<mixed> */
    public function getGroupedByYear(): array
    {
        return $this->groupYears(
            $this->actorRepository->query()->allSortedByYear()->get(),
        );
    }

    /**
     * @param Collection<Actor> $actors
     * @return array<mixed>
     */
    private function groupYears(Collection $actors): array
    {
        $groups = [];
        foreach ($actors as $actor) {
            /** @var Movie $movie */
            foreach ($actor->getMovies() as $movie) {
                $year = $movie->pivot->year;
                if (!isset($groups[$year])) {
                    $groups[$year] = [
                        GenderMapper::GENDER_MALE => [],
                        GenderMapper::GENDER_FEMALE => [],
                    ];
                }

                if ($actor->getRawGender() === GenderMapper::GENDER_MALE) {
                    $groups[$year][GenderMapper::GENDER_MALE][] = [
                        'movie' => $movie->getName(),
                        'age' => $movie->pivot->age,
                        'actor' => $actor->getName(),
                    ];
                } else {
                    $groups[$year][GenderMapper::GENDER_FEMALE][] = [
                        'movie' => $movie->getName(),
                        'age' => $movie->pivot->age,
                        'actor' => $actor->getName(),
                    ];
                }
            }
        }

        return $groups;
    }
}
