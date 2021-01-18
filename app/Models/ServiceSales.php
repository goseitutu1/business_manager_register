<?php

namespace App\Models;

use App\Api\Helpers\HashIdHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServiceSales extends Model {
    use SoftDeletes;

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->id_hash = HashIdHelper::generateId();
        });
    }

    protected $fillable = [
        'id_hash', 'amount', 'service_id', 'business_id'
    ];

    protected $table = 'service_sales';

    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

    protected $hidden = ['deleted_at'];

    public function service() {
        return $this->belongsTo('App\Models\Service', 'service_id');
    }

    public function business() {
        return $this->belongsTo('App\Models\Business', 'business_id');
    }

    /**
     * Returns the first business which matches the given id hash.
     *
     * @param $id_hash
     * @return Builder
     */
    public static function findByIdHash($id_hash) {
        return ServiceSales::where('id_hash', $id_hash)->first();
    }
}
