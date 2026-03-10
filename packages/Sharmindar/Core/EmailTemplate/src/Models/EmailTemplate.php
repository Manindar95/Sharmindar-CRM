<?php

namespace Sharmindar\Core\EmailTemplate\Models;

use Illuminate\Database\Eloquent\Model;
use Sharmindar\Core\EmailTemplate\Contracts\EmailTemplate as EmailTemplateContract;

class EmailTemplate extends Model implements EmailTemplateContract
{
    protected $fillable = [
        'name',
        'subject',
        'content',
    ];
}
