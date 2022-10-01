<?php

declare(strict_types=1);

namespace App\Http\Containers\ActorContainer\Models;

use App\Http\Containers\CastTypeEnums\GeneralVarsCastEnums;
use App\Http\Containers\MovieContainer\Models\Movie;
use App\Http\Core\Helpers\GenderMapper;
use App\Http\Core\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

class Actor extends Model
{
    /**
     * Public attributes constants
     */
    public const ATTR_ID = 'id';

    public const ATTR_NAME = 'name';

    public const ATTR_AGE = 'age';

    public const ATTR_GENDER = 'gender';

    /**
     * Public limits
     */
    public const LIMIT_NAME = 256;

    /**
     * Public relations
     */
    public const RELATION_MOVIES = 'movies';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::ATTR_NAME,
        self::ATTR_AGE,
        self::ATTR_GENDER,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        self::ATTR_AGE => GeneralVarsCastEnums::INT,
        self::ATTR_GENDER => GeneralVarsCastEnums::INT,
    ];

    public function movies(): BelongsToMany
    {
        return $this->belongsToMany(
            Movie::class,
            'actor_movie',
            'movie_id',
            'actor_id',
        );
    }

    public function getMovies(): Collection
    {
        return $this->getRelationValue(self::RELATION_MOVIES);
    }

    /**
     * Fill model with compact data.
     *
     * @param array<mixed> $data
     */
    public function compactFill(array $data): void
    {
        $this->fill($data);
    }

    public function getName(): string
    {
        return $this->getAttributeValue(self::ATTR_NAME);
    }

    public function getAge(): int
    {
        return $this->getAttributeValue(self::ATTR_AGE);
    }

    public function getGender(): string
    {
        return (new GenderMapper())->getGender($this->getAttributeValue(self::ATTR_GENDER));
    }
}
