<?php

namespace Sharmindar\Core\User\Repositories;

use Sharmindar\Core\Eloquent\Repository;

class GroupRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Sharmindar\Core\User\Contracts\Group';
    }
}
