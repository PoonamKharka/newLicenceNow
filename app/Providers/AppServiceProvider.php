<?php

namespace App\Providers;


use App\Services\FaqService;
use App\Services\LoginService;
use App\Services\AboutUsService;
use App\Services\LearnerService;
use App\Services\RegisterService;
use App\Services\InstructorService;
use App\Services\PaymentPolicyService;
use Illuminate\Support\ServiceProvider;
use App\Services\Api\RegistrationService;
use App\Repositories\Repository\FaqRepository;
use App\Repositories\Repository\LoginRepository;
use App\Repositories\Repository\AboutUsRepository;
use App\Repositories\Repository\LearnerRepository;
use App\Repositories\Repository\RegisterRepository;
use App\Repositories\Repository\InstructorRepository;
use App\Repositories\InterFaces\FaqRepositoryInterface;
use App\Repositories\Repository\PaymentPolicyRepository;
use App\Repositories\InterFaces\LoginRepositoryInterFace;
use App\Repositories\InterFaces\AboutUsRepositoryInterface;
use App\Repositories\InterFaces\LearnerRepositoryInterface;
use App\Repositories\Repository\Api\RegistrationRepository;
use App\Repositories\InterFaces\RegisterRepositoryInterFace;
use App\Repositories\InterFaces\InstructorRepositoryInterFace;
use App\Repositories\InterFaces\PaymentPolicyRepositoryInterface;
use App\Repositories\InterFaces\Api\RegistrationRepositoryInterFace;
use Laravel\Passport\Passport;
use App\Repositories\InterFaces\LocationRepositoryInterface;
use App\Repositories\Repository\LocationRepository;
use App\Services\LocationService;
use App\Repositories\InterFaces\LessonRepositoryInterface;
use App\Repositories\Repository\LessonRepository;
use App\Services\LessonService;
use App\Repositories\InterFaces\PricingRepositoryInterface;
use App\Repositories\Repository\PricingRepository;
use App\Services\PricingService;

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

        $this->app->bind(LearnerRepositoryInterface::class, LearnerRepository::class);
        $this->app->bind(LearnerService::class, function($app){
            return new LearnerService($app->make(LearnerRepositoryInterface::class));
        });

        $this->app->bind(FaqRepositoryInterface::class, FaqRepository::class);
        $this->app->bind(FaqService::class, function($app){
            return new FaqService($app->make(FaqRepositoryInterface::class));
        });

        $this->app->bind(AboutUsRepositoryInterface::class, AboutUsRepository::class);
        $this->app->bind(AboutUsService::class, function($app){
            return new AboutUsService($app->make(AboutUsRepositoryInterface::class));
        } );

        $this->app->bind(PaymentPolicyRepositoryInterface::class, PaymentPolicyRepository::class);
        $this->app->bind(PaymentPolicyService::class, function($app){
            return new PaymentPolicyService($app->make(PaymentPolicyRepositoryInterface::class));
        });

        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);
        $this->app->bind(LocationService::class, function($app){
            return new LocationService($app->make(LocationRepositoryInterface::class));
        });

        $this->app->bind(LessonRepositoryInterface::class, LessonRepository::class);
        $this->app->bind(LessonService::class, function($app){
            return new LessonService($app->make(LessonRepositoryInterface::class));
        });

        $this->app->bind(PricingRepositoryInterface::class, PricingRepository::class);
        $this->app->bind(PricingService::class, function($app){
            return new PricingService($app->make(PricingRepositoryInterface::class));
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Passport::enablePasswordGrant();
    }
}
