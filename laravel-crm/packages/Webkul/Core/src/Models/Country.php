<?php

namespace Sharmindar\Core\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Sharmindar\Core\Core\Contracts\Country as CountryContract;

class Country extends Model implements CountryContract
{
    public $timestamps = false;
}
