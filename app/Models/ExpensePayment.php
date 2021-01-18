<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ExpensePayment extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id_hash', 'code', 'description', 'payment_date',
        'amount_paid', 'old_balance', 'new_balance',
        'business_id', 'expense_id'
    ];

    protected $table = 'expense_payments';

    protected $dates = ['created_at', 'deleted_at', 'updated_at', 'due_date', 'payment_date'];

    protected $hidden = ['deleted_at'];

    public function getTypeAttribute($value)
    {
        return strtolower($value);
    }

    /**
     * Returns the first expense which matches the given id hash.
     *
     * @param $id_hash
     * @return Builder
     */
    public static function findByIdHash($id_hash)
    {
        return Expense::where('id_hash', $id_hash)->first();
    }

    public function business()
    {
        return $this->belongsTo('App\Models\Business', 'business_id');
    }

    public function expense()
    {
        return $this->belongsTo('App\Models\Expense', 'expense_id');
    }
}
