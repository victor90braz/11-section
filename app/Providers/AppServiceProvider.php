<?php

namespace App\Providers;

// use App\Services\ConvertKitNewsletter;
use App\Services\MailchimpNewsletter;
use App\Services\Newsletter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\ServiceProvider;
use MailchimpMarketing\ApiClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        app()->bind(Newsletter::class, function () {

            $client = (new ApiClient)->setConfig([
                'apiKey' => config('services.mailchimp.key'),
                'server' => 'us21',
            ]);

            return new MailchimpNewsletter($client);
            // return new ConvertKitNewsletter();

        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        /*
        Paginator::useBootstrap()
        Paginator::useBootstrapThree()
        Paginator::useTailwind()
        */

        Model::unguard();
    }
}
