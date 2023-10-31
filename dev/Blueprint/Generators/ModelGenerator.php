<?php /** @noinspection CascadeStringReplacementInspection */

namespace Dev\Blueprint\Generators;

use App\Library\Blueprint\Paths;
use Blueprint\Blueprint;
use Blueprint\Models\Model;
use Blueprint\Tree;
use Illuminate\Support\Str;

final class ModelGenerator extends AbstractModelGenerator
{
    protected function getStub(): string
    {
        return $this->filesystem->stub('model.class.stub');
    }

    protected function populateStub(string $stub, Model $model): string
    {
        $stub = parent::populateStub($stub, $model);
        $stub = str_replace('{{ class_phpdoc }}', $this->buildClassPhpDoc($model), $stub);

        return $stub;
    }
}
