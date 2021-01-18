<?php

namespace App\Models;

use App\Api\Helpers\HashIdHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionPayment extends Model
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
        'id_hash', 'amount', 'payment_date', 'mobile_money_number',
        'user_id', 'subscription_id'
    ];

    protected $table = 'subscription_payments';

    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

    protected $hidden = ['deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = ['payment_date' => 'date'];

    public function business()
    {
        return $this->belongsTo('App\Models\Business', 'business_id');
    }

    public function subscription()
    {
        return $this->belongsTo('App\Models\Subscription', 'subscription_id');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }
}
