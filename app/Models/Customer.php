<?php

namespace App\Models;

use App\Api\Helpers\HashIdHelper;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends Model
{
    //TODO: add payment relations when payment is implemented
    use SoftDeletes;

    public static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->id_hash = HashIdHelper::generateId();
        });
    }

    protected $fillable = [
        'id_hash', 'first_name', 'last_name', 'email', 'location',
        'business_id', 'phone_number', 'address', 'date_of_birth',
        'created_by'
    ];

    protected $table = 'customers';

    protected $dates = ['created_at', 'deleted_at', 'updated_at'];

    protected $hidden = ['deleted_at'];

    /**
     * Returns the first customer which matches the given id hash.
     *
     * @param $id_hash
     * @return Builder
     */
    public static function findByIdHash($id_hash)
    {
        return Customer::where('id_hash', $id_hash)->first();
    }

    public function business()
    {
        return $this->belongsTo('App\Models\Business', 'business_id');
    }

    public function employee()
    {
        return $this->belongsTo('App\Models\User', 'created_by');
    }

    public function payments()
    {
        return $this->hasMany('App\Models\Payment');
    }

    public function sales()
    {
        return $this->hasMany('App\Models\Sales');
    }

    /**
     * Get the vendors's full name.
     *
     * @return string
     */
    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }
}
