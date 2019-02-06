<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Support\Facades\Hash;
use Tests\Traits\InteractsWithTenancy;

abstract class TenantTestCase extends TestCase
{
    use InteractsWithTenancy;

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {
        $app = require __DIR__ . '/../bootstrap/app.php';
        $app->loadEnvironmentFrom('.env.testing');
        $app->make(Kernel::class)->bootstrap();

        Hash::driver('bcrypt')->setRounds(4);

        $this->setUpTenancy();

        return $app;
    }

    protected function refreshApplication()
    {
        parent::refreshApplication();
        $this->artisan('migrate:fresh');
    }

    protected function tearDown()
    {
        $this->cleanupTenancy();
        parent::tearDown();
    }
}