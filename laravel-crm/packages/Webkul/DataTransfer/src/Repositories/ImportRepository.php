<?php

namespace Sharmindar\Core\DataTransfer\Repositories;

use Sharmindar\Core\Core\Eloquent\Repository;
use Sharmindar\Core\DataTransfer\Contracts\Import;

class ImportRepository extends Repository
{
    /**
     * Specify model class name.
     */
    public function model(): string
    {
        return Import::class;
    }
}
