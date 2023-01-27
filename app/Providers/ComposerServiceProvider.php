<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Tag;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
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
        View::composer('layout.sidebar._categories', function($view) {
            $view->with(['items' => Category::roots()]);
        });
        View::composer('layout.sidebar._popular-tags', function($view) {
            $view->with(['items' => Tag::popular()]);
        });
    }
}
