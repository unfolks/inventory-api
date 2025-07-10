<?php

namespace App\Http\Controllers;

use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;
use App\Models\Produk;

class ProdukController extends Controller
{
    public function index()
    {
        try {
            return response()->json(Produk::with('lokasi')->get());
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            $data = $request->validate([
                'nama_produk' => 'required|string',
                'kode_produk' => 'required|string|unique:produks',
                'kategori' => 'required|string',
                'satuan' => 'required|string',
            ]);
            $produk = Produk::create($data);
            return response()->json($produk, 201);

        } catch (ValidationException $e) {
            return response()->json(['error' => $e->getMessage()], 422);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function show(Produk $produk)
    {
        try {
            return $produk->load('lokasi');
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(Request $request, Produk $produk)
    {
        $data = $request->validate([
            'nama_produk' => 'string',
            'kode_produk' => 'string|unique:produks,kode_produk,' . $produk->id,
            'kategori' => 'string',
            'satuan' => 'string',
        ]);

        $produk->update($data);
        return response()->json($produk);
    }

    public function destroy(Produk $produk)
    {
        $produk->delete();
        return response()->json(['message' => 'Deleted']);
    }
}
