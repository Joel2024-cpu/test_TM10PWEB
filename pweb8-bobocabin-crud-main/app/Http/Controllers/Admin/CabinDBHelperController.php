<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CabinDBHelperController extends Controller
{
    public function index()
    {
        $cabins = DB::select('SELECT * FROM cabins');
        $mode = 'DB Helper';
        return view('admin.crud', compact('cabins', 'mode'));
    }

    public function store(Request $request)
    {
        DB::insert('INSERT INTO cabins (nama_cabin, lokasi, harga_per_malam, gambar, created_at, updated_at)
                    VALUES (?, ?, ?, ?, NOW(), NOW())', [
            $request->nama_cabin,
            $request->lokasi,
            $request->harga_per_malam,
            $request->gambar
        ]);
        return back()->with('success', 'Cabin berhasil ditambahkan (DB Helper)');
    }

    public function update(Request $request, $id)
    {
        DB::update('UPDATE cabins SET nama_cabin=?, lokasi=?, harga_per_malam=?, gambar=?, updated_at=NOW() WHERE id=?', [
            $request->nama_cabin,
            $request->lokasi,
            $request->harga_per_malam,
            $request->gambar,
            $id
        ]);
        return back()->with('success', 'Cabin berhasil diperbarui (DB Helper)');
    }

    public function destroy($id)
    {
        DB::delete('DELETE FROM cabins WHERE id = ?', [$id]);
        return back()->with('success', 'Cabin berhasil dihapus (DB Helper)');
    }
}
