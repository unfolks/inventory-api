<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // GET /api/user
    public function index()
    {
        try {
            return response()->json(User::all());

        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
        // return response()->json(User::all());
    }

    // POST /api/user
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6'
        ]);

        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        return response()->json([
            'message' => 'User berhasil dibuat',
            'data' => $user
        ], 201);
    }

    // GET /api/user/{id}
    public function show($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User tidak ditemukan'], 404);
        }

        return response()->json($user);
    }

    // PUT /api/user/{id}
    public function update(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User tidak ditemukan'], 404);
        }

        $data = $request->validate([
            'name' => 'sometimes|required|string|max:255',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|string|min:6'
        ]);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }

        $user->update($data);

        return response()->json([
            'message' => 'User berhasil diperbarui',
            'data' => $user
        ]);
    }

    // DELETE /api/user/{id}
    public function destroy($id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['error' => 'User tidak ditemukan'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User berhasil dihapus']);
    }
}
