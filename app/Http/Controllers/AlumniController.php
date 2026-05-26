<?php

namespace App\Http\Controllers;

use App\Models\Alumni;
use Illuminate\Http\Request;

class AlumniController extends Controller
{
    public function index(Request $request)
    {
        $query = Alumni::query();

        if ($request->filled('search')) {
            $query->where('nama', 'like', '%'.$request->search.'%')
                ->orWhere('nim', 'like', '%'.$request->search.'%')
                ->orWhere('email', 'like', '%'.$request->search.'%');
        }
        if ($request->filled('angkatan')) {
            $query->where('angkatan', $request->angkatan);
        }
        if ($request->filled('status_kerja')) {
            $query->where('status_kerja', $request->status_kerja);
        }

        $alumni = $query->orderBy('nama')->paginate(15);

        return view('admin.alumni.index', compact('alumni'));
    }

    public function create()
    {
        return view('admin.alumni.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:alumnis,nim',
            'email' => 'required|email|unique:alumnis,email',
            'no_hp' => 'nullable|string|max:20',
            'program_studi' => 'required|string|max:255',
            'angkatan' => 'required|integer',
            'tahun_lulus' => 'nullable|integer',
            'ipk' => 'nullable|numeric|min:0|max:4',
            'status_kerja' => 'nullable|string',
            'perusahaan' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        Alumni::create($validated);

        return redirect()->route('admin.alumni.index')
            ->with('success', 'Data alumni berhasil ditambahkan!');
    }

    public function show(Alumni $alumni)
    {
        return view('admin.alumni.show', compact('alumni'));
    }

    public function edit(Alumni $alumni)
    {
        return view('admin.alumni.edit', compact('alumni'));
    }

    public function update(Request $request, Alumni $alumni)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|unique:alumnis,nim,'.$alumni->id,
            'email' => 'required|email|unique:alumnis,email,'.$alumni->id,
            'no_hp' => 'nullable|string|max:20',
            'program_studi' => 'required|string|max:255',
            'angkatan' => 'required|integer',
            'tahun_lulus' => 'nullable|integer',
            'ipk' => 'nullable|numeric|min:0|max:4',
            'status_kerja' => 'nullable|string',
            'perusahaan' => 'nullable|string|max:255',
            'alamat' => 'nullable|string',
        ]);

        $alumni->update($validated);

        return redirect()->route('admin.alumni.index')
            ->with('success', 'Data alumni berhasil diperbarui!');
    }

    public function destroy(Alumni $alumni)
    {
        $alumni->delete();

        return redirect()->route('admin.alumni.index')
            ->with('success', 'Data alumni berhasil dihapus!');
    }
}
