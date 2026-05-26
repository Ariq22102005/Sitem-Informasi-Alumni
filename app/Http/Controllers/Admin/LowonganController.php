<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Lowongan;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LowonganController extends Controller
{
    public function index(Request $request): View
    {
        $query = Lowongan::query();

        if ($request->filled('search')) {
            $search = $request->string('search')->toString();
            $query->where(function ($q) use ($search) {
                $q->where('posisi', 'like', "%{$search}%")
                    ->orWhere('perusahaan', 'like', "%{$search}%")
                    ->orWhere('lokasi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        $lowongans = $query->latest()->paginate(10)->withQueryString();

        return view('admin.lowongan.index', compact('lowongans'));
    }

    public function create(): View
    {
        return view('admin.lowongan.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validateLowongan($request);
        $validated['status'] = $validated['status'] ?? 'aktif';

        Lowongan::create($validated);

        return redirect()
            ->route('admin.lowongan.index')
            ->with('success', 'Lowongan kerja berhasil diposting.');
    }

    public function show(Lowongan $lowongan): View
    {
        return view('admin.lowongan.show', compact('lowongan'));
    }

    public function edit(Lowongan $lowongan): View
    {
        return view('admin.lowongan.edit', compact('lowongan'));
    }

    public function update(Request $request, Lowongan $lowongan): RedirectResponse
    {
        $lowongan->update($this->validateLowongan($request));

        return redirect()
            ->route('admin.lowongan.index')
            ->with('success', 'Lowongan kerja berhasil diperbarui.');
    }

    public function destroy(Lowongan $lowongan): RedirectResponse
    {
        $lowongan->delete();

        return redirect()
            ->route('admin.lowongan.index')
            ->with('success', 'Lowongan kerja berhasil dihapus.');
    }

    public function toggleStatus(Lowongan $lowongan): RedirectResponse
    {
        $lowongan->update([
            'status' => $lowongan->status === 'aktif' ? 'tutup' : 'aktif',
        ]);

        return back()->with('success', 'Status lowongan berhasil diubah.');
    }

    /**
     * @return array<string, mixed>
     */
    private function validateLowongan(Request $request): array
    {
        return $request->validate([
            'posisi' => 'required|string|max:255',
            'perusahaan' => 'required|string|max:255',
            'tipe' => 'nullable|string|in:full_time,part_time,magang,freelance',
            'lokasi' => 'nullable|string|max:255',
            'gaji' => 'nullable|string|max:100',
            'batas_lamar' => 'nullable|date',
            'link_lamar' => 'nullable|url|max:500',
            'kontak' => 'nullable|string|max:255',
            'deskripsi' => 'required|string',
            'kualifikasi' => 'nullable|string',
            'status' => 'nullable|string|in:aktif,tutup',
        ]);
    }
}
