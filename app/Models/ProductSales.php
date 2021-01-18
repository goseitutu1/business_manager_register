<?php

namespace App\Models;

use App\Api\Helpers\HashIdHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductSales extends Model {
    use SoftDeletes;

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->id_hash = HashIdHelper::generateId();
            // calculate total amount
            $product = Product::where('id_hash', $model->product_id)->first();
            $model->total = (double) $model->quantity * ($model->unit_price ?? $product->selling_price);
            $model->unit_price = (double) $model->unit_price ?? $product->selling_price;
            $model->quantity = (double) $model->quantity;
            $model->product_id = $product->id;
        });

        static::updating(function ($model) {
            // re-calculate total amount
            $product = Product::where('id_hash', $model->product_id)->first();
            $model->total = $model->quantity * ($model->unit_price ?? $product->selling_price);
            $model->product_id = $product->id;
        });
    }

    protected $fillable = [
        'id_hash', 'unit_price', 'is_taxed', 'total', 'total_tax', 'quantity',
        'product_id', 'business_id', 'payment_date'
    ];

    protected $table = 'product_sales';

    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

    protected $hidden = ['deleted_at'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'payment_date' => 'date',
    ];

    /**
     * Returns the first currency which matches the given id hash.
     *
     * @param Builder $query
     * @param $id_hash
     * @return Builder
     */
    public function scopeFindByIdHash($query, $id_hash) {
        return $query->where('id_hash', $id_hash)->first();
    }

    public function product() {
        return $this->belongsTo('App\Models\Product', 'product_id');
    }

    public function business() {
        return $this->belongsTo('App\Models\Business', 'business_id');
    }
}
