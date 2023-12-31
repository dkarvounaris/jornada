<?php /** @noinspection PhpMissingParentCallCommonInspection */

namespace Core\Providers;

use Core\Extensions\Orchid\Hub;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;
use Orchid\Platform\Dashboard;
use Orchid\Platform\ItemPermission;
use Orchid\Platform\OrchidServiceProvider;

final class HubServiceProvider extends OrchidServiceProvider
{
    protected bool $booted = false;

    public function boot(Dashboard $dashboard): void
    {
        $this->bootHubs(false);
        if (!$this->booted) {
            // ask for  fallback hub to be booted, if no hub booted
            $this->bootHubs(true);
        }

        parent::boot($dashboard); // TODO: Change the autogenerated stub
        // $this->loadViewsFrom(__DIR__.'/../resources/views', 'courier');  // TODO: required?
    }

    protected function bootHubs(bool $use_fallback = false): void
    {
        /** @var Hub[] $hubs */
        $hubs = config('jornada.ui.hubs');

        foreach ($hubs as $hub) {
            if ($use_fallback === $hub::isFallback()) {
                $this->booted = $this->booted || $this->registerHub($hub);
            }
        }
    }

    protected function registerHub(Hub|string $hub): bool
    {
        if ($this->hubIsActive($hub)) {
            $hub::registerWhenSupported();
            return true;
        }

        return false;
    }

    protected function hubIsActive(Hub|string $hub): bool
    {
        $current_route = Route::current()?->getName();
        foreach ($hub::prefixes() as $prefix) {
            if (Str::startsWith($current_route, $prefix . '.') || fnmatch($prefix . '.', $current_route, FNM_NOESCAPE)) {
                return true;
            }
        }
        return false;
    }

    /**
     * @return ItemPermission[]
     */
    public function registerPermissions(): array
    {
        // TODO: Call or remove or replace with alternative, when permissions gonna be done
        return [
            ItemPermission::group(__('System'))
                ->addPermission('platform.systems.roles', __('Roles'))
                ->addPermission('platform.systems.users', __('Users')),
        ];
    }

}
