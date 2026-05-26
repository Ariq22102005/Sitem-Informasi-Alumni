<?php

namespace App\Http\Controllers;

use App\Models\DonasiAlumni;
use Illuminate\Http\Request;

class DonasiAlumniController extends Controller
{
    /**
     * Tampilkan daftar riwayat donasi.
     * 1. Ambil semua data donasi (READ)
     */
    public function index(Request $request)
    {
        // Mengambil semua data donasi alumni dan mengurutkannya dari yang terbaru
        $donasi = DonasiAlumni::orderBy('created_at', 'desc')->get();

        // Jika dipanggil dari API, kembalikan JSON sesuai kebutuhan frontend.
        // Frontend di `resources/views/donasi/index.blade.php` mengharapkan `response.data`.
        if ($request->wantsJson() || $request->is('api/*')) {
            return response()->json([
                'status'  => 'success',
                'message' => 'Data donasi berhasil dimuat!',
                'data'    => $donasi,
            ], 200);
        }

        // Untuk route web, tampilkan halaman.
        return view('donasi.index', compact('donasi'));
    }

    /**
     * Simpan data donasi baru ke dalam database.
     * 2. Simpan produk baru (CREATE)
     */
    public function store(Request $request)
    {
        // Aturan validasi data input dari frontend
        $request->validate([
            'nama_donatur'  => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'jumlah_donasi' => 'required|numeric|min:1000', // Harus berupa angka dan minimal Rp 1.000
            'catatan'       => 'nullable|string',
        ]);

        // Menyimpan data donasi menggunakan mass assignment fillable dari model
        $donasi = DonasiAlumni::create([
            'nama_donatur'  => $request->nama_donatur,
            'program_studi' => $request->program_studi,
            'jumlah_donasi' => $request->jumlah_donasi,
            'catatan'       => $request->catatan,
        ]);

        // Mengembalikan respon sukses berformat JSON dengan HTTP Status Code 201 Created
        return response()->json([
            'status'  => 'success',
            'message' => 'Data donasi berhasil ditambahkan!',
            'data'    => $donasi
        ], 201);
    }

    /**
     * Update data donasi berdasarkan ID.
     * 3. Perbarui data donasi (UPDATE)
     */
    public function update(Request $request, $id)
    {
        // Mencari entitas data donasi berdasarkan ID primary key
        $donasi = DonasiAlumni::find($id);

        // Jika data donasi tidak ditemukan di database, kembalikan HTTP Status Code 404 Not Found
        if (!$donasi) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data donasi tidak ditemukan!'
            ], 404);
        }

        // Aturan validasi data input dari frontend
        $request->validate([
            'nama_donatur'  => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'jumlah_donasi' => 'required|numeric|min:1000',
            'catatan'       => 'nullable|string',
        ]);

        // Memperbarui data donasi
        $donasi->update([
            'nama_donatur'  => $request->nama_donatur,
            'program_studi' => $request->program_studi,
            'jumlah_donasi' => $request->jumlah_donasi,
            'catatan'       => $request->catatan,
        ]);

        return redirect()->route('admin.donasi.edit', $donasi->id)
            ->with('success', 'Data donasi berhasil diperbarui!');
    }

    /**
     * Hapus data donasi dari database berdasarkan ID.
     * 4. Hapus data donasi (DELETE)
     */
    public function destroy($id)
    {
        // Mencari entitas data donasi berdasarkan ID primary key
        $donasi = DonasiAlumni::find($id);

        // Jika data donasi tidak ditemukan di database, kembalikan HTTP Status Code 404 Not Found
        if (!$donasi) {
            return response()->json([
                'status'  => 'error',
                'message' => 'Data donasi tidak ditemukan!'
            ], 404);
        }

        // Mengeksekusi penghapusan data donasi
        $donasi->delete();

        // Mengembalikan respon sukses berformat JSON dengan HTTP Status Code 200 OK
        return response()->json([
            'status'  => 'success',
            'message' => 'Data donasi berhasil dihapus.'
        ], 200);
    }
}