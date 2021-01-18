<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionRenewalPeriod extends Model
{
    use SoftDeletes;

    protected $fillable = ['days', 'name'];

    public function subscriptions()
    {
        return $this->belongsToMany('App\Models\Subscription');
    }
}
