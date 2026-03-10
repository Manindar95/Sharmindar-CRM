<?php

namespace Sharmindar\Core\User\Repositories;

use Sharmindar\Core\Core\Eloquent\Repository;

class RoleRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Sharmindar\Core\User\Contracts\Role';
    }
}
