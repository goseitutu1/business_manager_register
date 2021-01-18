<?php

namespace App\Models;

use App\Api\Helpers\HashIdHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class WhitelistedIps extends Model
{
    use  SoftDeletes;

    protected $fillable = [
        'ip','app_user','client_key','client_secrete'
    ];
}
