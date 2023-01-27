<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    public const PARENT_ID_COLUMN = 'parent_id';

    use HasFactory;

    /**
     * A category has many posts
     *
     * @return HasMany
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Returns a collection with root categories
     *
     * @return Collection
     */
    public static function roots(): Collection
    {
        return self::where(self::PARENT_ID_COLUMN, 0)->get();
    }
}
