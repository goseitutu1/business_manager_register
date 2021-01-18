<?php

namespace App\Models;

use App\Api\Helpers\HashIdHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed currency
 * @property mixed account_type
 */
class GLAccount extends Model {
    use SoftDeletes;

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->id_hash = HashIdHelper::generateId();
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'category', 'id_hash'
    ];

    /**
     * The name of the table
     *
     * @var array
     */
    protected $table = "gl_accounts";

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    protected $hidden = ['deleted_at'];

    public function business() {
        return $this->belongsTo("App\Models\Business", 'business_id');
    }

    /**
     * Returns the first business which matches the given id hash.
     *
     * @param $id_hash
     * @return Builder
     */
    public static function findByIdHash($id_hash) {
        return Business::where('id_hash', $id_hash)->first();
    }
}
