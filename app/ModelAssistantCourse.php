<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class ModelAssistantCourse extends Model
{
    use SoftDeletes;

    // protected $dates = ['deleted_at'];
    protected $table = 'assistant_courses';

    public function assistants() {
        return $this->belongsTo('App\ModelUser');
    }

    public function courses() {
        return $this->hasMany('App\ModelCourse');
    }
}