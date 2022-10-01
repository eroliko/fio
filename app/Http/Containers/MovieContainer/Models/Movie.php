<?php

declare(strict_types=1);

namespace App\Http\Containers\MovieContainer\Models;

use App\Http\Core\Models\Model;

class Movie extends Model
{
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
