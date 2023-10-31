# Service Provider Registration & Discovery

Service Providers can have an actual impact on request performance on every request. As such, they must be
optimized to keep all requests as fast as possible.

Optimization is possible, by only loading the service providers required, deferring those not always required,
and avoid loading service providers classified to be useful only in specific environments.

## Usage

The class `EnvironmentServiceProvider` offers capabilities to load providers and aliases for specific environments only.

By registering in `config/app.php` in environment specific variables like `$local_providers` and `$local_aliases` we are
only loading service providers as well facade aliases only on the `local` environment. Other specific variables for any
other environment (such as _testing_, or _staging_) can be used too.

Additionally, there are a special variables `$debug_providers` and `$debug_aliases` which are only registered, when
app debugging is additionally activated with the local environment.

Similarly, specific providers can be loaded only in production environment, by using the `$production_providers` and
`$production_aliases` variables.

All these variables work as the configuration variables `$providers` and `$aliases` provided by laravel.

## Exclude auto-loading / auto-discovery

Providers provided by packages loaded in specific environments, should be explicitly removed from auto-discovery
in `composer.json`:

```json
"extra": {
"laravel": {
"dont-discover": [
"barryvdh/laravel-debugbar"
]
}
},
```

Otherwise, they are discovered and loaded automatically, regardless of their presence in the environment-specific
provider and aliases variables.

## Optimizing existing service providers

Further optimizations could be done, where required.

Some service providers (from external packages) load or register everything, regardless how they are running. As such,
some register CLI commands, publisher data, migrations et ce-tera when they are not running on the CLI. These things
may seem small and in an optimized production environment may require only a marginal amount of time. However, in some
cases this execution may be still from 0.5ms to 1.0ms, which could quickly add up with many packages.

These are though not as easy to optimize. The best approach is case-by-case to measure the average time required when
running with or without them, or simply have a look in the specific service provider. Doing a lot in there can be a
good signal for an optimization candidate. Then, add the optimizations and submit a pull request to the original
repository. Alternatively, deactivate the service provider and provide your own, doing things in a more optimized way -
however, this approach should be avoided at most times, as it may break things during package upgrades. The last
alternative of maintaining a separate repository should be not considered, as it comes with a lot more maintenance
requirements.

## What should Service Providers contain?

Service Providers have been moved into `app/Core`, which indicates it's an infrastructure folder which should be
more generic and with the idea, that it contains code which is re-usable for other projects. As that, it should not
contain any application-specific code. If Service Providers reside inside this folder, they also should not contain
specific usages and references of application or domain code. This forces us to write service providers in ways,
which usually makes them easier extendable and as that also more capable. See the EnvironmentServiceProvider as a great
example, which all settings were moved into the configuration, making it as part of the refactoring easier to extend
it's capabilities for more environments by now having more generic code which can be re-used.

So, service providers should do one of these, to be more generic:

* Read configuration values to get a list of references or be configured (example: EnvironmentServiceProvider)
* Have to scan a folder with classes/files to use or load (similar to: Console Kernel loads Artisan Commands)
* Load something in an application-specific location (examples: routes, migrations)
* As last resort, allow to initiate or chain-load another custom service provider or register a custom service provider
  in application-space
