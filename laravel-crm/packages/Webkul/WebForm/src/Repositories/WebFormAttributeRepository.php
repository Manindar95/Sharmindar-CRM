<?php

namespace Sharmindar\Core\WebForm\Repositories;

use Sharmindar\Core\Core\Eloquent\Repository;

class WebFormAttributeRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Sharmindar\Core\WebForm\Contracts\WebFormAttribute';
    }
}
