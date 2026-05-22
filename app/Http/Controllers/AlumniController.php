<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alumni;

class AlumniController extends Controller
{
    public function index()
    {
        $alumnis = Alumni::latest()->get();

        return view('alumni.index', compact('alumnis'));
    }

    public function create()
    {
        return view('alumni.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'nim' => 'required',
            'jurusan' => 'required',
            'angkatan' => 'required',
            'tahun_lulus' => 'required',
            'email' => 'required|email'
        ]);

        Alumni::create($request->all());

        return redirect('/alumni')
            ->with('success', 'Data alumni berhasil ditambahkan');
    }

    public function show(string $id)
    {
        $alumni = Alumni::findOrFail($id);

        return view('alumni.show', compact('alumni'));
    }

    public function edit(string $id)
    {
        $alumni = Alumni::findOrFail($id);

        return view('alumni.edit', compact('alumni'));
    }

    public function update(Request $request, string $id)
    {
        $alumni = Alumni::findOrFail($id);

        $alumni->update($request->all());

        return redirect('/alumni')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy(string $id)
    {
        $alumni = Alumni::findOrFail($id);

        $alumni->delete();

        return redirect('/alumni')
            ->with('success', 'Data berhasil dihapus');
    }
}