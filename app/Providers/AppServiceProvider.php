<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Repositories\InterFaces\LoginRepositoryInterFace;
use App\Repositories\Repository\LoginRepository;
use App\Services\LoginService;
use App\Repositories\InterFaces\Api\RegistrationRepositoryInterFace;
use App\Repositories\Repository\Api\RegistrationRepository;
use App\Services\Api\RegistrationService;
use App\Repositories\InterFaces\InstructorRepositoryInterFace;
use App\Repositories\Repository\InstructorRepository;
use App\Services\InstructorService;
use App\Repositories\InterFaces\RegisterRepositoryInterFace;
use App\Repositories\Repository\RegisterRepository;
use App\Services\RegisterService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(LoginRepositoryInterFace::class, LoginRepository::class);
        $this->app->bind(LoginService::class, function ($app) {
            return new LoginService($app->make(LoginRepositoryInterFace::class));
        });
        $this->app->bind(RegistrationRepositoryInterFace::class, RegistrationRepository::class);
        $this->app->bind(RegistrationService::class, function ($app) {
            return new RegistrationService($app->make(RegistrationRepositoryInterFace::class));
        });
        $this->app->bind(InstructorRepositoryInterFace::class, InstructorRepository::class);
        $this->app->bind(InstructorService::class, function ($app) {
            return new InstructorService($app->make(InstructorRepositoryInterFace::class));
        });

        $this->app->bind( RegisterRepositoryInterFace::class, RegisterRepository::class);
        $this->app->bind(RegisterService::class, function ($app) {
            return new RegisterService($app->make(RegisterRepositoryInterFace::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
