<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cabin;

class CabinORMController extends Controller
{
    public function index()
    {
        $cabins = Cabin::with('bookings')->orderBy('id', 'desc')->get();
        $mode = 'ORM (Eloquent)';
        return view('admin.crud', compact('cabins', 'mode'));
    }

    public function store(Request $request)
    {
        Cabin::create($request->all());
        return back()->with('success', 'Cabin berhasil ditambahkan (ORM)');
    }

    public function update(Request $request, $id)
    {
        $cabin = Cabin::findOrFail($id);
        $cabin->update($request->all());
        return back()->with('success', 'Cabin berhasil diperbarui (ORM)');
    }

    public function destroy($id)
    {
        Cabin::findOrFail($id)->delete();
        return back()->with('success', 'Cabin berhasil dihapus (ORM)');
    }
}
