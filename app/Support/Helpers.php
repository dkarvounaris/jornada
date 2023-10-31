<?php
/**
 * This file is autoloaded by composer like this:
 *      "files": [
 *          "app/Helpers.php"
 *      ]
 * so it's functions are always available. However, this also means,
 * that the file will be autoloaded regardless if required.
 *
 * Alternatively, you may not use composer's autoloader for the file,
 * and trigger loading on demand where needed with an elegant:
 *      use App\Helpers;
 *
 * The Helpers file provides two interfaces. One class-based with static methods and one function-based.
 */

namespace Support {
    final class Helpers
    {
        public static function helper(string $key, string $default): string
        {
            return '';
        }

        public static function plural_from_model($model)
        {

        }
    }

}

namespace {

    use Support\Helpers;
    use Illuminate\Support\Str;

    if (!\function_exists('helper')) {
        function helper(string $key, string $default = null): string
        {
            return Helpers::helper($key, $default);
        }
    }

    if (!\function_exists('show_route')) {
        function show_route($model, $resource = null): string
        {
            $resource = $resource ?? plural_from_model($model);

            return route("{$resource}.show", $model);
        }
    }

    if (!\function_exists('plural_from_model')) {
        function plural_from_model($model)
        {
            $plural = Str::pluralStudly(class_basename($model));

            return Str::kebab($plural);
        }
    }
}
