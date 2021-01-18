<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Sales extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id_hash', 'total','total_payable', 'total_tax', 'total_discount',
        'business_id', 'payment_id', 'sales_no', 'attendant_id',
        'customer_id', 'type', 'inventory_type'
    ];

    protected $table = 'sales';

    protected $dates = ['created_at', 'updated_at', 'deleted_at'];

    /**
     * Returns the first sales item which matches the given id hash.
     *
     * @param $id_hash
     * @return Builder
     */
    public static function findByIdHash($id_hash)
    {
        return Sales::where('id_hash', $id_hash)->first();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function business()
    {
        return $this->belongsTo('App\Models\Business', 'business_id');
    }

    public function payment()
    {
        return $this->belongsTo('App\Models\Payment', 'payment_id');
    }

    public function attendant()
    {
        return $this->belongsTo('App\Models\User', 'attendant_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

    public function items()
    {
        return $this->hasMany('App\Models\SalesItem');
    }


    /**
     * Creates new sales from from shopping cart instance
     *
     * @param ShoppingCart $cart
     * @param Business $business
     * @return void
     */
    public static function createFromShoppingCart(ShoppingCart $cart, Business $business)
    {
        $data = $cart->toArray();
        $data['business_id'] = $business->id;
        $sales = Sales::create($data);

        // create sales items from shopping cart item
        $cart->items()->each(function ($row) use (&$sales, $business) {
            $data = $row->toArray();
            $data['business_id'] = $business->id;
            $sales->items()->create($data);
        });

        return $sales;
    }
}
