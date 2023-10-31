<?php /** @noinspection CascadeStringReplacementInspection */

namespace Dev\Blueprint\Generators;

use App\Library\Blueprint\Paths;
use Blueprint\Models\Model;
use Blueprint\Tree;
use Illuminate\Support\Str;

final class RepositoryGenerator extends AbstractModelGenerator
{
    /** @noinspection PhpMissingParentCallCommonInspection */
    protected function getPath(\Blueprint\Contracts\Model $model): string
    {
        return Paths::getRepositoryFilePath($model);
    }

    protected function getStub(): string
    {
        return $this->filesystem->stub('repository.class.stub');
    }

    /** @noinspection PhpMissingParentCallCommonInspection */
    protected function populateStub(string $stub, Model $model): string
    {
        $stub = str_replace('{{ namespace }}', Paths::getRepositoryNamespace($model), $stub);
        $stub = str_replace('{{ class_phpdoc }}', ''/*$this->buildClassPhpDoc($model)*/, $stub);
        $stub = str_replace('{{ class }}', Str::pluralStudly($model->name()), $stub);
        $stub = str_replace('{{ table }}', $model->tableName(), $stub);
        $stub = str_replace('{{ schema }}', Paths::getSchemaNamespace($model) . '\\' . $model->name(), $stub);
        $stub = str_replace('{{ model }}', $model->fullyQualifiedNamespace() . '\\' . $model->name(), $stub);
        $stub = str_replace('{{ query }}', Paths::getQueryNamespace($model) . '\\' . $model->name(), $stub);
        $stub = str_replace('{{ model_name }}', $model->name(), $stub);

        $body = $this->buildRepository($model);

        return str_replace('{{ body }}', trim($body), $stub);
    }

    protected function buildRepository(Model $model): string
    {
        return '';
    }
}
