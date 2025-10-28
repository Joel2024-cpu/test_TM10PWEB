<?php

namespace App\Http\Controllers;

use App\Models\Cabin;

class CabinController extends Controller
{
    public function index()
    {
        $cabins = Cabin::all();
        return view('cabins.index', compact('cabins'));
    }

    public function show($id)
    {
        $cabin = Cabin::findOrFail($id);
        return view('cabins.detail', compact('cabin'));
    }
}
