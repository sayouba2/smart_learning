<?php

namespace App\Providers;
use Illuminate\Support\Facades\Route;
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
    public function boot()
    {
        
        // Configuration des routes
        Route::middleware('web')
            ->group(base_path('routes/web.php'));
            
        Route::prefix('teacher')
            ->middleware(['auth', 'role:teacher'])
            ->group(base_path('routes/teacher.php'));
            
        // Si vous avez un fichier admin.php
        Route::prefix('admin')
            ->middleware(['auth', 'role:admin'])
            ->group(base_path('routes/admin.php'));
    }
}
