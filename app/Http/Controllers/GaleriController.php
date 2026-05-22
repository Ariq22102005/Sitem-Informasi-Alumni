<?php

namespace App\Http\Controllers;

use App\Models\Galeri;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GaleriController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $galeris = Galeri::latest()->paginate(12);
        return view('admin.galeri.index', compact('galeris'));
    }

    public function create()
    {
        return view('admin.galeri.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'file_path'  => 'required|image|mimes:jpeg,png,jpg,gif|max:3072',
            'kategori'   => 'nullable|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        $path = $request->file('file_path')->store('galeri', 'public');

        Galeri::create([
            'judul'      => $request->judul,
            'file_path'  => $path,
            'kategori'   => $request->kategori,
            'keterangan' => $request->keterangan,
        ]);

        return redirect()->route('admin.galeri.index')
                         ->with('success', 'Foto berhasil diupload!');
    }

    public function show(Galeri $galeri)
    {
        return view('admin.galeri.show', compact('galeri'));
    }

    public function edit(Galeri $galeri)
    {
        return view('admin.galeri.edit', compact('galeri'));
    }

    public function update(Request $request, Galeri $galeri)
    {
        $request->validate([
            'judul'      => 'required|string|max:255',
            'file_path'  => 'nullable|image|mimes:jpeg,png,jpg,gif|max:3072',
            'kategori'   => 'nullable|string|max:100',
            'keterangan' => 'nullable|string',
        ]);

        $data = [
            'judul'      => $request->judul,
            'kategori'   => $request->kategori,
            'keterangan' => $request->keterangan,
        ];

        if ($request->hasFile('file_path')) {
            Storage::disk('public')->delete($galeri->file_path);
            $data['file_path'] = $request->file('file_path')->store('galeri', 'public');
        }

        $galeri->update($data);

        return redirect()->route('admin.galeri.index')
                         ->with('success', 'Galeri berhasil diperbarui!');
    }

    public function destroy(Galeri $galeri)
    {
        Storage::disk('public')->delete($galeri->file_path);
        $galeri->delete();
        return redirect()->route('admin.galeri.index')
                         ->with('success', 'Foto berhasil dihapus!');
    }
}