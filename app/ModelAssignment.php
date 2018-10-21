<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class ModelAssignment extends Model
{
    use SoftDeletes;
    protected $dates = ['deleted_at'];
    protected $table = 'assignments';
}
