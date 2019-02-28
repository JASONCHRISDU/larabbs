<?php

namespace App\Providers;

use App\Observers\UserObserver;
use App\Observers\TopicObserver;
use App\Models\User;
use App\Models\Topic;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        \Carbon\Carbon::setLocale('zh');
        User::observe(UserObserver::class);        
        Topic::observe(TopicObserver::class);        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

