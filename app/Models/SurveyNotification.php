<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SurveyNotification extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'status', 'api_response', 'sent_at', 'user_id',
        'is_email_sent', 'is_sms_sent'
    ];

    protected $dates = ['deleted_at'];

    protected $cast = ['sent_at' => 'datetime'];

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
