<?php

namespace Tests;

use Closure;
use Illuminate\Contracts\Console\Kernel;

trait CreatesApplication
{
    protected $beforeBootstrapping = [];

    /**
     * Creates the application.
     *
     * @return \Illuminate\Foundation\Application
     */
    public function createApplication()
    {

        $app = require __DIR__.'/../bootstrap/app.php';

        foreach ($this->beforeBootstrapping as $bootstrapper => $callbacks) {
            foreach ($callbacks as $callback) {
                $app->beforeBootstrapping($bootstrapper, $callback);
            }
        }

        $app->make(Kernel::class)->bootstrap();

        return $app;
    }

    /**
     * Register a "before" callback for any of the `Illuminate\Foundation\Bootstrap\*` "Bootstrapper" classes. This
     * should be called before the `parent::setUp` in your test setUp.
     *
     * @param $bootstrapper
     * @param Closure $callback
     */
    public function registerBeforeBootstrappingCallback($bootstrapper, Closure $callback)
    {
        if (!isset($this->beforeBootstrapping[$bootstrapper])) {
            $this->beforeBootstrapping[$bootstrapper] = [];
        }
        $this->beforeBootstrapping[$bootstrapper][] = $callback;
    }
}
