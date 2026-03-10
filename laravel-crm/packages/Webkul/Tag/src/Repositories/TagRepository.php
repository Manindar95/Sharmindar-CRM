<?php

namespace Sharmindar\Core\Tag\Repositories;

use Sharmindar\Core\Core\Eloquent\Repository;

class TagRepository extends Repository
{
    /**
     * Searchable fields
     */
    protected $fieldSearchable = [
        'name',
        'color',
        'user_id',
    ];

    /**
     * Specify Model class name
     *
     * @return mixed
     */
    public function model()
    {
        return 'Sharmindar\Core\Tag\Contracts\Tag';
    }
}
