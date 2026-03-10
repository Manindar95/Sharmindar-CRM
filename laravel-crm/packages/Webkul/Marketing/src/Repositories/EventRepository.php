<?php

namespace Sharmindar\Core\Marketing\Repositories;

use Sharmindar\Core\Core\Eloquent\Repository;
use Sharmindar\Core\Marketing\Contracts\Event;

class EventRepository extends Repository
{
    /**
     * Specify Model class name.
     */
    public function model(): string
    {
        return Event::class;
    }
}
