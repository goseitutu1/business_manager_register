<?php

namespace App\Models;

use App\Api\Helpers\HashIdHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id_hash = HashIdHelper::generateId();
        });
    }

    protected $fillable = [
        'id_hash', 'total', 'user_id', 'total_tax'
    ];

    protected $table = 'shopping_cart';

    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

    /**
     * Returns the first cart which matches the given id hash.
     *
     * @param $id_hash
     * @return Builder
     */
    public static function findByIdHash($id_hash)
    {
        return ShoppingCart::where('id_hash', $id_hash)->first();
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User', 'user_id');
    }

    public function items()
    {
        return $this->hasMany('App\Models\ShoppingCartItem');
    }
}
