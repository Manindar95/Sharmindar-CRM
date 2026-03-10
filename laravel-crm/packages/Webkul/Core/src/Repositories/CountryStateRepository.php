<?php

namespace Sharmindar\Core\Core\Repositories;

use Prettus\Repository\Traits\CacheableRepository;
use Sharmindar\Core\Core\Eloquent\Repository;

class CountryStateRepository extends Repository
{
    use CacheableRepository;

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Sharmindar\Core\Core\Contracts\CountryState';
    }
}
