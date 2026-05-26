<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use Illuminate\Http\Request;

class LowonganController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Lowongan::query();

        if ($request->filled('search')) {
            $query->where('posisi', 'like', '%' . $request->search . '%')
                  ->orWhere('perusahaan', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $lowongans = $query->orderBy('created_at', 'desc')->paginate(10);
        return view('admin.lowongan.index', compact('lowongans'));
    }

    public function create()
    {
        return view('admin.lowongan.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'posisi'       => 'required|string|max:255',
            'perusahaan'   => 'required|string|max:255',
            'tipe'         => 'nullable|string|in:full_time,part_time,magang,freelance',
            'lokasi'       => 'nullable|string|max:255',
            'gaji'         => 'nullable|string|max:100',
            'batas_lamar'  => 'nullable|date',
            'link_lamar'   => 'nullable|url|max:500',
            'kontak'       => 'nullable|string|max:255',
            'deskripsi'    => 'required|string',
            'kualifikasi'  => 'nullable|string',
            'status'       => 'nullable|string|in:aktif,tutup',
        ]);

        $validated['status'] = $validated['status'] ?? 'aktif';
        Lowongan::create($validated);

        return redirect()->route('admin.lowongan.index')
                         ->with('success', 'Lowongan kerja berhasil diposting!');
    }

    public function show(Lowongan $lowongan)
    {
        return view('admin.lowongan.show', compact('lowongan'));
    }

    public function edit(Lowongan $lowongan)
    {
        return view('admin.lowongan.edit', compact('lowongan'));
    }

    public function update(Request $request, Lowongan $lowongan)
    {
        $validated = $request->validate([
            'posisi'       => 'required|string|max:255',
            'perusahaan'   => 'required|string|max:255',
            'tipe'         => 'nullable|string|in:full_time,part_time,magang,freelance',
            'lokasi'       => 'nullable|string|max:255',
            'gaji'         => 'nullable|string|max:100',
            'batas_lamar'  => 'nullable|date',
            'link_lamar'   => 'nullable|url|max:500',
            'kontak'       => 'nullable|string|max:255',
            'deskripsi'    => 'required|string',
            'kualifikasi'  => 'nullable|string',
            'status'       => 'nullable|string|in:aktif,tutup',
        ]);

        $lowongan->update($validated);

        return redirect()->route('admin.lowongan.index')
                         ->with('success', 'Lowongan kerja berhasil diperbarui!');
    }

    public function destroy(Lowongan $lowongan)
    {
        $lowongan->delete();
        return redirect()->route('admin.lowongan.index')
                         ->with('success', 'Lowongan kerja berhasil dihapus!');
    }
}