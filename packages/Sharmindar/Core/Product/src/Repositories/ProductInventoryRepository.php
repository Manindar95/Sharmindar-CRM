<?php

namespace Sharmindar\Core\Product\Repositories;

use Sharmindar\Core\Eloquent\Repository;

class ProductInventoryRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Sharmindar\Core\Product\Contracts\ProductInventory';
    }
}
