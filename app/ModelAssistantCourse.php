<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class ModelAssistantCourse extends Model
{
    use SoftDeletes;
    use FormAccessible;

    protected $dates = ['deleted_at'];
    protected $table = 'assistant_courses';
}
