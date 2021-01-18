<?php

namespace App\Models;

use App\Api\Helpers\HashIdHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advert extends Model
{
    use SoftDeletes;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id_hash = HashIdHelper::generateId();
        });
    }

    // TODO!: drop 'is_published' field and replace with an accessor which will use the 'status' relation name
    protected $fillable = [
        'id', 'id_hash', 'title', 'feature_image',
        'author', 'price', 'is_published', 'status_id'
    ];

    protected $dates = ['deleted_at'];

    /**
     * Returns the first advert which matches the given id hash.
     *
     * @param $id_hash
     * @return Builder
     */
    public static function findByIdHash($id_hash)
    {
        return Advert::where('id_hash', $id_hash)->first();
    }

    public function status()
    {
        return $this->belongsTo('App\Models\AdvertStatus', 'status_id');
    }

    public function payment()
    {
        return $this->belongsTo('App\Models\AdvertPayment', null, 'advert_id');
    }
}
