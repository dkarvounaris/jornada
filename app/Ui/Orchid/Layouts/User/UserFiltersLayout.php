<?php

namespace Ui\Orchid\Layouts\User;

use Orchid\Filters\Filter;
use Orchid\Screen\Layouts\Selection;
use Ui\Orchid\Filters\RoleFilter;

class UserFiltersLayout extends Selection
{
    /**
     * @return string[]|Filter[]
     */
    public function filters(): array
    {
        return [
            RoleFilter::class,
        ];
    }
}
