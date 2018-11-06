<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class ModelCourse extends Model
{
    use SoftDeletes;
    
    // protected $dates = ['deleted_at'];
    protected $table = 'courses';

    public function courses() {
        return $this->hasMany('App\ModelAssignment');
    }
    
    public function assistants() {
        return $this->hasMany('App\ModelAssistantCourse');
    }

    public function lecturers() {
        return $this->hasMany('App\ModelLecturerCourse');
    }

    public function students() {
        return $this->hasMany('App\ModelStudentCourse');
    }
}