<?php

namespace App\Helpers;

class NilaiHelper
{
    public static function calculateNilaiAkhir($nilai)
    {
        $nilai_latihan = ($nilai->nilai_latihan1 + $nilai->nilai_latihan2 + $nilai->nilai_latihan3 + $nilai->nilai_latihan4) / 4;
        $nilai_ulangan_harian = ($nilai->nilai_ulangan_harian1 + $nilai->nilai_ulangan_harian2) / 2;
        $nilai_uts = $nilai->nilai_ulangan_tengah_semester;
        $nilai_uas = $nilai->nilai_ulangan_akhir_semester;

        $nilai_akhir = ($nilai_latihan * 0.15) + ($nilai_ulangan_harian * 0.2) + ($nilai_uts * 0.25) + ($nilai_uas * 0.4);

        return $nilai_akhir;
    }
}
