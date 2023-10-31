<?php

namespace Ui\Orchid\Menus;

use Core\Extensions\Orchid\Menu;
use Orchid\Platform\Dashboard;
use Orchid\Screen\Actions\Menu as MenuItem;
use Orchid\Support\Color;

final class DocsMenu extends Menu
{
    protected ?string $title = 'Docs';

    /** @inheritDoc */
    protected function registerMenu(): array
    {
        // TODO: translatable language identification strings (as in "laravel-bests-practices")
        return [
            MenuItem::make('Documentation')
                ->icon('bs.box-arrow-up-right')
                ->url('https://orchid.software/en/docs')
                ->target('_blank'),

            MenuItem::make('Changelog')
                ->icon('bs.box-arrow-up-right')
                ->url('https://github.com/orchidsoftware/platform/blob/master/CHANGELOG.md')
                ->target('_blank')
                ->badge(fn () => Dashboard::version(), Color::DARK),        ];
    }
}
