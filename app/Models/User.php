<?php

namespace App\Models;

use App\Api\Helpers\HashIdHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\CanResetPassword;

class User extends Authenticatable implements JWTSubject, CanResetPassword
{
    use Notifiable, SoftDeletes;

    public static function boot()
    {
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
        'first_name', 'last_name', 'email', 'password', 'phone_number',
        'country', 'id_hash', 'email_verified_at', 'type',
        'mobile_money_number', 'subscription_id', 'advert_source',
        'sms_response'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'deleted_at',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'updated_at' => 'datetime',
        'deleted_at' => 'datetime',
        'created_at' => 'datetime',
    ];

    public function fullName()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    // public function setPasswordAttribute($password)
    // {
    //     if (!empty($password)) {
    //         $this->attributes['password'] = Hash::make($password);
    //     }
    // }

    public function getFullNameAttribute()
    {
        return "{$this->first_name} {$this->last_name}";
    }

    public function getTypeAttribute($value)
    {
        return strtolower($value);
    }

    public function businesses()
    {
        return $this->hasMany('App\Models\Business', 'owner_id');
    }

    public function subscription()
    {
        return $this->belongsTo('App\Models\Subscription', 'subscription_id');
    }

    public function survey_notification()
    {
        return $this->belongsTo('App\Models\SurveyNotification', null, 'user_id');
    }

    public function subscriptions()
    {
        return $this->hasMany('App\Models\Subscription');

    }

    public function log($message)
    {
        AuditTrail::create([
            'user_id' => $this->id,
            'email' => $this->email,
            'name' => $this->first_name . ' ' . $this->last_name,
            'date' => Carbon::now()->toDateTimeString(),
            'activity' => ucwords($message),
        ]);
    }

    /**
     * Returns the first users which matches the given id hash.
     *
     * @param $id_hash
     * @return Builder
     */
    public static function findByIdHash($id_hash)
    {
        return User::where('id_hash', $id_hash)->first();
    }
}
