<?php

namespace Sharmindar\Core\Models;

use Illuminate\Database\Eloquent\Model;
use Sharmindar\Core\Contracts\Country as CountryContract;

class Country extends Model implements CountryContract
{
    public $timestamps = false;
}
