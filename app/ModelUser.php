<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Softdeletes;
use Collective\Html\Eloquent\FormAccessible;

class ModelUser extends Model
{
    use SoftDeletes;
    use FormAccessible;

    protected $dates = ['deleted_at'];
    protected $table = 'users';

    protected $levels = [
        'admin' => 'Tata Usaha',
        'lecturer' => 'Dosen',
        'student' => 'Mahasiswa',
        'assistant' => 'Asisten'
    ];

    protected $sexs = [
        'm' => 'Male',
        'f' => 'Female'
    ];

    public function getLevels() {
        return $this->levels;
    }
    
    public function getSexs() {
        return $this->sexs;
    }
}
