<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Expense extends Model
{
    use SoftDeletes;

    //TODO: remove 'amount_owed' field
    protected $fillable = [
        'id_hash', 'expense_no', 'due_date', 'description', 'type',
        'payment_date', 'total_amount', 'amount_paid', 'amount_owed',
        'business_id', 'amount_remaining', 'category_id', 'journal_id',
        'vendor_id'
    ];

    protected $table = 'expenses';

    protected $dates = ['created_at', 'deleted_at', 'updated_at', 'due_date', 'payment_date'];

    protected $hidden = ['deleted_at'];

    public function getPaymentDateAttribute($value)
    {
        if ($value != null)
            return Carbon::parse($value)->format("Y-m-d");
        return $value;
    }

    public function getDueDateAttribute($value)
    {
        if ($value != null)
            return Carbon::parse($value)->format("Y-m-d");
        return $value;
    }

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

    public function journal()
    {
        return $this->belongsTo('App\Models\Journal', 'journal_id');
    }

    // TODO!: remove this and use supplier() instead
    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor', 'vendor_id');
    }

    public function supplier()
    {
        return $this->belongsTo('App\Models\Vendor', 'vendor_id');
    }

    public function category()
    {
        return $this->belongsTo('App\Models\ExpenseCategory', 'category_id');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\ExpensePayment');
    }
}
