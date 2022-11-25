<?php

namespace Tests;

use ClntDev\LaravelScrubber\ScrubberServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;
use TiMacDonald\Log\LogFake;

class TestCase extends BaseTestCase
{
    protected function setUp(): void
    {
        parent::setUp();

        LogFake::bind();
    }

    protected function getPackageProviders($app): array //phpcs:ignore
    {
        return [ScrubberServiceProvider::class];
    }

    protected function getEnvironmentSetUp($app): void //phpcs:ignore
    {
        $app['config']->set('database.default', 'testbench');
        $app['config']->set('database.connections.testbench', [
            'driver'   => 'sqlite',
            'database' => ':memory:',
            'prefix'   => '',
        ]);

        $app['config']->set('scrubber.default_connection', 'testbench');
        $app['config']->set('scrubber.configuration_path', __DIR__ . '/Support/Fakes/config.php');
    }
}
