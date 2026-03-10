<?php

namespace Sharmindar\Core\Attribute\Repositories;

use Sharmindar\Core\Eloquent\Repository;

class AttributeOptionRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Sharmindar\Core\Attribute\Contracts\AttributeOption';
    }
}
