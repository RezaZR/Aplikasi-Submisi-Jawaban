<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class ModelLecturerCourse extends Model
{
    use SoftDeletes;
    use FormAccessible;

    protected $dates = ['deleted_at'];
    protected $table = 'lecturer_courses';
}
