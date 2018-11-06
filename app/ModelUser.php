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

    protected $guard = [];
    // protected $dates = ['deleted_at'];
    protected $table = 'users';

    public function userAssignments() {
        return $this->hasMany('App\ModelUserAssignment');
    }

    public function userAssistants() {
        return $this->hasMany('App\ModelAssistantCourse');
    }

    public function userLecturers() {
        return $this->hasMany('App\ModelLecturerCourse');
    }

    public function userStudents() {
        return $this->hasMany('App\ModelStudentCourse');
    }
}