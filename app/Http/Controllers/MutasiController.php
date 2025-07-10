<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mutasi;
use App\Models\Produk;
use App\Models\Lokasi;

class MutasiController extends Controller
{
    public function index()
    {
        return Mutasi::with(['user', 'produk', 'lokasi'])->get();
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'tanggal' => 'required|date',
            'jenis_mutasi' => 'required|in:masuk,keluar',
            'jumlah' => 'required|integer|min:1',
            'keterangan' => 'nullable|string',
            'produk_id' => 'required|exists:produks,id',
            'lokasi_id' => 'required|exists:lokasis,id',
        ]);

        $produk = Produk::findOrFail($data['produk_id']);
        $lokasi = Lokasi::findOrFail($data['lokasi_id']);

        // Ambil stok sebelumnya dari pivot table
        $pivot = $produk->lokasi()->where('lokasi_id', $lokasi->id)->first();
        $stok_sebelumnya = $pivot ? $pivot->pivot->stok : 0;

        // Proses mutasi stok
        if ($data['jenis_mutasi'] === 'masuk') {
            $stok_baru = $stok_sebelumnya + $data['jumlah'];
        } else {
            if ($stok_sebelumnya < $data['jumlah']) {
                return response()->json(['error' => 'Stok tidak mencukupi'], 422);
            }
            $stok_baru = $stok_sebelumnya - $data['jumlah'];
        }

        // Update pivot stok tanpa detach relasi
        $produk->lokasi()->syncWithoutDetaching([
            $lokasi->id => ['stok' => $stok_baru]
        ]);

        // Simpan mutasi
        $mutasi = Mutasi::create([
            'tanggal' => $data['tanggal'],
            'jenis_mutasi' => $data['jenis_mutasi'],
            'jumlah' => $data['jumlah'],
            'keterangan' => $data['keterangan'] ?? null,
            'produk_id' => $produk->id,
            'lokasi_id' => $lokasi->id,
            'user_id' => auth()->id(), // Gunakan user yang login
        ]);

        return response()->json([
            'message' => 'Mutasi berhasil ditambahkan',
            'data' => $mutasi
        ], 201);
    }


    public function mutasiByProduk($id)
    {
        // dd($id);
        // dd(Mutasi::where('produk_id', $id)->with(['user', 'lokasi'])->get());
        // return Mutasi::where('produk_id', $id)->with(['user', 'lokasi'])->get();
        $mutasi = Mutasi::with(['user', 'lokasi'])
            ->where('produk_id', $id)
            ->orderBy('tanggal', 'desc')
            ->get();
        // dd($mutasi);
        return response()->json($mutasi);
    }

    public function mutasiByUser($id)
    {
        return Mutasi::where('user_id', $id)->with(['produk', 'lokasi'])->get();
    }
}
