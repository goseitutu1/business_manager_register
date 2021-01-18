<?php

namespace App\Models;

use App\Api\Helpers\HashIdHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SubscriptionPlan extends Model
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
        'id_hash', 'name', 'description', 'minimum_employees',
        'price', 'maximum_employees', 'has_employees_limit'
    ];

    protected $table = 'subscription_plans';

    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

    protected $hidden = ['deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * Returns the first plan which matches the given id hash.
     *
     * @param $id_hash
     * @return SubscriptionPlan
     */
    public static function findByIdHash($id_hash)
    {
        return SubscriptionPlan::where('id_hash', $id_hash)->first();
    }

    public function subscriptions()
    {
        return $this->hasMany('App\Models\Subscription', 'plan_id');
    }
}
