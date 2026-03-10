<?php

namespace Sharmindar\Core\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Sharmindar\Core\Core\Contracts\CountryState as CountryStateContract;

class CountryState extends Model implements CountryStateContract
{
    public $timestamps = false;
}
