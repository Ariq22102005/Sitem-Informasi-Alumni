<?php

namespace App\Http\Controllers;

use App\Models\DonasiAlumni;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDonasiController extends Controller
{
    public function index(Request $request): View
    {
        $query = DonasiAlumni::query();

        if ($request->filled('search')) {
            $search = $request->string('search')->toString();
            $query->where(function ($q) use ($search) {
                $q->where('nama_donatur', 'like', "%{$search}%")
                    ->orWhere('program_studi', 'like', "%{$search}%");
            });
        }

        $donasis = $query->latest()->paginate(10)->withQueryString();

        return view('admin.donasi.index', compact('donasis'));
    }

    public function create(): View
    {
        return view('admin.donasi.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'nama_donatur'  => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'jumlah_donasi' => 'required|numeric|min:1000',
            'catatan'       => 'nullable|string|max:2000',
        ]);

        DonasiAlumni::create($validated);

        return redirect()
            ->route('admin.donasi.index')
            ->with('success', 'Data donasi berhasil ditambahkan!');
    }

    public function show(DonasiAlumni $donasi): View
    {
        return view('admin.donasi.show', compact('donasi'));
    }

    public function edit(DonasiAlumni $donasi): View
    {
        return view('admin.donasi.edit', compact('donasi'));
    }

    public function update(Request $request, DonasiAlumni $donasi): RedirectResponse
    {
        $validated = $request->validate([
            'nama_donatur'  => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'jumlah_donasi' => 'required|numeric|min:1000',
            'catatan'       => 'nullable|string|max:2000',
        ]);

        $donasi->update($validated);

        return redirect()
            ->route('admin.donasi.index')
            ->with('success', 'Data donasi berhasil diperbarui!');
    }

    public function destroy(DonasiAlumni $donasi): RedirectResponse
    {
        $donasi->delete();

        return redirect()
            ->route('admin.donasi.index')
            ->with('success', 'Data donasi berhasil dihapus!');
    }
}

