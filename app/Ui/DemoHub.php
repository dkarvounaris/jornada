<?php

namespace App\Ui;

use App\Features\Ui\HubDeveloper;
use Core\Extensions\Orchid\Hub;
use Laravel\Pennant\Feature;
use Ui\Admin\Menus\AccessMenu;

final class DemoHub extends Hub
{
    public static array $prefixes = [\Ui\Enums\HubDemo::_prefix_name->value];

    public function __construct()
    {
        Feature::forget(HubDeveloper::class); // never use cached value for security
    }

    public function buildMenu(): array
    {
        return [
            AccessMenu::class,
        ];
    }

    /** @noinspection PhpMissingParentCallCommonInspection */
    public static function isSupported(): bool
    {
        return Feature::active(HubDeveloper::class);
    }
}
