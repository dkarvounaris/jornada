<?php

namespace App\Library\Blueprint;

use Blueprint\Blueprint;
use Blueprint\Contracts\Model;
use Illuminate\Support\Str;

final class Paths
{

    public static function getSchemaFilePath(Model $model): string
    {
        $path = str_replace('\\', '/',
            Blueprint::relativeNamespace(self::getSchemaNamespace($model)) . '\\' . $model->name()
        );

        return sprintf('%s/%s.php', $instance->basePath ?? Blueprint::appPath(), $path);
    }

    public static function getQueryFilePath(Model $model): string
    {
        $path = str_replace('\\', '/',
            Blueprint::relativeNamespace(self::getQueryNamespace($model)) . '\\' . $model->name()
        );

        return sprintf('%s/%s.php', $instance->basePath ?? Blueprint::appPath(), $path);
    }

    public static function getRepositoryFilePath(Model $model): string
    {
        $path = str_replace('\\', '/',
            Blueprint::relativeNamespace(self::getRepositoryNamespace($model)) . '\\' . Str::pluralStudly($model->name())
        );

        return sprintf('%s/%s.php', $instance->basePath ?? Blueprint::appPath(), $path);
    }

    public static function getSchemaNamespace(Model $model): string
    {
        return str_replace(config('blueprint.models_namespace'), config('blueprint.schemas_namespace'),
            $model->fullyQualifiedNamespace()
        );
    }

    public static function getQueryNamespace(Model $model): string
    {
        return str_replace(config('blueprint.models_namespace'), config('blueprint.queries_namespace'),
            $model->fullyQualifiedNamespace()
        );
    }

    public static function getRepositoryNamespace(Model $model): string
    {
        return str_replace(config('blueprint.models_namespace'), config('blueprint.repositories_namespace'),
            $model->fullyQualifiedNamespace()
        );
    }
}
