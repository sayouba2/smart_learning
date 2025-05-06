<?php

namespace App\Providers;

use App\Models\Course;
use App\Policies\EnrollmentPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Course::class => EnrollmentPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
