<?php

use App\Ui\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;
use Ui\Enums\HubProfile;

Route::screen('/', UserProfileScreen::class)
    ->name(HubProfile::Welcome->value)
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->push(__('hub/profile/breadcrumbs.welcome'), route(HubProfile::Welcome->value)));

Route::screen('profile', UserProfileScreen::class)
    ->name(HubProfile::Profile->value)
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent(HubProfile::Welcome->value)
        ->push(__('hub/profile/breadcrumbs.profile'), route(HubProfile::Profile->value)));
