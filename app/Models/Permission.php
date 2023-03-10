<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Permission extends Model
{
    /**
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        return $this
            ->belongsToMany(Role::class, 'role_permission')
            ->withTimestamps();
    }

    /**
     * A role has many users
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this
            ->belongsToMany(User::class,'user_permission')
            ->withTimestamps();
    }
}
