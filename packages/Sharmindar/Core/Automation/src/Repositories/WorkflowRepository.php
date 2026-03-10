<?php

namespace Sharmindar\Core\Automation\Repositories;

use Sharmindar\Core\Automation\Contracts\Workflow;
use Sharmindar\Core\Eloquent\Repository;

class WorkflowRepository extends Repository
{
    /**
     * Specify Model class name.
     */
    public function model(): string
    {
        return Workflow::class;
    }
}
