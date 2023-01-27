<?php

namespace App\Providers;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class PermissionServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::directive('perm', function ($perm) {
            return "<?php if(auth()->check() && auth()->user()->hasPermissionAnyWay({$perm})): ?>";
        });
        Blade::directive('endperm', function () {
            return "<?php endif; ?>";
        });

        Blade::directive('allperms', function ($perms) {
            return "<?php if(auth()->check() && auth()->user()->hasAllPermissions({$perms})): ?>";
        });
        Blade::directive('endallperms', function () {
            return "<?php endif; ?>";
        });

        Blade::directive('anyperms', function ($perms) {
            return "<?php if(auth()->check() && auth()->user()->hasAnyPermissions({$perms})): ?>";
        });
        Blade::directive('endanyperms', function () {
            return "<?php endif; ?>";
        });
    }
}
