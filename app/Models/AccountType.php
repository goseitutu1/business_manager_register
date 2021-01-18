<?php

namespace App\Models;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountType extends Model {
    use SoftDeletes;

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $hashids = new Hashids(config('hashid_secret'), 10);
            $model->id_hash = $hashids->encode(rand(0, 999999999));
        });
    }

    protected $fillable = ['id_hash', 'name', 'code'];

    protected $table = 'account_types';

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
}
