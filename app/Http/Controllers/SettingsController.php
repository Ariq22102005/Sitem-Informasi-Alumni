<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Halaman settings
     */
    public function index()
    {
        return view('admin.settings');
    }

    /**
     * Update profile user
     */
    public function updateProfile(Request $request)
    {
        $request->validate([
            'name'  => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . Auth::id(),
        ]);

        $user = Auth::user();

        $user->update([
            'name'  => $request->name,
            'email' => $request->email,
        ]);

        return redirect()
            ->route('admin.settings')
            ->with('success', 'Profil berhasil diperbarui!');
    }

    /**
     * Update password
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required',
            'password'         => 'required|string|min:8|confirmed',
        ]);

        // cek password lama
        if (!Hash::check($request->current_password, Auth::user()->password)) {
            return back()->withErrors([
                'current_password' => 'Password lama tidak sesuai.',
            ]);
        }

        // update password baru
        Auth::user()->update([
            'password' => Hash::make($request->password),
        ]);

        return redirect()
            ->route('admin.settings')
            ->with('success', 'Password berhasil diubah!');
    }

    /**
     * Update pengaturan website
     */
    public function updateWebsite(Request $request)
    {
        $request->validate([
            'site_name'        => 'nullable|string|max:255',
            'institution_name' => 'nullable|string|max:255',
            'contact_email'    => 'nullable|email',
            'contact_phone'    => 'nullable|string|max:20',
            'address'          => 'nullable|string',
        ]);

        // sementara dummy success
        // nanti bisa disimpan ke tabel settings

        return redirect()
            ->route('admin.settings')
            ->with('success', 'Pengaturan website berhasil disimpan!');
    }
}