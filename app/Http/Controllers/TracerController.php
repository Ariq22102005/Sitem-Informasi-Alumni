<?php

namespace App\Http\Controllers;

use App\Models\TracerStudy;
use App\Models\Alumni;
use Illuminate\Http\Request;

class TracerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $query = TracerStudy::with('alumni')->latest();

        if ($request->filled('search')) {
            $query->where('nama_alumni', 'like', '%' . $request->search . '%');
        }

        $tracers       = $query->paginate(15);
        $totalResponden = TracerStudy::count();
        $bekerja        = TracerStudy::where('status_kerja', 'bekerja')->count();
        $wirausaha      = TracerStudy::where('status_kerja', 'wirausaha')->count();
        $lanjutStudi    = TracerStudy::where('status_kerja', 'melanjutkan_studi')->count();
        $belumBekerja   = TracerStudy::where('status_kerja', 'belum_bekerja')->count();

        return view('admin.tracer.index', compact(
            'tracers', 'totalResponden', 'bekerja', 'wirausaha', 'lanjutStudi', 'belumBekerja'
        ));
    }

    public function show(TracerStudy $tracer)
    {
        return view('admin.tracer.show', compact('tracer'));
    }

    public function destroy(TracerStudy $tracer)
    {
        $tracer->delete();
        return redirect()->route('admin.tracer.index')
                         ->with('success', 'Data tracer study berhasil dihapus!');
    }

    public function export()
    {
        $tracers = TracerStudy::with('alumni')->get();

        $filename = 'tracer-study-' . date('Ymd') . '.csv';
        $headers  = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => "attachment; filename=\"$filename\"",
        ];

        $callback = function () use ($tracers) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['Nama Alumni', 'Angkatan', 'Status Kerja', 'Perusahaan', 'Jabatan', 'Gaji Awal', 'Bulan Tunggu', 'Relevan', 'Komentar', 'Tahun Isi']);
            foreach ($tracers as $t) {
                fputcsv($file, [
                    $t->nama_alumni,
                    $t->angkatan,
                    $t->status_kerja,
                    $t->perusahaan,
                    $t->jabatan,
                    $t->gaji_awal,
                    $t->bulan_tunggu_kerja,
                    $t->relevan_dengan_studi ? 'Ya' : 'Tidak',
                    $t->komentar,
                    $t->created_at ? $t->created_at->format('Y') : '',
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}