<?php

namespace App\Ui;

use App\Features\Ui\HubAdmin;
use App\Features\Ui\HubSite;
use Core\Extensions\Orchid\Hub;
use Laravel\Pennant\Feature;
use Ui\Orchid\Menus\DocsMenu;
use Ui\Orchid\Menus\GoToAdminHubMenu;
use Ui\Orchid\Menus\NavigationMenu;

final class SiteHub extends Hub
{
    public static array $prefixes = [\Ui\Enums\HubSite::_prefix_name->value];

    /** @noinspection PhpMissingParentCallCommonInspection */
    public static function isSupported(): bool
    {
        return Feature::active(HubSite::class);
    }

    public function __construct()
    {
        Feature::forget(HubSite::class); // never use cached value for security
    }

    public function buildMenu(): array
    {
        return [
            NavigationMenu::class,
            DocsMenu::class,
            ...Feature::active(HubAdmin::class)
                ? [
                    GoToAdminHubMenu::class
                ]
                : []
        ];
    }
}
