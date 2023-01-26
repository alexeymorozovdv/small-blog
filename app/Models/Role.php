<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Role extends Model
{
    /**
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        return $this
            ->belongsToMany(Permission::class, 'role_permission')
            ->withTimestamps();
    }

    /**
     * A permission has many users
     *
     * @return BelongsToMany
     */
    public function users(): BelongsToMany
    {
        return $this
            ->belongsToMany(User::class,'user_role')
            ->withTimestamps();
    }
}
