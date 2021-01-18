<?php

namespace App\Models;

use App\Api\Helpers\HashIdHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tax extends Model {
    use SoftDeletes;

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->id_hash = $model->id_hash = HashIdHelper::generateId();
        });
    }

    protected $fillable = ['id_hash', 'name', 'percentage'];

    protected $table = 'taxes';

    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

    protected $hidden = ['deleted_at'];

    /**
     * Returns the first tax which matches the given id hash.
     *
     * @param $id_hash
     * @return Builder
     */
    public static function findByIdHash($id_hash) {
        return Tax::where('id_hash', $id_hash)->first();
    }

    /**
     * Get the converted percentage of the tax.
     *
     * @param double $value
     * @return string
     */
    public function getPercentageAttribute($value) {
        return $value * 0.01;
    }
}
