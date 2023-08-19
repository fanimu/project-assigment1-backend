<?php

namespace App\Http\Controllers;

use App\Models\NilaiSiswa;
use Illuminate\Http\Request;

class NilaiSiswaController extends Controller
{

    public function create(Request $request)
    {
        // Validasi input dari request jika diperlukan

        $input = $request->all();

        // Simpan data nilai pelajaran
        $nilai = new NilaiSiswa([
            '_siswa_id' => $input['_siswa_id'],
            'mata_pelajaran' => $input['mata_pelajaran'],
            'nilai_latihan1' => $input['nilai_latihan1'],
            'nilai_latihan2' => $input['nilai_latihan2'],
            'nilai_latihan3' => $input['nilai_latihan3'],
            'nilai_latihan4' => $input['nilai_latihan4'],
            'nilai_ulangan_harian1' => $input['nilai_ulangan_harian1'],
            'nilai_ulangan_harian2' => $input['nilai_ulangan_harian2'],
            'nilai_ulangan_tengah_semester' => $input['nilai_ulangan_tengah_semester'],
            'nilai_ulangan_akhir_semester' => $input['nilai_ulangan_akhir_semester'],
        ]);

        $nilai->save();

        return response()->json(['message' => 'Data nilai berhasil disimpan.']);
    }
}
