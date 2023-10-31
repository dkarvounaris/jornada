<?php /** @noinspection ClassOverridesFieldOfSuperClassInspection */

namespace App\Database\Models;

use App\Ui\Orchid\Presenters\UserPresenter;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Orchid\Access\UserAccess;
use Orchid\Access\UserInterface;
use Orchid\Filters\Filterable;
use Orchid\Filters\Types\Like;
use Orchid\Filters\Types\Where;
use Orchid\Filters\Types\WhereDateStartEnd;
use Orchid\Metrics\Chartable;
use Orchid\Screen\AsSource;
use Orchid\Support\Facades\Dashboard;

class User extends Authenticatable implements UserInterface
{
    use AsSource;
    use Chartable;
    use Filterable;
    use HasFactory;
    use Notifiable;
    use UserAccess;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'permissions',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'permissions',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'permissions' => 'array',
        'email_verified_at' => 'datetime',
    ];

    /**
     * The attributes for which you can use filters in url.
     */
    protected array $allowedFilters = [
        'id' => Where::class,
        'name' => Like::class,
        'email' => Like::class,
        'updated_at' => WhereDateStartEnd::class,
        'created_at' => WhereDateStartEnd::class,
    ];

    /**
     * The attributes for which can use sort in url.
     */
    protected array $allowedSorts = [
        'id',
        'name',
        'email',
        'updated_at',
        'created_at',
    ];

    /**
     * @throws \Throwable
     */
    public static function createAdmin(string $name, string $email, string $password): void
    {
        throw_if(static::where('email', $email)->exists(), 'User exist');

        static::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password),
            'permissions' => Dashboard::getAllowAllPermission(),
        ]);
    }

    public function isAdmin(): bool
    {
        return true; // TODO: Authorization
    }

    public function isTenant(): bool
    {
        return true; // TODO: Authorization
    }

    public function isDeveloper(): bool
    {
        return true; // TODO: Authorization
    }

    public function presenter(): UserPresenter
    {
        return new UserPresenter($this);
    }
}
