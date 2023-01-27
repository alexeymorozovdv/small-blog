<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $with = ['author', 'tags'];

    /**
     * A post belongs to single user (author)
     *
     * @return BelongsTo
     */
    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * A post belongs to many tags
     *
     * @return BelongsToMany
     */
    public function tags(): BelongsToMany
    {
        return $this->belongsToMany(Tag::class)->withTimestamps();
    }

    /**
     * A post belongs to one category
     *
     * @return BelongsTo
     */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * A post has many comments
     *
     * @return HasMany
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Associating the Post model with the Auth model, allows you to get the administrator who allowed the post
     * to be published
     *
     * @return BelongsTo
     */
    public function editor(): BelongsTo
    {
        return $this->belongsTo(User::class, 'published_by');
    }

    /**
     * Select only published posts from the database
     *
     * @param Builder $builder
     * @return Builder
     */
    public function scopePublished(Builder $builder): Builder
    {
        return $builder->whereNotNull('published_by');
    }

    /**
     * Allow post's publication
     *
     * @return void
     */
    public function enable(): void
    {
        $this->published_by = auth()->user()->id;
        $this->update();
    }

    /**
     * Discard post's publication
     *
     * @return void
     */
    public function disable(): void
    {
        $this->published_by = null;
        $this->update();
    }

    /**
     * Returns true if publication is allowed
     *
     * @return bool
     */
    public function isVisible(): bool
    {
        return !is_null($this->published_by);
    }
}
