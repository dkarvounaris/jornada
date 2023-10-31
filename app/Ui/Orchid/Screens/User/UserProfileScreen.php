<?php /** @noinspection PhpMissingParentCallCommonInspection */

declare(strict_types=1);

namespace App\Ui\Orchid\Screens\User;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Orchid\Access\Impersonation;
use Orchid\Platform\Models\User;
use Orchid\Screen\Action;
use Orchid\Screen\Actions\Button;
use Orchid\Screen\Screen;
use Orchid\Support\Color;
use Orchid\Support\Facades\Layout;
use Orchid\Support\Facades\Toast;

class UserProfileScreen extends Screen
{
    /**
     * Fetch data to be displayed on the screen.
     *
     *
     * @return array
     */
    public function query(Request $request): iterable
    {
        return [
            'profile' => $request->user(),
        ];
    }

    /**
     * The name of the screen displayed in the header.
     */
    public function name(): ?string
    {
        return __('hub/profile/profile.title');
    }

    /**
     * Display header description.
     */
    public function description(): ?string
    {
        return __('hub/profile/profile.description');
    }

    /**
     * The screen's action buttons.
     *
     * @return Action[]
     */
    public function commandBar(): iterable
    {
        return [
            Button::make('Back to my account')
                ->canSee(Impersonation::isSwitch())
                ->icon('bs.people')
                ->route('platform.switch.logout'),

            Button::make('Sign out')
                ->icon('bs.box-arrow-left')
                ->route('platform.logout'),
        ];
    }

    /**
     * @return \Orchid\Screen\Layout[]
     */
    public function layout(): iterable
    {
        return [
            Layout::block(\Ui\Orchid\Layouts\User\UserEditLayout::class)
                ->title(__('Profile Information'))
                ->description(__("Update your account's profile information and email address."))
                ->commands(
                    Button::make(__('Save'))
                        ->type(Color::BASIC())
                         ->icon('bs.check-circle')
                        ->method('save')
                ),

            Layout::block(\Ui\Orchid\Layouts\User\ProfilePasswordLayout::class)
                ->title(__('Update Password'))
                ->description(__('Ensure your account is using a long, random password to stay secure.'))
                ->commands(
                    Button::make(__('Update password'))
                        ->type(Color::BASIC())
                         ->icon('bs.check-circle')
                        ->method('changePassword')
                ),
        ];
    }

    public function save(Request $request): void
    {
        $request->validate([
            'profile.name'  => 'required|string',
            'profile.email' => [
                'required',
                Rule::unique(User::class, 'email')->ignore($request->user()),
            ],
        ]);

        $request->user()
            ->fill($request->get('profile'))
            ->save();

        Toast::info(__('Profile updated.'));
    }

    public function changePassword(Request $request): void
    {
        $guard = config('platform.guard', 'web');
        $request->validate([
            'old_password' => 'required|current_password:'.$guard,
            'password'     => 'required|confirmed',
        ]);

        tap($request->user(), function ($user) use ($request) {
            $user->password = Hash::make($request->get('password'));
        })->save();

        Toast::info(__('Password changed.'));
    }
}
