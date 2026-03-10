<?php

namespace Sharmindar\Core\DataTransfer\Repositories;

use Sharmindar\Core\Eloquent\Repository;
use Sharmindar\Core\DataTransfer\Contracts\ImportBatch;

class ImportBatchRepository extends Repository
{
    /**
     * Specify model class name.
     */
    public function model(): string
    {
        return ImportBatch::class;
    }
}
