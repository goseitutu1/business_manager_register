<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TmpRegistration extends Model
{
    use SoftDeletes;

    protected $fillable = [

            'mobile_money_number',
            'first_name',
            'last_name',
            'phone_number',
            'tmp_url',
            'is_registered',

        ];

    public function url()
    {
        $this->tmp_url = route('register.company.tmp','tmp'.hash('md5',$this->phone_number));
        $this->save();
        return $this;
    }

    public function hash()
    {
        $access_token = hash_hmac('sha256', $this->email, $this->id);
        return $access_token;
    }

    public function isRegistered()
    {
        $this->is_registered = true;
        $this->save();
    }

}
