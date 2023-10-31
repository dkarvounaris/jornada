<?php

namespace Core\Extensions\Orchid;

use Orchid\Screen\Actions\Menu as MenuItem;

abstract class Menu
{
    /**
     * Used to create the title of a group of menu  elements.
     */
    protected ?string $title;

    /** @var array|MenuItem[] $menus */
    private array $menus;

    /**
     * @return array|MenuItem[]
     */
    abstract protected function registerMenu(): array;

    /**
     * @return array|MenuItem[]
     */
    public function getMenu(): array
    {
        $this->menus = $this->registerMenu();
        if ($this->titleIsNotEmpty()) {
            $this->setTitleOnFirstItem();
        }
        return $this->menus;
    }

    public function getTitle(): string
    {
        return $this->title ?? '';
    }

    protected function titleIsNotEmpty(): bool
    {
        return !empty($this->title);
    }

    protected function setTitleOnFirstItem(): void
    {
        $this->menus[0]->title($this->title);
    }

}
