<?php

namespace App\Models;

use App\Api\Helpers\HashIdHelper;
use App\Tools\JournalTool;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
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
        'id_hash', 'name', 'cost_price', 'selling_price', 'quantity',
        'stock_threshold', 'location', 'category_id', 'business_id',
        'expiry_date'
    ];

    protected $table = 'products';

    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

    protected $hidden = ['deleted_at'];

    public function category()
    {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function business()
    {
        return $this->belongsToMany('App\Models\Business', 'business_id');
    }

    /**
     * Set the can_expires value.
     *
     * @param mixed $value
     * @return void
     */
    public function setCanExpireAttribute($value)
    {
        $value = strtolower($value);
        if ($value == "yes")
            $this->attributes['can_expire'] = true;
        else if ($value == "no")
            $this->attributes['can_expire'] = false;
        else
            $this->attributes['can_expire'] = ($value === 'true');
    }

    /**
     * Returns the first product which matches the given id hash.
     *
     * @param $id_hash
     * @return Builder
     */
    public static function findByIdHash($id_hash)
    {
        return Product::where('id_hash', $id_hash)->first();
    }
}
