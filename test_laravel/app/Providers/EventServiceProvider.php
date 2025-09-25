<?php

namespace App\Providers;

use App\Jobs\TestJob;
use App\Jobs\ListingCreated;
use Illuminate\Support\Facades\App;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        App::bindMethod(TestJob::class. '@handle', fn($job) => $job->handle());
        App::bindMethod(ListingCreated::class. '@handle', fn($job) => $job->handle());
    }
}
