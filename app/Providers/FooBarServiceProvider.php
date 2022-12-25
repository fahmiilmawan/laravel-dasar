<?php

namespace App\Providers;

use App\Data\Bar;
use App\Data\Foo;
use App\Service\HalloService;
use App\Service\HalloServiceIndonesia;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;

class FooBarServiceProvider extends ServiceProvider implements DeferrableProvider
{
    public array $singletons =[
        HalloService::class => HalloServiceIndonesia::class
    ];
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(Foo::class, function (){
            return new Foo();
        });
        $this->app->singleton(Bar::class, function ($app){
            return new Bar($app->make(Foo::class));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        return [HalloService::class,Foo::class,Bar::class];
    }
}
