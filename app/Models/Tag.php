<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    /**
     * A tag belongs to many posts
     *
     * @return BelongsToMany
     */
    public function posts(): BelongsToMany
    {
        return $this->belongsToMany(Post::class)->withTimestamps();
    }

    /**
     * Returns the top 10 tags, i.e. the tags that are associated with the most posts
     *
     * @return Collection
     */
    public static function popular(): Collection
    {
        return self::withCount('posts')->orderByDesc('posts_count')->limit(10)->get();
    }
}
