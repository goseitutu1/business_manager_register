<?php

namespace App\Models;

use App\Api\Helpers\HashIdHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Subscription extends Model
{
    use SoftDeletes;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id_hash = HashIdHelper::generateId();
        });
    }

    protected $fillable = [
        'id_hash', 'last_payment_date', 'expiry_date', 'status',
        'user_id', 'plan_id', 'previous_plan_id', 'is_active',
        'renewal_id', 'is_first_time'
    ];

    protected $table = 'subscriptions';

    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

    protected $hidden = ['deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'expiry_date' => 'datetime',
        'last_payment_date' => 'datetime'
    ];

    public function plan()
    {
        return $this->belongsTo('App\Models\SubscriptionPlan', 'plan_id');
    }

    public function previousPlan()
    {
        return $this->belongsTo('App\Models\SubscriptionPlan', 'previous_plan_id');
    }

    public function business()
    {
        return $this->belongsTo('App\Models\Business', 'business_id');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\SubscriptionPayment');
    }

    public function renewal_period()
    {
        return $this->belongsTo('App\Models\SubscriptionRenewalPeriod', 'renewal_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function getRemainingDaysAttribute()
    {
        if (!empty($this->expiry_date)) {
            return $this->expiry_date->diffInDays(now());
        } else {
            return null;
        }
    }
}
