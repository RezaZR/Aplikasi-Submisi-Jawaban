<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class ModelLecturerCourse extends Model
{
    use SoftDeletes;

    // protected $dates = ['deleted_at'];
    protected $table = 'lecturer_courses';

    public function lecturers() {
        return $this->belongsTo('App\ModelUser');
    }

    public function courses() {
        return $this->hasMany('App\ModelCourse');
    }
}
