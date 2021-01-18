<?php

namespace App\Models;

use App\Api\Helpers\HashIdHelper;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AdvertStatus extends Model
{
    use SoftDeletes;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id_hash = HashIdHelper::generateId();
        });
    }

    protected $fillable = ['id_hash', 'name'];

    protected $table = 'advert_status';

    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

    protected $hidden = ['deleted_at'];

    /**
     * Returns the first status which matches the given id hash.
     *
     * @param $id_hash
     * @return AdvertStatus
     */
    public static function findByIdHash($id_hash)
    {
        return AdvertStatus::where('id_hash', $id_hash)->first();
    }

    public function adverts()
    {
        return $this->belongsToMany(Advert::class, 'status_id');
    }
}
