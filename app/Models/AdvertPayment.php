<?php

namespace App\Models;

use App\Api\Helpers\HashIdHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdvertPayment extends Model
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
        'id_hash', 'amount', 'mobile_money_number',
        'advert_id', 'momo_transaction_id', 'status_id'
    ];

    protected $table = 'advert_payments';

    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

    protected $hidden = ['deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    public function advert()
    {
        return $this->belongsTo('App\Models\Advert', 'advert_id');
    }

    public function momo_transaction()
    {
        return $this->belongsTo('App\Models\MobileMoneyTransaction', 'momo_transaction_id');
    }

    public function status()
    {
        return $this->belongsTo('App\Models\AdvertStatus', 'status_id');
    }
}
