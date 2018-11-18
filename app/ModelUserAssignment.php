<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class ModelUserAssignment extends Model
{
    use SoftDeletes;
    
    // protected $dates = ['deleted_at'];
    protected $table = 'user_assignments';

    public function assignments() {
        return $this->belongsTo('App\ModelAssignment');
    }

    public function users() {
        return $this->hasMany('App\ModelUser');
    }
}
