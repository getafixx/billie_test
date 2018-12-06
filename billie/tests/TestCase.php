<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setUp()
    {
        parent::setUp();
        \Artisan::call('migrate:refresh', [
            '--env' => 'testing',
        ]);
    }

    /**
     * Seed the database to test with
     */
    protected function seedAll()
    {
        parent::setUp();
        
        $this->setUp();

        \Artisan::call('db:seed', [
            '--class' => 'PasswordSeeder',
            '--env'   => 'testing',
        ]);
    }
}
