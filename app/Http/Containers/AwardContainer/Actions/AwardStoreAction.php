<?php

declare(strict_types=1);

namespace App\Http\Containers\AwardContainer\Actions;

use App\Http\Containers\ActorContainer\Contracts\ActorRepositoryInterface;
use App\Http\Containers\ActorContainer\Models\Actor;
use App\Http\Containers\AwardContainer\RequestFilters\AwardRequestFilter;
use App\Http\Containers\MovieContainer\Contracts\MovieRepositoryInterface;
use App\Http\Containers\MovieContainer\Models\Movie;
use App\Http\Core\Actions\Action;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;
use Illuminate\Validation\ValidationException;

class AwardStoreAction extends Action
{
    public const CSV_YEAR = 1;

    public const CSV_AGE = 2;

    public const CSV_NAME = 3;

    public const CSV_MOVIE = 4;

    public function __construct(
        private readonly ActorRepositoryInterface $actorRepository,
        private readonly MovieRepositoryInterface $movieRepository,
        private readonly AwardRequestFilter $awardRequestFilter,
    ) {
    }

    /**
     * @throws ValidationException
     */
    public function run(Request $request)
    {
        $data = $this->awardRequestFilter->getValidatedData($request);

        $csvData = $this->parseCsv($data[AwardRequestFilter::FIELD_FILE]);

        foreach ($csvData as $row) {
            // Filter out invalid rows
            if (empty($row[0])) {
                continue;
            }

            /** @var ?Actor $actor */
            $actor = $this->actorRepository->query()->whereActorName($row[self::CSV_NAME])->getFirst();
            if ($actor === null) {
                $actor = $this->actorRepository->create([
                    Actor::ATTR_GENDER => (int) $data[AwardRequestFilter::FIELD_GENDER],
                    Actor::ATTR_NAME => $row[self::CSV_NAME],
                    Actor::ATTR_AGE => $row[self::CSV_AGE],
                ]);
            }

            /** @var ?Movie $movie */
            $movie = $this->movieRepository->query()->whereMovieName($row[self::CSV_MOVIE])->getFirst();
            if ($movie === null) {
                $movie = $this->movieRepository->create([
                    Movie::ATTR_NAME => $row[self::CSV_MOVIE],
                ]);
            }

            $actor->movies()->syncWithPivotValues($movie, ['year' => $row[self::CSV_YEAR]], false);
        }
    }

    /** @return array<array<string>> */
    private function parseCsv(UploadedFile $file, $delimiter = ','): array
    {
        $filePath = \tempnam(\sys_get_temp_dir(), 'csvFile');
        \file_put_contents($filePath, $file->getContent());

        $file = \fopen($filePath, 'r');

        $lines = [];
        while (!\feof($file)) {
            $line = \fgetcsv($file, 0, $delimiter);
            if ($line) {
                $lines[] = $line;
            }
        }

        \fclose($file);

        \array_shift($lines);

        return $lines;
    }
}
