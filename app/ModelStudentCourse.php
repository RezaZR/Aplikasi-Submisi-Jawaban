<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class ModelStudentCourse extends Model
{
    use SoftDeletes;

    // protected $dates = ['deleted_at'];
    protected $table = 'student_courses';
    protected $guarded = [];

    public function students() {
        return $this->belongsTo('App\ModelUser');
    }

    public function courses() {
        return $this->hasMany('App\ModelCourse');
    }
}
