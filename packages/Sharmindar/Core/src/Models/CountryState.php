<?php

namespace Sharmindar\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Sharmindar\Core\Contracts\CountryState as CountryStateContract;

class CountryState extends Model implements CountryStateContract
{
    public $timestamps = false;
}
