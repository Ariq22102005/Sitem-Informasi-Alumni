<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;

class PublicAlumniController extends Controller
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
            'program_studi' => 'required',
            'angkatan' => 'required',
            'tahun_lulus' => 'required',
            'email' => 'required|email',
        ]);

        Alumni::create($request->only([
            'nama', 'nim', 'program_studi', 'angkatan', 'tahun_lulus', 'email', 'alamat',
        ]));

        return redirect()->route('alumni.index')
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

        $alumni->update($request->only([
            'nama', 'nim', 'program_studi', 'angkatan', 'tahun_lulus', 'email', 'alamat',
        ]));

        return redirect()->route('alumni.index')
            ->with('success', 'Data berhasil diupdate');
    }

    public function destroy(string $id)
    {
        Alumni::findOrFail($id)->delete();

        return redirect()->route('alumni.index')
            ->with('success', 'Data berhasil dihapus');
    }
}
