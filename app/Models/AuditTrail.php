<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AuditTrail extends Model {
    use SoftDeletes;

    protected $fillable = [
        'user_id', 'name', 'date', 'activity', 'email'
    ];

    public function user() {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    protected $table = 'audit_trails';

    protected $dates = ['date'];
}
