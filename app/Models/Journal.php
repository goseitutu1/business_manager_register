<?php

namespace App\Models;

use App\Api\Helpers\HashIdHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Journal extends Model {
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
        'batch_no', 'transaction_date', 'reversal_date', 'is_posted',
        'debit_total', 'credit_total', 'description', 'business_id'
    ];

    /**
     * The name of the table
     *
     * @var array
     */
    protected $table = "journals";

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
        'transaction_date' => 'date',
    ];

    protected $hidden = ['deleted_at'];

    public function business() {
        return $this->belongsTo("App\Models\Business", 'business_id');
    }

    public function entries() {
        return $this->hasMany('App\Models\JournalEntry');
    }

    /**
     * Returns the first business which matches the given id hash.
     *
     * @param $id_hash
     * @return Builder
     */
    public static function findByIdHash($id_hash) {
        return Journal::where('id_hash', $id_hash)->first();
    }
}
