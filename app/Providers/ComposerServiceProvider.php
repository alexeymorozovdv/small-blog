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
        $views = [
            'layout.sidebar._categories',
            'admin.part._categories',
            'admin.part._parent',
            'admin.part._all-tags',
        ];

        View::composer($views, function($view) {
            static $items = null;
            if (is_null($items)) {
                $items = Category::all();
            }

            $view->with(['items' => $items]);
        });

        View::composer('admin.part._all-tags', function($view) {
            $view->with(['items' => Tag::all()]);
        });
        View::composer('layout.sidebar._popular-tags', function($view) {
            $view->with(['items' => Tag::popular()]);
        });
    }
}
