<?php

namespace Ui\Orchid\Menus;

use Core\Extensions\Orchid\Menu;
use Orchid\Screen\Actions\Menu as MenuItem;

final class GoToAdminHubMenu extends Menu
{
    protected function registerMenu(): array
    {
        // TODO: translatable language identification strings (as in "laravel-bests-practices")
        return [
            MenuItem::make('Go to Admin Hub')
                ->route('hub.admin.main')
        ];
    }
}
