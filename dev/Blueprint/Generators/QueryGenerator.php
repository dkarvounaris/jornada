<?php /** @noinspection CascadeStringReplacementInspection */

namespace Dev\Blueprint\Generators;

use App\Library\Blueprint\Paths;
use Blueprint\Generators\ModelGenerator;
use Blueprint\Models\Model;
use Blueprint\Tree;
use Illuminate\Support\Str;

final class QueryGenerator  extends AbstractModelGenerator
{
    /** @noinspection PhpMissingParentCallCommonInspection */
    protected function getPath(\Blueprint\Contracts\Model $model): string
    {
        return Paths::getQueryFilePath($model);
    }

    protected function getStub(): string
    {
        return $this->filesystem->stub('query.class.stub');
    }

    /** @noinspection PhpMissingParentCallCommonInspection */
    protected function populateStub(string $stub, Model $model): string
    {
        $stub = str_replace('{{ namespace }}', Paths::getQueryNamespace($model), $stub);
        $stub = str_replace('{{ class_phpdoc }}', ''/*$this->buildClassPhpDoc($model)*/, $stub);
        $stub = str_replace('{{ class }}', $model->name(), $stub);
        $stub = str_replace('{{ table }}', $model->tableName(), $stub);
        $stub = str_replace('{{ schema }}', Paths::getSchemaNamespace($model) . '\\' . $model->name(), $stub);
        $stub = str_replace('{{ model }}', $model->fullyQualifiedNamespace(). '\\' . $model->name(), $stub);
        $stub = str_replace('{{ model_name }}', $model->name(), $stub);

        $body = $this->buildQuery($model);

        return str_replace('{{ body }}', trim($body), $stub);
    }

    protected function buildQuery(Model $model): string
    {
        return '';
    }
}
