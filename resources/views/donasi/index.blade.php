@extends('layouts.app')

@section('title', 'Donasi Alumni')
@section('content')
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <style>
        *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

        :root {
            --cream: var(--app-bg);
            --warm-white: var(--app-surface);
            --amber: var(--app-primary);
            --amber-deep: var(--app-primary-2);
            --amber-light: var(--app-primary);
            --teal: var(--app-info);
            --teal-light: var(--app-info);
            --teal-pale: rgba(14,165,233,0.12);
            --red-soft: #E8504A;
            --red-pale: #FFF0EF;
            --dark: var(--app-text);
            --text-body: var(--app-text);
            --text-muted: var(--app-muted);
            --border: var(--app-border);
        }

        body {
            font-family: 'Nunito', sans-serif;
            background: var(--app-bg);
            color: var(--app-text);
            min-height: 100vh;
            overflow-x: hidden;
        }

        /* Hero Header */
        .hero {
            background: linear-gradient(135deg, var(--amber) 0%, var(--amber-deep) 55%, var(--teal) 100%);
            position: relative;
            overflow: hidden;
            padding: 48px 40px 60px;
        }

        .hero::before {
            content: '';
            position: absolute;
            top: -80px; right: -80px;
            width: 320px; height: 320px;
            background: radial-gradient(circle, rgba(232,164,74,0.25) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero::after {
            content: '';
            position: absolute;
            bottom: -60px; left: 10%;
            width: 200px; height: 200px;
            background: radial-gradient(circle, rgba(61,160,141,0.2) 0%, transparent 70%);
            border-radius: 50%;
        }

        .hero-inner {
            max-width: 1100px;
            margin: 0 auto;
            position: relative;
            z-index: 1;
        }

        .hero-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(232,164,74,0.15);
            border: 1px solid rgba(232,164,74,0.4);
            color: var(--amber-light);
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            padding: 6px 14px;
            border-radius: 100px;
            margin-bottom: 20px;
        }

        .hero-badge::before {
            content: '♥';
            font-size: 10px;
        }

        .hero h1 {
            font-family: 'Playfair Display', serif;
            font-size: clamp(32px, 5vw, 52px);
            font-weight: 900;
            color: #fff;
            line-height: 1.1;
            margin-bottom: 12px;
        }

        .hero h1 span {
            color: var(--amber);
        }

        .hero p {
            color: rgba(255,255,255,0.55);
            font-size: 14px;
            font-weight: 300;
            letter-spacing: 0.3px;
        }

        .hero-ornament {
            position: absolute;
            right: 40px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 120px;
            opacity: 0.06;
            line-height: 1;
            pointer-events: none;
        }

        /* Stats Bar */
        .stats-bar {
            background: var(--warm-white);
            border-bottom: 1px solid var(--border);
            padding: 0 40px;
        }

        .stats-inner {
            max-width: 1100px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 0;
        }

        .stat-item {
            padding: 28px 24px;
            border-right: 1px solid var(--border);
            position: relative;
            transition: background 0.2s;
        }

        .stat-item:last-child { border-right: none; }

        .stat-item:hover { background: var(--cream); }

        .stat-label {
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1.5px;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .stat-value {
            font-family: 'Playfair Display', serif;
            font-size: 28px;
            font-weight: 700;
            color: var(--dark);
            line-height: 1;
        }

        .stat-value.green { color: var(--teal); }
        .stat-value.amber { color: var(--amber-deep); }

        .stat-accent {
            width: 32px;
            height: 3px;
            border-radius: 2px;
            margin-top: 10px;
        }

        /* Main Content */
        .main {
            max-width: 1100px;
            margin: 0 auto;
            padding: 40px;
            display: grid;
            grid-template-columns: 380px 1fr;
            gap: 28px;
            align-items: start;
        }

        /* Form Card */
        .form-card {
            background: var(--warm-white);
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(26,26,46,0.06);
        }

        .form-card-header {
            background: linear-gradient(135deg, var(--teal) 0%, var(--teal-light) 100%);
            padding: 24px 28px;
            position: relative;
            overflow: hidden;
        }

        .form-card-header::after {
            content: '🤲';
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            font-size: 40px;
            opacity: 0.3;
        }

        .form-card-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 700;
            color: #fff;
            margin-bottom: 4px;
        }

        .form-card-header p {
            font-size: 12px;
            color: rgba(255,255,255,0.7);
        }

        .form-body {
            padding: 28px;
        }

        .field {
            margin-bottom: 20px;
        }

        .field label {
            display: block;
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: var(--text-muted);
            margin-bottom: 8px;
        }

        .field input,
        .field textarea {
            width: 100%;
            padding: 12px 16px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            color: var(--dark);
            background: var(--cream);
            transition: all 0.2s;
            outline: none;
        }

        .field input:focus,
        .field textarea:focus {
            border-color: var(--teal);
            background: #fff;
            box-shadow: 0 0 0 3px rgba(42,127,111,0.1);
        }

        .field textarea { resize: vertical; min-height: 90px; }

        .field input::placeholder,
        .field textarea::placeholder { color: var(--text-muted); }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: linear-gradient(135deg, var(--amber) 0%, var(--amber-deep) 100%);
            color: #fff;
            font-family: 'DM Sans', sans-serif;
            font-size: 14px;
            font-weight: 600;
            letter-spacing: 0.5px;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.25s;
            box-shadow: 0 4px 16px rgba(200,135,42,0.35);
            position: relative;
            overflow: hidden;
        }

        .btn-submit:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 24px rgba(200,135,42,0.45);
        }

        .btn-submit:active { transform: translateY(0); }

        .btn-submit .btn-icon { margin-right: 8px; }

        /* Table Card */
        .table-card {
            background: var(--warm-white);
            border: 1px solid var(--border);
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 24px rgba(26,26,46,0.06);
        }

        .table-card-header {
            padding: 24px 28px 20px;
            border-bottom: 1px solid var(--border);
            display: flex;
            align-items: center;
            justify-content: space-between;
        }

        .table-card-header h2 {
            font-family: 'Playfair Display', serif;
            font-size: 20px;
            font-weight: 700;
            color: var(--dark);
        }

        .table-card-header p {
            font-size: 12px;
            color: var(--text-muted);
            margin-top: 3px;
        }

        .api-badge {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: var(--teal-pale);
            color: var(--teal);
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
            padding: 5px 12px;
            border-radius: 100px;
            border: 1px solid rgba(42,127,111,0.2);
        }

        .api-badge::before {
            content: '';
            width: 6px; height: 6px;
            background: var(--teal);
            border-radius: 50%;
            animation: pulse 1.5s ease-in-out infinite;
        }

        @keyframes pulse {
            0%, 100% { opacity: 1; transform: scale(1); }
            50% { opacity: 0.5; transform: scale(0.8); }
        }

        /* Table */
        .table-wrap { overflow-x: auto; }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead tr {
            background: var(--cream);
            border-bottom: 1px solid var(--border);
        }

        thead th {
            padding: 12px 20px;
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 1.2px;
            text-transform: uppercase;
            color: var(--text-muted);
            text-align: left;
        }

        tbody tr {
            border-bottom: 1px solid var(--border);
            transition: background 0.15s;
        }

        tbody tr:last-child { border-bottom: none; }
        tbody tr:hover { background: var(--cream); }

        tbody td {
            padding: 16px 20px;
            font-size: 14px;
            vertical-align: middle;
        }

        .td-name {
            font-weight: 600;
            color: var(--dark);
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .avatar {
            width: 32px; height: 32px;
            border-radius: 50%;
            background: linear-gradient(135deg, var(--amber) 0%, var(--amber-deep) 100%);
            display: flex; align-items: center; justify-content: center;
            font-size: 12px; font-weight: 700; color: #fff;
            flex-shrink: 0;
        }

        .td-prodi {
            color: var(--text-muted);
            font-size: 13px;
        }

        .td-amount {
            font-weight: 700;
            color: var(--teal);
            font-family: 'Playfair Display', serif;
            font-size: 15px;
        }

        .td-catatan {
            color: var(--text-muted);
            font-size: 12px;
            font-style: italic;
            max-width: 160px;
        }

        .btn-delete {
            padding: 6px 14px;
            background: var(--red-pale);
            color: var(--red-soft);
            border: 1px solid rgba(232,80,74,0.2);
            border-radius: 8px;
            font-family: 'DM Sans', sans-serif;
            font-size: 12px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
        }

        .btn-delete:hover {
            background: var(--red-soft);
            color: #fff;
            border-color: var(--red-soft);
        }

        .empty-state {
            text-align: center;
            padding: 60px 20px;
            color: var(--text-muted);
        }

        .empty-state .empty-icon {
            font-size: 48px;
            margin-bottom: 12px;
            opacity: 0.5;
        }

        .empty-state p {
            font-size: 14px;
        }

        /* Toast */
        .toast {
            position: fixed;
            bottom: 32px; right: 32px;
            background: var(--dark);
            color: #fff;
            padding: 14px 20px;
            border-radius: 12px;
            font-size: 13px;
            font-weight: 500;
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
            transform: translateY(80px);
            opacity: 0;
            transition: all 0.35s cubic-bezier(0.34, 1.56, 0.64, 1);
            z-index: 999;
            max-width: 320px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .toast.show {
            transform: translateY(0);
            opacity: 1;
        }

        .toast.success { border-left: 4px solid var(--teal); }
        .toast.error { border-left: 4px solid var(--red-soft); }

        /* Footer */
        footer {
            text-align: center;
            padding: 24px 40px 40px;
            font-size: 12px;
            color: var(--text-muted);
        }

        footer span { color: var(--amber-deep); }

        @media (max-width: 768px) {
            .hero { padding: 32px 20px 40px; }
            .stats-inner { grid-template-columns: 1fr; }
            .stat-item { border-right: none; border-bottom: 1px solid var(--border); }
            .main { grid-template-columns: 1fr; padding: 20px; }
            .hero-ornament { display: none; }
        }
    </style>

    <!-- Hero -->
    <div class="hero">
        <div class="hero-ornament">♥</div>
        <div class="hero-inner">
            <div class="hero-badge">Kelompok PRJ-14 · Mellinna Husadya</div>
            <h1>Modul <span>Donasi</span><br>Alumni</h1>
            <p>Sistem Informasi Alumni — Berbagi untuk masa depan yang lebih baik</p>
        </div>
    </div>

    <!-- Stats -->
    <div class="stats-bar">
        <div class="stats-inner">
            <div class="stat-item">
                <div class="stat-label">Total Dana Terkumpul</div>
                <div class="stat-value amber" id="totalDana">Rp 0</div>
                <div class="stat-accent" style="background: var(--amber);"></div>
            </div>
            <div class="stat-item">
                <div class="stat-label">Jumlah Donatur</div>
                <div class="stat-value" id="totalDonatur">0 Orang</div>
                <div class="stat-accent" style="background: var(--dark);"></div>
            </div>
            <div class="stat-item">
                <div class="stat-label">Rata-rata Donasi</div>
                <div class="stat-value green" id="rataRata">Rp 0</div>
                <div class="stat-accent" style="background: var(--teal);"></div>
            </div>
        </div>
    </div>

    <!-- Main -->
    <div class="main">
        <!-- Form -->
        <div class="form-card">
            <div class="form-card-header">
                <h2>Tambah Donasi Baru</h2>
                <p>Input data donasi alumni secara real-time</p>
            </div>
            <div class="form-body">
                <form id="donasiForm">
                    <div class="field">
                        <label>Nama Donatur</label>
                        <input type="text" id="nama_donatur" placeholder="Nama lengkap / Anonim" required>
                    </div>
                    <div class="field">
                        <label>Program Studi</label>
                        <input type="text" id="program_studi" placeholder="Contoh: Sistem Informasi" required>
                    </div>
                    <div class="field">
                        <label>Jumlah Donasi (Rp)</label>
                        <input type="number" id="jumlah_donasi" placeholder="Contoh: 500000" required>
                    </div>
                    <div class="field">
                        <label>Catatan / Pesan</label>
                        <textarea id="catatan" placeholder="Pesan opsional dari alumni..."></textarea>
                    </div>
                    <button type="submit" class="btn-submit">
                        <span class="btn-icon">💛</span> Simpan via API
                    </button>
                </form>
            </div>
        </div>

        <!-- Table -->
        <div class="table-card">
            <div class="table-card-header">
                <div>
                    <h2>Daftar Riwayat Donasi</h2>
                    <p>Menampilkan seluruh log transaksi asinkron tanpa reload</p>
                </div>
                <div class="api-badge">RESTful API Modern Connected</div>
            </div>
            <div class="table-wrap">
                <table id="donasiTable">
                    <thead>
                        <tr>
                            <th>Donatur</th>
                            <th>Prodi</th>
                            <th>Jumlah</th>
                            <th>Catatan</th>
                            <th style="text-align:center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Toast -->
    <div class="toast" id="toast"></div>

    <script>
        $(document).ready(function () {
            const apiUrl = '/api/donasi-alumni';

            function showToast(msg, type = 'success') {
                const icon = type === 'success' ? '✅' : '❌';
                $('#toast').attr('class', 'toast ' + type).html(icon + ' ' + msg).addClass('show');
                setTimeout(() => $('#toast').removeClass('show'), 3500);
            }

            function formatRupiah(num) {
                return 'Rp ' + parseInt(num).toLocaleString('id-ID');
            }

            function getInitial(name) {
                return name ? name.charAt(0).toUpperCase() : '?';
            }

            function updateStats(data) {
                const total = data.reduce((sum, d) => sum + parseInt(d.jumlah_donasi), 0);
                const rata = data.length ? Math.round(total / data.length) : 0;
                $('#totalDana').text(formatRupiah(total));
                $('#totalDonatur').text(data.length + ' Orang');
                $('#rataRata').text(formatRupiah(rata));
            }

            // FUNCTION 1: GET
            function loadDonasi() {
                $.ajax({
                    url: apiUrl,
                    type: 'GET',
                    success: function (response) {
                        updateStats(response.data);
                        let rows = '';
                        if (response.data.length === 0) {
                            rows = `<tr><td colspan="5">
                                <div class="empty-state">
                                    <div class="empty-icon">🤲</div>
                                    <p>Belum ada data donasi masuk.<br>Jadilah yang pertama berdonasi!</p>
                                </div>
                            </td></tr>`;
                        } else {
                            $.each(response.data, function (i, item) {
                                rows += `
                                <tr>
                                    <td><div class="td-name">
                                        <div class="avatar">${getInitial(item.nama_donatur)}</div>
                                        ${item.nama_donatur}
                                    </div></td>
                                    <td class="td-prodi">${item.program_studi}</td>
                                    <td class="td-amount">${formatRupiah(item.jumlah_donasi)}</td>
                                    <td class="td-catatan">${item.catatan || '—'}</td>
                                    <td style="text-align:center">
                                        <button class="btn-delete" data-id="${item.id}">Hapus</button>
                                    </td>
                                </tr>`;
                            });
                        }
                        $('#donasiTable tbody').html(rows);
                    },
                    error: function () {
                        showToast('Gagal memuat data dari server.', 'error');
                    }
                });
            }

            loadDonasi();

            // FUNCTION 2: POST
            $('#donasiForm').submit(function (e) {
                e.preventDefault();
                const formData = {
                    nama_donatur: $('#nama_donatur').val(),
                    program_studi: $('#program_studi').val(),
                    jumlah_donasi: $('#jumlah_donasi').val(),
                    catatan: $('#catatan').val()
                };
                $.ajax({
                    url: apiUrl,
                    type: 'POST',
                    headers: {
                        'Accept': 'application/json',
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    data: JSON.stringify(formData),
                    success: function (response) {
                        showToast(response.message || 'Donasi berhasil disimpan!');
                        $('#donasiForm')[0].reset();
                        loadDonasi();
                    },
                    error: function (err) {
                        if (err.status === 422) {
                            const errors = err.responseJSON.errors;
                            const msg = Object.values(errors).map(e => e[0]).join(', ');
                            showToast('Validasi gagal: ' + msg, 'error');
                        } else {
                            showToast('Gagal menyimpan data (Status: ' + err.status + ')', 'error');
                        }
                    }
                });
            });

            // FUNCTION 3: DELETE
            $('#donasiTable').on('click', '.btn-delete', function () {
                if (confirm('Apakah Anda yakin ingin menghapus data donasi ini?')) {
                    const id = $(this).data('id');
                    $.ajax({
                        url: `${apiUrl}/${id}`,
                        type: 'DELETE',
                        success: function (response) {
                            showToast(response.message || 'Data berhasil dihapus.');
                            loadDonasi();
                        },
                        error: function () {
                            showToast('Gagal menghapus data.', 'error');
                        }
                    });
                }
            });
        });
    </script>
@endsection