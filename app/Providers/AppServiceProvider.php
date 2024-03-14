<?php

namespace App\Providers;

use App\Interface\UserServiceInterface;
use App\Services\UserService;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserServiceInterface::class, UserService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Response::macro('success', function ($data = null, $message = null, $code = 200, $extraData = []) {
            return Response::json(array_merge([
                'success' => true,
                'data' => $data,
                'message' => $message,
            ], $extraData), $code);
        });

        Response::macro('error', function ($data = null, $message = null, $code = 400, $extraData = []) {
            return Response::json(array_merge([
                'success' => false,
                'data' => $data,
                'message' => $message,
            ], $extraData), $code);
        });
    }
}
