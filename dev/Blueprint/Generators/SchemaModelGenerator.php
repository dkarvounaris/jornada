<?php /** @noinspection CascadeStringReplacementInspection */

namespace Dev\Blueprint\Generators;

use App\Library\Blueprint\Paths;
use Blueprint\Models\Model;
use Illuminate\Support\Str;

final class SchemaModelGenerator extends AbstractModelGenerator
{
    /** @noinspection PhpMissingParentCallCommonInspection */
    protected function getPath(\Blueprint\Contracts\Model $model): string
    {
        return Paths::getSchemaFilePath($model);
    }

    protected function getStub(): string
    {
        return $this->filesystem->stub('schema.class.stub');
    }

    /** @noinspection PhpMissingParentCallCommonInspection */
    protected function populateStub(string $stub, Model $model): string
    {
        /*        if ($model->isPivot()) {
                    $stub = str_replace('class {{ class }} extends Model', 'class {{ class }} extends Pivot', $stub);
                    $this->addImport($model, 'Illuminate\\Database\\Eloquent\\Relations\\Pivot');
                } else {
                    $this->addImport($model, 'Illuminate\\Database\\Eloquent\\Model');
                }*/
        $stub = str_replace('{{ namespace }}', Paths::getSchemaNamespace($model), $stub);
        $stub = str_replace('{{ class_phpdoc }}', ''/*$this->buildClassPhpDoc($model)*/, $stub);
        $stub = str_replace('{{ class }}', $model->name(), $stub);
        $stub = str_replace('{{ table }}', $model->tableName(), $stub);
        $stub = str_replace('{{ model_name }}', $model->name(), $stub);

        $body = $this->buildFields($model);
//        $body .= $this->buildRelationships($model);

//        $this->addImport($model, 'Illuminate\\Database\\Eloquent\\Factories\\HasFactory');
        //        $stub = $this->addTraits($model, $stub);
//        $stub = str_replace('{{ imports }}', $this->buildImports($model), $stub);

        return str_replace('{{ body }}', trim($body), $stub);
    }

    protected function buildFields(Model $model): string
    {
        /*        if (!$model->usesTimestamps()) {

                }*/

        $cases = collect(array_keys($model->columns()))
            ->transform(function ($column) {
                $stub = str_replace('{{ column }}', $column, $this->filesystem->stub('schema.case.stub'));
                $stub = str_replace('{{ field }}', $column, $stub);
                return str_replace('{{ case }}', strtoupper($column), $stub);
            });

        return implode(PHP_EOL, $cases->toArray());
    }

}
