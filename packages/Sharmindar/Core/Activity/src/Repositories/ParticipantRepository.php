<?php

namespace Sharmindar\Core\Activity\Repositories;

use Sharmindar\Core\Eloquent\Repository;

class ParticipantRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Sharmindar\Core\Activity\Contracts\Participant';
    }
}
