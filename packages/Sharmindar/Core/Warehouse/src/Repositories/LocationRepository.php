<?php

namespace Sharmindar\Core\Warehouse\Repositories;

use Sharmindar\Core\Eloquent\Repository;

class LocationRepository extends Repository
{
    /**
     * Searchable fields
     */
    protected $fieldSearchable = [
        'name',
        'warehouse_id',
    ];

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Sharmindar\Core\Warehouse\Contracts\Location';
    }
}
