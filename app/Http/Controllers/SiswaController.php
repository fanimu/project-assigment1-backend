<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas;
use App\Helpers\NilaiHelper;

use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index()
    {
        $siswaWithKelas = Siswa::all();

        $siswaWithoutTimestamps = $siswaWithKelas->map(function ($item) {
            $kelas = Kelas::find($item->_kelas_id); // Mendapatkan data kelas berdasarkan _kelas_id
            return [
                '_id' => $item->_id,
                'nama' => $item->nama,
                'kelas' => $kelas->nama
            ];
        });
        return response()->json($siswaWithoutTimestamps);
    }

    public function detailSiswa()
    {
        $siswa = Siswa::with(['kelas', 'nilai'])->get(['_id', 'nama', '_kelas_id']);
    
        $siswaWithNilai = $siswa->map(function ($item) {
            $itemArray = $item->toArray();
    
            $nilaiWithNilaiAkhir = collect($itemArray['nilai'])->map(function ($nilaiItem) {
                $nilaiItem['nilai_akhir'] = NilaiHelper::calculateNilaiAkhir((object) $nilaiItem);
                $nilaiItem[$nilaiItem['mata_pelajaran']] = $nilaiItem['nilai_akhir'];
                unset($nilaiItem['updated_at']);
                unset($nilaiItem['created_at']);
                unset($nilaiItem['nilai_latihan1']);
                unset($nilaiItem['nilai_latihan2']);
                unset($nilaiItem['nilai_latihan3']);
                unset($nilaiItem['nilai_latihan4']);
                unset($nilaiItem['nilai_ulangan_harian1']);
                unset($nilaiItem['nilai_ulangan_harian2']);
                unset($nilaiItem['nilai_ulangan_tengah_semester']);
                unset($nilaiItem['nilai_ulangan_akhir_semester']);
                unset($nilaiItem['_siswa_id']);
                unset($nilaiItem['_id']);
                unset($nilaiItem['mata_pelajaran']);
                unset($nilaiItem['nilai_akhir']);
    
                return $nilaiItem;
            });
    
            $itemArray['nilai'] = $nilaiWithNilaiAkhir->all();
            unset($itemArray['updated_at']);
            unset($itemArray['created_at']);
            
            // Ganti _kelas_id dengan nama kelasnya
            $itemArray['kelas'] = $itemArray['kelas']['nama'];
            unset($itemArray['_kelas_id']);
    
            return $itemArray;
        });
    
        return response()->json($siswaWithNilai);
    }

    public function detailNilaiSiswa()
    {
        $siswa = Siswa::with(['kelas', 'nilai'])->get(['_id', 'nama', '_kelas_id']);
    
        $siswaWithNilai = $siswa->map(function ($item) {
            $itemArray = $item->toArray();
    
            $nilaiWithNilaiAkhir = collect($itemArray['nilai'])->map(function ($nilaiItem) {
                $nilaiItem['nilai_akhir'] = NilaiHelper::calculateNilaiAkhir((object) $nilaiItem);
                unset($nilaiItem['updated_at']);
                unset($nilaiItem['created_at']);
                unset($nilaiItem['_siswa_id']);
                unset($nilaiItem['_id']);
               
    
                return $nilaiItem;
            });
    
            $itemArray['nilai'] = $nilaiWithNilaiAkhir->all();
            unset($itemArray['updated_at']);
            unset($itemArray['created_at']);
            
            // Ganti _kelas_id dengan nama kelasnya
            $itemArray['kelas'] = $itemArray['kelas']['nama'];
            unset($itemArray['_kelas_id']);
    
            return $itemArray;
        });
    
        return response()->json($siswaWithNilai);
    }
    

    public function create(Request $request)
        {
            // Validasi input dari request jika diperlukan
            $siswa = new Siswa();
            $siswa->nama = $request->input('nama');
            $siswa->_kelas_id = $request->input('_kelas_id'); // ID kelas yang dihubungkan
            $siswa->save();

            return response()->json(['message' => 'Siswa berhasil dibuat', 'data' => $siswa], 201);  
        }
}
