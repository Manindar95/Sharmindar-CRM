<?php

namespace Sharmindar\Core\Lead\Repositories;

use Sharmindar\Core\Eloquent\Repository;

class SourceRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Sharmindar\Core\Lead\Contracts\Source';
    }
}
