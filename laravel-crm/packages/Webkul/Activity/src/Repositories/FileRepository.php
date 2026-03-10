<?php

namespace Sharmindar\Core\Activity\Repositories;

use Sharmindar\Core\Core\Eloquent\Repository;

class FileRepository extends Repository
{
    /**
     * Specify model class name.
     *
     * @return mixed
     */
    public function model()
    {
        return \Sharmindar\Core\Activity\Contracts\File::class;
    }
}
