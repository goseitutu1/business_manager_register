<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MobileMoneyTransaction extends Model
{
    use SoftDeletes;

    protected $fillable = [
        "phone_number", "vendor", "transaction_id", "transaction_type",
        "message", "response_status", "response_message", "amount",
        'payment_id', 'business_id', 'subscription_id',
    ];

    protected $table = 'mobile_money_transactions';

    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

    protected $hidden = ['deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    public function business()
    {
        return $this->belongsTo('App\Models\Business', 'business_id');
    }

    public function sales_payment()
    {
        return $this->belongsTo('App\Models\Payment', 'payment_id');
    }

    public function subscription()
    {
        return $this->belongsTo('App\Models\Subscription', 'subscription_id');
    }

    /**
     * A simple logger for logging mobile money api responses
     *
     * @param string $message
     * @return void
     */
    public static function logger($message)
    {
        $now = now();
        file_put_contents(storage_path() . '/logs/momo_transactions.log', "\n" . 'INFO: ' . $now . ' || ' . $message . PHP_EOL, FILE_APPEND);
    }
}
