<?php

declare(strict_types=1);

namespace App\Http\Containers\MovieContainer\Models;

use App\Http\Containers\ActorContainer\Models\Actor;
use App\Http\Core\Models\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Collection;

class Movie extends Model
{
    protected $table = 'movie';

    /**
     * Public attributes constants
     */
    public const ATTR_ID = 'id';

    public const ATTR_NAME = 'name';

    /**
     * Public limits
     */
    public const LIMIT_NAME = 256;

    /**
     * Public relations
     */
    public const RELATION_ACTORS = 'actors';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        self::ATTR_NAME,
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [];

    public function actors(): BelongsToMany
    {
        return $this->belongsToMany(
            Actor::class,
            'actor_movie',
            'movie_id',
            'actor_id',
        )->withPivot(['year', 'age']);
    }

    /** @return Collection<Actor>
     */
    public function getActors(): Collection
    {
        return $this->getRelationValue(self::RELATION_ACTORS);
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
}
