<?php

namespace App\Ui;

use App\Features\Ui\HubAdmin;
use Core\Extensions\Orchid\Hub;
use Laravel\Pennant\Feature;
use Ui\Orchid\Menus\DocsMenu;
use Ui\Orchid\Menus\GoToAdminHubMenu;
use Ui\Orchid\Menus\NavigationMenu;

final class ProfileHub extends Hub
{
    public static array $prefixes = [\Ui\Enums\HubProfile::_prefix_name->value, 'hub.*'];

    public static bool $isFallback = true;

    // TODO: redirect to specific route defined, when fallback?

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
