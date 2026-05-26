<?php

namespace App\Http\Controllers;

use App\Models\Lowongan;
use Illuminate\Http\Request;
use Illuminate\View\View;

class LowonganKerjaController extends Controller
{
    public function index(Request $request): View
    {
        $query = Lowongan::aktif();

        if ($request->filled('search')) {
            $search = $request->string('search')->toString();
            $query->where(function ($q) use ($search) {
                $q->where('posisi', 'like', "%{$search}%")
                    ->orWhere('perusahaan', 'like', "%{$search}%")
                    ->orWhere('deskripsi', 'like', "%{$search}%");
            });
        }

        if ($request->filled('tipe')) {
            $query->where('tipe', $request->tipe);
        }

        if ($request->filled('lokasi')) {
            $query->where('lokasi', 'like', '%'.$request->string('lokasi').'%');
        }

        $lowongans = $query->latest()->paginate(9)->withQueryString();

        $lokasiList = Lowongan::aktif()
            ->whereNotNull('lokasi')
            ->where('lokasi', '!=', '')
            ->distinct()
            ->orderBy('lokasi')
            ->pluck('lokasi');

        return view('lowongan.index', compact('lowongans', 'lokasiList'));
    }

    public function show(Lowongan $lowongan): View
    {
        abort_unless($lowongan->isMasihDibuka(), 404);

        $terkait = Lowongan::aktif()
            ->where('id', '!=', $lowongan->id)
            ->where(function ($q) use ($lowongan) {
                $q->where('tipe', $lowongan->tipe)
                    ->orWhere('lokasi', $lowongan->lokasi);
            })
            ->latest()
            ->limit(3)
            ->get();

        return view('lowongan.show', compact('lowongan', 'terkait'));
    }
}
