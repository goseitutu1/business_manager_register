<?php

namespace App\Models;

use Hashids\Hashids;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * @property mixed currency
 * @property mixed account_type
 */
class Account extends Model {
    use SoftDeletes;

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $hashids = new Hashids(config('hashid_secret'), 10);
            $model->id_hash = $hashids->encode(rand(0, 999999999));
        });
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'account_type_id', 'currency_id', 'business_id', 'mobile_money_wallet',
        'bank_account_number', 'id_hash'
    ];

    /**
     * The name of the table
     *
     * @var array
     */
    protected $table = "accounts";

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

    public function currency() {
        return $this->belongsTo("App\Models\Currency", 'currency_id');
    }

    public function account_type() {
        return $this->belongsTo("App\Models\AccountType", 'account_type_id');
    }

    /**
     * Returns the first business which matches the given id hash.
     *
     * @param Builder $query
     * @param $id_hash
     * @return Builder
     */
    public function scopeFindByIdHash($query, $id_hash) {
        return $query->where('id_hash', $id_hash)->first();
    }
}
