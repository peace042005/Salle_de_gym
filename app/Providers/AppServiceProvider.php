<?php

namespace App\Providers;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Pagination\Paginator;
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
        Paginator::useBootstrap();

        // Builder::macro('whereLike', function($attributes, string $searchTerm = null) {
        //     foreach(array_wrap($attributes) as $attribute) {
        //        $this->orWhere($attribute, 'LIKE', "%{$searchTerm}%");
        //     }

        //     return $this;
        // });
    }
}
