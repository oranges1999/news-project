<?php

namespace App\Providers;

use App\Http\Resources\TagsResource;
use App\Models\Categories;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        view()->composer('user.*', function ($view) {
            $view->with('categories',
                Categories::all());
        });

        TagsResource::withoutWrapping();
    }
}
