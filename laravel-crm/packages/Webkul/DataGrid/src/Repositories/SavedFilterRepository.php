<?php

namespace Sharmindar\Core\DataGrid\Repositories;

use Sharmindar\Core\Core\Eloquent\Repository;
use Sharmindar\Core\DataGrid\Contracts\SavedFilter;

class SavedFilterRepository extends Repository
{
    /**
     * Specify model class name.
     */
    public function model(): string
    {
        return SavedFilter::class;
    }
}
