<?php

namespace InetStudio\Reviews\Sites\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Contracts\Foundation\Application;

/**
 * Class SitesBindingsServiceProvider.
 */
class SitesBindingsServiceProvider extends ServiceProvider
{
    protected $defer = true;

    public $bindings = [];

    /**
     * SitesBindingsServiceProvider constructor.
     *
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        parent::__construct($app);

        $this->bindings = getPackageBindings(__DIR__.'/../Contracts');
    }

    /**
     * Получить сервисы от провайдера.
     *
     * @return array
     */
    public function provides()
    {
        return array_keys($this->bindings);
    }
}
