<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
     * Associating the Category model with the Category model, allows you to get all child categories of the
     * current category
     *
     * @return HasMany
     */
    public function children(): HasMany
    {
        return $this->hasMany(Category::class, self::PARENT_ID_COLUMN);
    }

    /**
     * Linking the Category model to the Category model, allows you to get the parent of the current category
     *
     * @return BelongsTo
     */
    public function parent(): BelongsTo
    {
        return $this->belongsTo(Category::class, self::PARENT_ID_COLUMN);
    }

    /**
     * Returns a collection with root categories
     *
     * @return Collection
     */
    public static function roots(): Collection
    {
        return self::where(self::PARENT_ID_COLUMN, 0)->with('children')->get();
    }
}
