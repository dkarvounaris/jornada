<?php

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

Route::prefix('admin')->group(function () {
    require __DIR__ . '/hub/admin/index.php';
});
Route::prefix('site')->group(function () {
    require __DIR__ . '/hub/site/index.php';
});
Route::prefix('profile')->group(function () {
    require __DIR__ . '/hub/profile/index.php';
});

use App\Ui\Orchid\Screens\Examples\ExampleActionsScreen;
use App\Ui\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Ui\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Ui\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Ui\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Ui\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Ui\Orchid\Screens\Examples\ExampleScreen;
use App\Ui\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Ui\Orchid\Screens\Role\RoleEditScreen;
use App\Ui\Orchid\Screens\Role\RoleListScreen;
use App\Ui\Orchid\Screens\User\UserEditScreen;
use App\Ui\Orchid\Screens\User\UserListScreen;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;


// Platform > System > Users > User
Route::screen('users/{profile}/edit', UserEditScreen::class)
    ->name('hub.admin.systems.users.edit')
    ->breadcrumbs(fn(Trail $trail, $user) => $trail
        ->parent('hub.admin.systems.users')
        ->push($user->name, route('hub.admin.systems.users.edit', $user)));

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('hub.admin.systems.users.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('hub.admin.systems.users')
        ->push(__('Create'), route('hub.admin.systems.users.create')));

// Platform > System > Users
Route::screen('users', UserListScreen::class)
    ->name('hub.admin.systems.users')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Users'), route('hub.admin.systems.users')));

// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(fn(Trail $trail, $role) => $trail
        ->parent('platform.systems.roles')
        ->push($role->name, route('platform.systems.roles.edit', $role)));

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.systems.roles')
        ->push(__('Create'), route('platform.systems.roles.create')));

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push(__('Roles'), route('platform.systems.roles')));

// Example...
Route::screen('example', ExampleScreen::class)
    ->name('platform.example')
    ->breadcrumbs(fn(Trail $trail) => $trail
        ->parent('platform.index')
        ->push('Example Screen'));

Route::screen('/form/examples/fields', ExampleFieldsScreen::class)->name('platform.example.fields');
Route::screen('/form/examples/advanced', ExampleFieldsAdvancedScreen::class)->name('platform.example.advanced');
Route::screen('/form/examples/editors', ExampleTextEditorsScreen::class)->name('platform.example.editors');
Route::screen('/form/examples/actions', ExampleActionsScreen::class)->name('platform.example.actions');

Route::screen('/layout/examples/layouts', ExampleLayoutsScreen::class)->name('platform.example.layouts');
Route::screen('/charts/examples/charts', ExampleChartsScreen::class)->name('platform.example.charts');
Route::screen('/cards/examples/cards', ExampleCardsScreen::class)->name('platform.example.cards');

//Route::screen('idea', Idea::class, 'platform.screens.idea');
