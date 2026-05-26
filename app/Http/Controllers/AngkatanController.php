<?php

namespace App\Http\Controllers;

use App\Models\Angkatan;
use Illuminate\Http\Request;

class AngkatanController extends Controller
{
    public function index()
    {
        $angkatans = Angkatan::all();
        return view('angkatan.index', compact('angkatans'));
    }

    public function create()
    {
        return view('angkatan.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun' => 'required',
            'nama_angkatan' => 'nullable|string',
        ]);

        Angkatan::create($request->all());
        return redirect()->route('angkatan.index')->with('success', 'Angkatan berhasil ditambahkan!');
    }

    public function edit(Angkatan $angkatan)
    {
        return view('angkatan.edit', compact('angkatan'));
    }

    public function update(Request $request, Angkatan $angkatan)
    {
        $request->validate([
            'tahun' => 'required',
            'nama_angkatan' => 'nullable|string',
        ]);

        $angkatan->update($request->all());
        return redirect()->route('angkatan.index')->with('success', 'Angkatan berhasil diupdate!');
    }

    public function destroy(Angkatan $angkatan)
    {
        $angkatan->delete();
        return redirect()->route('angkatan.index')->with('success', 'Angkatan berhasil dihapus!');
    }
}