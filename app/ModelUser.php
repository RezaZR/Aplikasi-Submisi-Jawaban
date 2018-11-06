<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\User as Authenticable;
use Illuminate\Database\Eloquent\Softdeletes;
use Collective\Html\Eloquent\FormAccessible;

class ModelUser extends Authenticable
{
    use SoftDeletes;
    use FormAccessible;

    protected $dates = ['deleted_at'];
    protected $table = 'users';

}
