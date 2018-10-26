<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;

class ModelAssignment extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];
    protected $table = 'assignments';

    protected $modes = [
        'assignment' => 'Tugas',
        'quiz' => 'Kuis',
        'exam' => 'Ujian'
    ];

    public function getModes() {
        return $this->modes;
    }
}
