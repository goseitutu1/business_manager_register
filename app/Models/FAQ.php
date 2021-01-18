<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FAQ extends Model
{
    use SoftDeletes;

    protected $fillable = ['id', 'question', 'answer'];

    protected $dates = ['deleted_at'];
}
