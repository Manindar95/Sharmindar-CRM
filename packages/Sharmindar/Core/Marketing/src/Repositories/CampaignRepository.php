<?php

namespace Sharmindar\Core\Marketing\Repositories;

use Sharmindar\Core\Eloquent\Repository;
use Sharmindar\Core\Marketing\Contracts\Campaign;

class CampaignRepository extends Repository
{
    /**
     * Specify Model class name.
     */
    public function model(): string
    {
        return Campaign::class;
    }
}
