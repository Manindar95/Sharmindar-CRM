<?php

namespace Sharmindar\Core\Repositories;

use Prettus\Repository\Traits\CacheableRepository;
use Sharmindar\Core\Eloquent\Repository;

class CountryRepository extends Repository
{
    use CacheableRepository;

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Sharmindar\Core\Contracts\Country';
    }
}
