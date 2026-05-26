@php
    $lowongan = $lowongan ?? null;
@endphp

<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">Judul / Posisi Pekerjaan <span class="text-danger">*</span></label>
        <input type="text" name="posisi" class="form-control @error('posisi') is-invalid @enderror"
               value="{{ old('posisi', $lowongan->posisi ?? '') }}" required>
        @error('posisi')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label class="form-label">Nama Perusahaan <span class="text-danger">*</span></label>
        <input type="text" name="perusahaan" class="form-control @error('perusahaan') is-invalid @enderror"
               value="{{ old('perusahaan', $lowongan->perusahaan ?? '') }}" required>
        @error('perusahaan')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Tipe Pekerjaan</label>
        <select name="tipe" class="form-select @error('tipe') is-invalid @enderror">
            @foreach (\App\Models\Lowongan::TIPE_OPTIONS as $value => $label)
                <option value="{{ $value }}" @selected(old('tipe', $lowongan->tipe ?? 'full_time') === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('tipe')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Lokasi</label>
        <input type="text" name="lokasi" class="form-control @error('lokasi') is-invalid @enderror"
               value="{{ old('lokasi', $lowongan->lokasi ?? '') }}" placeholder="Jakarta, Remote, dll.">
        @error('lokasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Estimasi Gaji</label>
        <input type="text" name="gaji" class="form-control @error('gaji') is-invalid @enderror"
               value="{{ old('gaji', $lowongan->gaji ?? '') }}" placeholder="Rp 5.000.000 - 8.000.000">
        @error('gaji')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Batas Lamaran</label>
        <input type="date" name="batas_lamar" class="form-control @error('batas_lamar') is-invalid @enderror"
               value="{{ old('batas_lamar', isset($lowongan->batas_lamar) ? $lowongan->batas_lamar->format('Y-m-d') : '') }}">
        @error('batas_lamar')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Status</label>
        <select name="status" class="form-select @error('status') is-invalid @enderror">
            <option value="aktif" @selected(old('status', $lowongan->status ?? 'aktif') === 'aktif')>Aktif</option>
            <option value="tutup" @selected(old('status', $lowongan->status ?? '') === 'tutup')>Ditutup</option>
        </select>
        @error('status')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-4">
        <label class="form-label">Kontak (email/telepon)</label>
        <input type="text" name="kontak" class="form-control @error('kontak') is-invalid @enderror"
               value="{{ old('kontak', $lowongan->kontak ?? '') }}">
        @error('kontak')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label">Link Lamar Online</label>
        <input type="url" name="link_lamar" class="form-control @error('link_lamar') is-invalid @enderror"
               value="{{ old('link_lamar', $lowongan->link_lamar ?? '') }}" placeholder="https://...">
        @error('link_lamar')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label">Deskripsi Tugas <span class="text-danger">*</span></label>
        <textarea name="deskripsi" rows="5" class="form-control @error('deskripsi') is-invalid @enderror" required>{{ old('deskripsi', $lowongan->deskripsi ?? '') }}</textarea>
        @error('deskripsi')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label class="form-label">Persyaratan / Kualifikasi</label>
        <textarea name="kualifikasi" rows="4" class="form-control @error('kualifikasi') is-invalid @enderror">{{ old('kualifikasi', $lowongan->kualifikasi ?? '') }}</textarea>
        @error('kualifikasi')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
</div>
