<?php

namespace App\Ui;

use App\Features\Ui\HubAdmin;
use Core\Extensions\Orchid\Hub;
use Laravel\Pennant\Feature;
use Ui\Admin\Menus\AccessMenu;

final class AdminHub extends Hub
{
    public static array $prefixes = [\Ui\Enums\HubAdmin::_prefix_name->value];

    /** @noinspection PhpMissingParentCallCommonInspection */
    public static function isSupported(): bool
    {
        return Feature::active(HubAdmin::class);
    }

    public function __construct()
    {
        Feature::forget(HubAdmin::class); // never use cached value for security
    }

    public function buildMenu(): array
    {
        return [
            AccessMenu::class,
        ];
    }
}
