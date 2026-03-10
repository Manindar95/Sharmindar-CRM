<?php

namespace Sharmindar\Core\Lead\Repositories;

use Sharmindar\Core\Eloquent\Repository;

class ProductRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Sharmindar\Core\Lead\Contracts\Product';
    }
}
