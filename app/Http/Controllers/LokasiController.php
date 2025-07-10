<?php
namespace App\Http\Controllers;

use App\Models\Lokasi;
use Illuminate\Http\Request;

class LokasiController extends Controller
{
    // GET /api/lokasi
    public function index()
    {
        return response()->json(Lokasi::all());
    }

    // POST /api/lokasi
    public function store(Request $request)
    {
        $data = $request->validate([
            'kode_lokasi' => 'required|string|unique:lokasis,kode_lokasi',
            'nama_lokasi' => 'required|string'
        ]);

        $lokasi = Lokasi::create($data);

        return response()->json([
            'message' => 'Lokasi berhasil dibuat',
            'data' => $lokasi
        ], 201);
    }

    // GET /api/lokasi/{id}
    public function show($id)
    {
        $lokasi = Lokasi::find($id);

        if (!$lokasi) {
            return response()->json(['error' => 'Lokasi tidak ditemukan'], 404);
        }

        return response()->json($lokasi);
    }

    // PUT /api/lokasi/{id}
    public function update(Request $request, $id)
    {
        $lokasi = Lokasi::find($id);

        if (!$lokasi) {
            return response()->json(['error' => 'Lokasi tidak ditemukan'], 404);
        }

        $data = $request->validate([
            'kode_lokasi' => 'required|string|unique:lokasis,kode_lokasi,' . $lokasi->id,
            'nama_lokasi' => 'required|string'
        ]);

        $lokasi->update($data);

        return response()->json([
            'message' => 'Lokasi berhasil diperbarui',
            'data' => $lokasi
        ]);
    }

    // DELETE /api/lokasi/{id}
    public function destroy($id)
    {
        $lokasi = Lokasi::find($id);

        if (!$lokasi) {
            return response()->json(['error' => 'Lokasi tidak ditemukan'], 404);
        }

        $lokasi->delete();

        return response()->json(['message' => 'Lokasi berhasil dihapus']);
    }
}
