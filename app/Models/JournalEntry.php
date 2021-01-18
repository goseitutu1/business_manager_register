<?php

namespace App\Models;

use App\Api\Helpers\HashIdHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JournalEntry extends Model {
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
        'entry_code', 'journal_id', 'entry_time', 'debit_account_id', 'credit_account_id',
        'amount', 'is_posted', 'comment', 'business_id'
    ];

    /**
     * The name of the table
     *
     * @var array
     */
    protected $table = "journal_entries";

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


    public function journal() {
        return $this->belongsTo('App\Models\Journal');
    }

    public function debit_account() {
        return $this->belongsTo('App\Models\GLAccount', 'debit_account_id');
    }

    public function credit_account() {
        return $this->belongsTo('App\Models\GLAccount', 'credit_account_id');
    }

//    public function ledgers() {
//        return $this->hasMany('App\Ledger');
//    }

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
