<?php

namespace App\Models;

use App\Api\Helpers\HashIdHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Business extends Model
{
    use SoftDeletes;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id_hash = $model->id_hash = HashIdHelper::generateId();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id_hash', 'name', 'location', 'type', 'logo', 'currency_id',
        'reg_no', 'tax_no', 'vat_no', 'owner_id', 'subscription_id'
    ];

    /**
     * The name of the table
     *
     * @var array
     */
    protected $table = "businesses";

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    protected $hidden = ['deleted_at'];

    public function owner()
    {
        return $this->belongsTo("App\Models\User", 'owner_id');
    }

    public function currency()
    {
        return $this->belongsTo("App\Models\Currency", 'currency_id');
    }

    public function products()
    {
        return $this->hasMany("App\Models\Product");
    }

    public function services()
    {
        return $this->hasMany("App\Models\Service");
    }

    public function expenses()
    {
        return $this->hasMany("App\Models\Expense");
    }

    public function customers()
    {
        return $this->hasMany("App\Models\Customer");
    }

    public function vendors()
    {
        return $this->hasMany("App\Models\Vendor");
    }

    public function service_sales()
    {
        return $this->hasMany("App\Models\ServiceSales");
    }

    public function product_sales()
    {
        return $this->hasMany("App\Models\ProductSales");
    }

    public function employees()
    {
        return $this->hasMany("App\Models\Employee");
    }

    public function subscription()
    {
        return $this->belongsTo("App\Models\Subscription", 'subscription_id');
    }

    public function subscription_payments()
    {
        return $this->hasMany("App\Models\SubscriptionPayment");
    }

    /**
     * Returns the first business which matches the given id hash.
     *
     * @param $id_hash
     * @return Business
     */
    public static function findByIdHash($id_hash)
    {
        return Business::where('id_hash', $id_hash)->first();
    }
}
