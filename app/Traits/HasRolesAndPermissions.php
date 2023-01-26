<?php

namespace App\Traits;

use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait HasRolesAndPermissions
{
    /**
     * A user belongs to many roles
     *
     * @return BelongsToMany
     */
    public function roles(): BelongsToMany
    {
        /** @var User $this */
        return $this
            ->belongsToMany(Role::class, 'user_role')
            ->withTimestamps();
    }

    /**
     * A user belongs to many permissions
     *
     * @return BelongsToMany
     */
    public function permissions(): BelongsToMany
    {
        /** @var User $this */
        return $this
            ->belongsToMany(Permission::class, 'user_permission')
            ->withTimestamps();
    }

    /**
     * Does user have a specific role
     *
     * @param string $role
     * @return bool
     */
    public function hasRole(string $role): bool
    {
        /** @var User $this */
        return $this->roles->contains('slug', $role);
    }

    /**
     * Does user have a specific permission
     *
     * @param string $permission
     * @return bool
     */
    public function hasPermission(string $permission): bool
    {
        /** @var User $this */
        return $this->permissions->contains('slug', $permission);
    }

    /**
     * Does a user have a permission via one of his roles
     *
     * @param string $permission
     * @return bool
     */
    public function hasPermissionViaRoles(string $permission): bool
    {
        /** @var User $this */
        foreach ($this->roles as $role) {
            if ($role->permissions->contains('slug', $permission)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Does a user have a permission directly or via one of his roles
     *
     * @param $permission
     * @return bool
     */
    public function hasPermissionAnyWay($permission) : bool
    {
        /** @var User $this */
        return $this->hasPermissionViaRoles($permission) || $this->hasPermission($permission);
    }

    /**
     * Does the current user have all the rights from $permissions either directly, or through one of his roles
     *
     * @param ...$permissions
     * @return bool
     */
    public function hasAllPermissions(...$permissions): bool
    {
        /** @var User $this */
        foreach ($permissions as $permission) {
            $condition = $this->hasPermissionViaRoles($permission) || $this->hasPermission($permission);
            if ( ! $condition) {
                return false;
            }
        }

        return true;
    }

    /**
     * Does the current user have any rights from $permissions either directly, or through one of his roles
     *
     * @param ...$permissions
     * @return bool
     */
    public function hasAnyPermissions(...$permissions): bool
    {
        /** @var User $this */
        foreach ($permissions as $permission) {
            if ($this->hasPermissionViaRoles($permission) || $this->hasPermission($permission)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Return an array with all user's roles
     *
     * @return array
     */
    public function getAllPermissions(): array
    {
        return $this->permissions->pluck('slug')->toArray();
    }

    /**
     * Returns an array of all permissions of the current user, which he has through his roles
     *
     * @return array
     */
    public function getAllPermissionsViaRoles(): array
    {
        $permissions = [];
        foreach ($this->roles as $role) {
            $perms = $role->permissions;
            foreach ($perms as $perm) {
                $permissions[] = $perm->slug;
            }
        }

        return array_values(array_unique($permissions));
    }

    /**
     * Returns an array of all permissions of the current user, either directly or through one of their roles
     *
     * @return array
     */
    public function getAllPermissionsAnyWay(): array
    {
        $perms = array_merge(
            $this->getAllPermissions(),
            $this->getAllPermissionsViaRoles()
        );

        return array_values(array_unique($perms));
    }

    /**
     * Returns an array with all user's roles
     *
     * @return array
     */
    public function getAllRoles(): array
    {
        return $this->roles->pluck('slug')->toArray();
    }
}
