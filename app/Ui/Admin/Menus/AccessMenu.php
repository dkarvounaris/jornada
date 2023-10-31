<?php

namespace Ui\Admin\Menus;

use Core\Extensions\Orchid\Menu;
use Orchid\Screen\Actions\Menu as MenuItem;

final class AccessMenu extends Menu
{
    protected ?string $title = 'Access Controls';

    /** @inheritDoc */
    protected function registerMenu(): array
    {
        // TODO: translatable language identification strings (as in "laravel-bests-practices")
        return [
            MenuItem::make(__('Users'))
                ->icon('bs.people')
                ->route('hub.admin.systems.users')
                ->permission('platform.systems.users'),

            MenuItem::make(__('Roles'))
                ->icon('bs.lock')
                ->route('platform.systems.roles')
                ->permission('platform.systems.roles'),
        ];
    }
}
