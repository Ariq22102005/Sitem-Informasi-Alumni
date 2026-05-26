<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use Illuminate\Http\Request;

class PengumumanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = Pengumuman::latest();

        if ($request->filled('search')) {
            $query->where('judul', 'like', '%' . $request->search . '%');
        }

        $pengumumans = $query->paginate(10);
        return view('admin.pengumuman.index', compact('pengumumans'));
    }

    public function create()
    {
        return view('admin.pengumuman.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'           => 'required|string|max:255',
            'isi'             => 'required|string',
            'prioritas'       => 'nullable|string|in:tinggi,sedang,rendah',
            'tanggal_mulai'   => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status'          => 'nullable|string|in:aktif,nonaktif',
        ]);

        Pengumuman::create([
            'judul'           => $request->judul,
            'isi'             => $request->isi,
            'prioritas'       => $request->prioritas ?? 'sedang',
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status'          => $request->status ?? 'aktif',
        ]);

        return redirect()->route('admin.pengumuman.index')
                         ->with('success', 'Pengumuman berhasil dibuat!');
    }

    public function show(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.show', compact('pengumuman'));
    }

    public function edit(Pengumuman $pengumuman)
    {
        return view('admin.pengumuman.edit', compact('pengumuman'));
    }

    public function update(Request $request, Pengumuman $pengumuman)
    {
        $request->validate([
            'judul'           => 'required|string|max:255',
            'isi'             => 'required|string',
            'prioritas'       => 'nullable|string|in:tinggi,sedang,rendah',
            'tanggal_mulai'   => 'nullable|date',
            'tanggal_selesai' => 'nullable|date|after_or_equal:tanggal_mulai',
            'status'          => 'nullable|string|in:aktif,nonaktif',
        ]);

        $pengumuman->update([
            'judul'           => $request->judul,
            'isi'             => $request->isi,
            'prioritas'       => $request->prioritas ?? 'sedang',
            'tanggal_mulai'   => $request->tanggal_mulai,
            'tanggal_selesai' => $request->tanggal_selesai,
            'status'          => $request->status ?? 'aktif',
        ]);

        return redirect()->route('admin.pengumuman.index')
                         ->with('success', 'Pengumuman berhasil diperbarui!');
    }

    public function destroy(Pengumuman $pengumuman)
    {
        $pengumuman->delete();
        return redirect()->route('admin.pengumuman.index')
                         ->with('success', 'Pengumuman berhasil dihapus!');
    }
}