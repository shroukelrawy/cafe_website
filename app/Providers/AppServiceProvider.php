<?php

namespace App\Providers;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\ContactMessage;

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
    public function boot()
    {
        View::composer('*', function ($view) {
            $unreadMessages = ContactMessage::where('is_read', false)->get();
            $unreadCount = $unreadMessages->count();
    
            $view->with('unreadCount', $unreadCount)
                 ->with('unreadMessages', $unreadMessages);
        });
    }
}
