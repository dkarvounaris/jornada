<?php

namespace Core\Extensions\Orchid;

use Illuminate\Support\Collection;
use Orchid\Screen\Actions\Menu as MenuItem;

final class MenuBuilder
{
    protected Collection $menuItems;

    /** @var array|class-string[] $menu_classes */
    public function build(...$menu_classes): array
    {
        $this->menuItems = new Collection();
        collect($menu_classes)
            ->each(
                fn(string $menu) => $this->buildItems(new $menu())
            );
        /** @var MenuItem $last_menu_item */
        $this->dividerOnLastItem(false);
        return $this->menuItems->toArray();
    }

    public function buildItems(Menu $menu): void
    {
        $menu_items = collect($menu->getMenu());
        $this->titleOnFirstItem($menu->getTitle(), $menu_items);
        $menu_items->each(
            fn(MenuItem $menu_item) => $this->menuItems->add($menu_item)
        );
        $this->dividerOnLastItem(true);
    }

    protected function titleOnFirstItem(string $title, Collection $menu_items): void
    {
        if (!empty($title)) {
            $menu_items->first(fn(MenuItem $first_menu_item) => $first_menu_item->title($title));
        }
    }
    protected function dividerOnLastItem(bool $enabled = true): void
    {
        $last_menu_item = $this->menuItems->last(fn(MenuItem $last_menu_item) => $last_menu_item->divider($enabled));
    }

}
