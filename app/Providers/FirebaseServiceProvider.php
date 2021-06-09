<?php

namespace App\Providers;

use App\Services\FirebaseService;
use Illuminate\Support\ServiceProvider;
use App\Observers\UserFavouriteObserver;

class FirebaseServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('FirebaseService', function () {
            return new FirebaseService();
        });
    }
}

?>