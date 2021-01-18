<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'business_id', 'message', 'subject', 'status', 'user_id'
    ];

    protected $dates = ['deleted_at'];

    public function business()
    {
        return $this->belongsTo('App\Models\Business', 'business_id');
    }

    public function created_by()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
