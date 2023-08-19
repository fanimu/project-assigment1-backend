<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Siswa extends Eloquent
{
    public function kelas()
    {
        return $this->belongsTo(Kelas::class, '_kelas_id', '_id');
    }

    public function nilai()
    {
        return $this->hasMany(NilaiSiswa::class, '_siswa_id', '_id');
    }
}
