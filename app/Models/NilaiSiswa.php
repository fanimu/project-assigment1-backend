<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class NilaiSiswa extends Eloquent
{
    protected $fillable = [
        '_siswa_id',
        'mata_pelajaran',
        'nilai_latihan1',
        'nilai_latihan2',
        'nilai_latihan3',
        'nilai_latihan4',
        'nilai_ulangan_harian1',
        'nilai_ulangan_harian2',
        'nilai_ulangan_tengah_semester',
        'nilai_ulangan_akhir_semester',
    ];

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, '_siswa_id');
    }
}
