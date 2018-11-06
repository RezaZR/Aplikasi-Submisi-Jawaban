<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class ModelAssignment extends Model
{
    use SoftDeletes;

    // protected $dates = ['deleted_at'];
    protected $table = 'assignments';

    public function courses() {
        return $this->belongsTo('App\ModelCourse');
    }

    public function userAssignments() {
        return $this->hasMany('App\ModelUserAssignment');
    }
}