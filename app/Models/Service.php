<?php

namespace App\Models;

use App\Api\Helpers\HashIdHelper;
use App\Tools\JournalTool;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model {
    use SoftDeletes;

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->id_hash = HashIdHelper::generateId();
        });
    }

    protected $fillable = ['id_hash', 'name', 'amount', 'category_id', 'business_id'];

    protected $table = 'services';

    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

    protected $hidden = ['deleted_at'];

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

    public function category() {
        return $this->belongsTo('App\Models\Category', 'category_id');
    }

    public function business() {
        return $this->belongsTo('App\Models\Business', 'business_id');
    }

    /**
     * Returns the first service which matches the given id hash.
     *
     * @param $id_hash
     * @return Builder
     */
    public static function findByIdHash($id_hash) {
        return Service::where('id_hash', $id_hash)->first();
    }
}
