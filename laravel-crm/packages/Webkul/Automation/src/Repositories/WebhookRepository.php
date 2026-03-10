<?php

namespace Sharmindar\Core\Automation\Repositories;

use Sharmindar\Core\Automation\Contracts\Webhook;
use Sharmindar\Core\Core\Eloquent\Repository;

class WebhookRepository extends Repository
{
    /**
     * Specify Model class name.
     */
    public function model(): string
    {
        return Webhook::class;
    }
}
