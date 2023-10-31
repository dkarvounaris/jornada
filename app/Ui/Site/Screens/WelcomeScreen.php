<?php /** @noinspection PhpMissingParentCallCommonInspection */

namespace Ui\Site\Screens;

use Laravel\Pennant\Feature;
use Orchid\Screen\Actions\Link;
use Orchid\Screen\Screen;
use Orchid\Support\Facades\Layout;
use Ui\Enums\HubAdmin;
use Ui\Enums\HubProfile;

final class WelcomeScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     * @return array
     */
    public function query(): iterable
    {
        return [];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return __('hub/site/welcome.title');
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return __('hub/site/welcome.description');
    }

    /**
     * The screen's action buttons.
     *
     * @return \Orchid\Screen\Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Link::make('User Profile')
                ->route(HubProfile::Welcome->value)
                ->icon('profile'),

            Feature::active(\App\Features\Ui\HubAdmin::class)
                ? Link::make('Administration')
                    ->route(HubAdmin::Welcome->value)
                    ->icon('profile')
                : []
        ];
    }

    /**
     * The screen's layout elements.
     *
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            Layout::view('platform::partials.update-assets'),
            Layout::view('platform::partials.welcome'),
        ];
    }
}
