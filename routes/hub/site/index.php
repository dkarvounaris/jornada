<?php

use Illuminate\Support\Facades\Route;
use Ui\Enums\HubSite;
use Ui\Site\Screens\WelcomeScreen;

Route::screen('/', WelcomeScreen::class)
    ->name(HubSite::Welcome->value);
