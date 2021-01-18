<?php

namespace App\Models;

use App\Api\Helpers\HashIdHelper;
use Illuminate\Database\Eloquent\Model;

class ShoppingCartItem extends Model {

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->id_hash = HashIdHelper::generateId();
        });
    }

    //TODO: drop total_tax & is_tax columns
    //TODO: if the tax_amount/tax_id is null,then the item was not taxed
    protected $fillable = [
        'id_hash', 'total', 'quantity', 'unit_price',
        'tax_amount', 'total_tax', 'is_taxed', 'tax_id', 'service_id',
        'product_id', 'shopping_cart_id',
    ];

    protected $table = 'shopping_cart_items';

    protected $dates = ['created_at', 'updated_at'];

    public function product() {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function service() {
        return $this->belongsTo('App\Models\Service', 'service_id');
    }

    public function shopping_cart() {
        return $this->belongsTo('App\Models\ShoppingCart', 'shopping_cart_id');
    }

    public function tax() {
        return $this->belongsTo('App\Models\Tax', 'tax_id');
    }
}
