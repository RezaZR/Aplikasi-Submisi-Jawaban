<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;
use Collective\Html\Eloquent\FormAccessible;

class ModelUser extends Model
{
    use SoftDeletes;
    use FormAccessible;

    protected $dates = ['deleted_at'];
    protected $table = 'users';
    protected $email = [
        'email' => 'sometimes|required|email|unique:users',
    ];
}
