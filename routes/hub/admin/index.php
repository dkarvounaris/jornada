<?php

use Illuminate\Support\Facades\Route;
use Ui\Admin\Screens\WelcomeScreen;
use Ui\Enums\HubAdmin;

Route::screen('', WelcomeScreen::class)
    ->name(HubAdmin::Welcome->value);
