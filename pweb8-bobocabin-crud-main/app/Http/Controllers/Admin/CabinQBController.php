<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CabinQBController extends Controller
{
    public function index()
    {
        $cabins = DB::table('cabins')->orderBy('id', 'desc')->get();
        $mode = 'Query Builder';
        return view('admin.crud', compact('cabins', 'mode'));
    }

    public function store(Request $request)
    {
        DB::table('cabins')->insert([
            'nama_cabin' => $request->nama_cabin,
            'lokasi' => $request->lokasi,
            'harga_per_malam' => $request->harga_per_malam,
            'gambar' => $request->gambar,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        return back()->with('success', 'Cabin berhasil ditambahkan (Query Builder)');
    }

    public function update(Request $request, $id)
    {
        DB::table('cabins')->where('id', $id)->update([
            'nama_cabin' => $request->nama_cabin,
            'lokasi' => $request->lokasi,
            'harga_per_malam' => $request->harga_per_malam,
            'gambar' => $request->gambar,
            'updated_at' => now(),
        ]);
        return back()->with('success', 'Cabin berhasil diperbarui (Query Builder)');
    }

    public function destroy($id)
    {
        DB::table('cabins')->where('id', $id)->delete();
        return back()->with('success', 'Cabin berhasil dihapus (Query Builder)');
    }
}
