<?php

namespace Ui\Orchid\Menus;

use Core\Extensions\Orchid\Menu;
use Orchid\Screen\Actions\Menu as MenuItem;

final class NavigationMenu extends Menu
{
    protected ?string $title = 'Navigation';

    /** @inheritDoc */
    protected function registerMenu(): array
    {
        // TODO: translatable language identification strings (as in "laravel-bests-practices")
        return [
            MenuItem::make('Get Started')
                ->icon('bs.book')
                ->route(config('platform.index')),

            MenuItem::make('Example Screen')
                ->icon('bs.collection')
                ->route('platform.example')
                ->badge(fn() => 6),

            MenuItem::make('Form Elements')
                ->icon('bs.journal')
                ->route('platform.example.fields')
                ->active('*/form/examples/*'),

            MenuItem::make('Overview Layouts')
                ->icon('bs.columns-gap')
                ->route('platform.example.layouts')
                ->active('*/layout/examples/*'),

            MenuItem::make('Charts')
                ->icon('bs.bar-chart')
                ->route('platform.example.charts'),

            MenuItem::make('Cards')
                ->icon('bs.card-text')
                ->route('platform.example.cards'),
        ];
    }
}
