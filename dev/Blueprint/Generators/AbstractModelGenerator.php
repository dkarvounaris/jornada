<?php

namespace Dev\Blueprint\Generators;

use Blueprint\Generators\ModelGenerator;
use Blueprint\Tree;

abstract class AbstractModelGenerator extends ModelGenerator
{
    /** @noinspection PhpMissingParentCallCommonInspection */
    public function output(Tree $tree): array
    {
        $this->tree = $tree;
        $stub = $this->getStub();

        foreach ($tree->models() as $model) {
            $path = $this->getPath($model);
            $this->create($path, $this->populateStub($stub, $model));
        }

        return $this->output;
    }

    abstract protected function getStub(): string;
}
