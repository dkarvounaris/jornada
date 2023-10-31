<?php

namespace Core\Providers;

use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

/**
 * A service provider registering other service providers defined in the config/app.php on
 * specific environments only, otherwise ignored, when the environment is another.
 *
 * Remember to disable package discovery in your composer.json for these service providers:
 *  "extra": {
 *      "laravel": {
 *          "dont-discover": [
 *              "barryvdh/laravel-debugbar"
 *          ]
 *      }
 *  },
 *
 * ---------
 *
 * Registering service providers this way, won't allow them to be deferred.
 * If both is required, registering them conditionally as also deferring them, consider this solution:
 * https://laracasts.com/discuss/channels/general-discussion/load-service-providers-depending-on-environment
 */
final class EnvironmentServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        // for performance and the way it should work,  explicitly avoid "dynamic" approach on production (ie. match,
        // using $environment et ce-tera) - @devs: avoid doing path or DRY optimizations
        if ($this->app->isProduction()) {
            $this->registerServiceProviders('production');
            $this->registerFacadeAliases('production');
            return; // required, to not register anything else as well avoid double registration
        }

        if ($this->app->isLocal()) {
            $this->registerServiceProviders('local');
            $this->registerFacadeAliases('local');
            if ($this->app->hasDebugModeEnabled()) {
                $this->registerServiceProviders('debug');
                $this->registerFacadeAliases('debug');
            }
            return; // avoid double registrations
        }

        // support for other/custom environments dynamically (testing, staging et ce-tera)
        $this->registerServiceProviders($this->app->environment());
        $this->registerFacadeAliases($this->app->environment());
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // ...
    }

    /**
     * Load service providers based on environment
     */
    private function registerServiceProviders(string $environment): void
    {
        $providers = $this->app['config']->get('app.' . $environment . '_providers', []);  // TODO: does $this->app['config'] actually work?
        $ignored = $this->app['config']->get('app.console_ignore_providers', []);

        foreach ($providers as $provider) {
            if (!($this->app->runningInConsole() && \in_array($provider, $ignored, true))) {
                $this->app->register($provider);
            }
        }
    }

    /**
     * Load additional aliases, not loaded in /config/app.php => aliases
     */
    private function registerFacadeAliases(string $environment): void
    {
        $aliases = $this->app['config']->get('app.' . $environment . '_aliases', []);

        $loader = AliasLoader::getInstance();
        foreach ($aliases as $alias => $facade) {
            $loader->alias($alias, $facade);
        }
    }
}
