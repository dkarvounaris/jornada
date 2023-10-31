<?php /** @noinspection PhpConstantNamingConventionInspection */

namespace App\Database\Schemas;

enum Users: string /* PHP8.2 readonly */
{
    public const __table = 'users';

    public const id = 'id';
    case ID = self::id;

    public const username = 'username';
    case USERNAME = self::username;

    function fields()
    {

    }

    function unique()
    {

    }
}
