<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all(); // Mendapatkan semua data kelas
        
        $kelasWithoutTimestamps = $kelas->map(function ($item) {
            return [
                '_id' => $item->_id,
                'nama' => $item->nama,
            ];
        });

        return response()->json($kelasWithoutTimestamps);

    }
 

    public function create(Request $request)
        {
            $data = $request->validate([
                'nama' => 'required|string|max:255',
            ]);

            $kelas = Kelas::create($data);

            return response()->json(['message' => 'Kelas berhasil dibuat', 'data' => $kelas], 201);
        }

    public function update(Request $request, $id)
        {
            $kelas = Kelas::find($id);
        
            if (!$kelas) {
                return response()->json(['message' => 'Kelas not found'], 404);
            }
        
            $data = $request->validate([
                'nama' => 'required|string|max:255',
            ]);
        
            $kelas->update($data);
        
            return response()->json(['message' => 'Kelas updated successfully', 'data' => $kelas], 200);
        }

    public function detailKelas()
        {
            $kelasWithSiswa = Kelas::with('siswa')->get(['_id', 'nama']);

            $kelasWithSiswa->transform(function ($kelas) {
                $kelas->siswa->transform(function ($siswa) {
                    unset($siswa->_kelas_id);
                    unset($siswa->updated_at);
                    unset($siswa->created_at);

                    return $siswa;
                });
                return $kelas;
            });

            return response()->json($kelasWithSiswa);
        }
}
