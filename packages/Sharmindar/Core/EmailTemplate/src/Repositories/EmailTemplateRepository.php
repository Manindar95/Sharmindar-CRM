<?php

namespace Sharmindar\Core\EmailTemplate\Repositories;

use Sharmindar\Core\Eloquent\Repository;

class EmailTemplateRepository extends Repository
{
    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Sharmindar\Core\EmailTemplate\Contracts\EmailTemplate';
    }
}
