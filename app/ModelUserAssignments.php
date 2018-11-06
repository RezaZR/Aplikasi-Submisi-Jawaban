<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class ModelUserAssignments extends Model
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
