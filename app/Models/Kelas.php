<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;
use App\Models\Siswa;

class Kelas extends Eloquent
{
    protected $connection = 'mongodb';
    protected $collection = 'kelas';
    protected $fillable = ['nama'];

    public function siswa()
    {
        return $this->hasMany(Siswa::class, '_kelas_id', '_id');
    }
}
