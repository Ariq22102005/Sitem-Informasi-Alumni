@extends('layouts.app')

@section('title', 'Donasi Alumni')

@push('styles')
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

<style>
    :root {
        --primary: #5b4bff;
        --primary-dark: #4338ca;
        --primary-light: #7c6cff;
        --bg: #f5f7ff;
        --card: #ffffff;
        --text: #1f2937;
        --text-light: #6b7280;
        --border: #e5e7eb;
        --success: #10b981;
        --danger: #ef4444;
        --shadow: 0 10px 30px rgba(91,75,255,.08);
        --radius: 22px;
    }

    .donasi-wrapper * {
        font-family: 'Poppins', sans-serif;
    }

    .donasi-wrapper {
        background: var(--bg);
        min-height: 100vh;
        padding-bottom: 50px;
    }

    /* HERO */
    .donasi-hero {
        background: linear-gradient(135deg, var(--primary), var(--primary-light));
        padding: 60px 40px;
        border-radius: 0 0 40px 40px;
        color: white;
        position: relative;
        overflow: hidden;
    }

    .donasi-hero::before {
        content: '';
        position: absolute;
        width: 300px;
        height: 300px;
        background: rgba(255,255,255,.08);
        border-radius: 50%;
        top: -100px;
        right: -100px;
    }

    .hero-content {
        max-width: 1200px;
        margin: auto;
        position: relative;
        z-index: 2;
    }

    .hero-badge {
        display: inline-block;
        padding: 8px 18px;
        border-radius: 999px;
        background: rgba(255,255,255,.15);
        margin-bottom: 20px;
        font-size: 13px;
    }

    .hero-title {
        font-size: 52px;
        font-weight: 700;
        margin-bottom: 14px;
    }

    .hero-desc {
        max-width: 700px;
        opacity: .9;
        font-size: 17px;
    }

    /* STATS */
    .stats-grid {
        max-width: 1200px;
        margin: -50px auto 0;
        padding: 0 20px;
        display: grid;
        grid-template-columns: repeat(3,1fr);
        gap: 24px;
        position: relative;
        z-index: 10;
    }

    .stat-card {
        background: white;
        border-radius: var(--radius);
        padding: 28px;
        box-shadow: var(--shadow);
    }

    .stat-label {
        color: var(--text-light);
        font-size: 14px;
        margin-bottom: 10px;
    }

    .stat-value {
        font-size: 32px;
        font-weight: 700;
        color: var(--primary);
    }

    /* MAIN */
    .main-layout {
        max-width: 1200px;
        margin: 40px auto;
        padding: 0 20px;
        display: grid;
        grid-template-columns: 380px 1fr;
        gap: 28px;
    }

    .card-ui {
        background: white;
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        overflow: hidden;
    }

    .card-header-ui {
        background: linear-gradient(135deg, var(--primary), var(--primary-light));
        color: white;
        padding: 24px 28px;
    }

    .card-header-ui h3 {
        font-size: 22px;
        margin-bottom: 5px;
    }

    .card-header-ui p {
        opacity: .9;
        font-size: 14px;
    }

    .card-body-ui {
        padding: 28px;
    }

    /* FORM */
    .field {
        margin-bottom: 22px;
    }

    .field label {
        display: block;
        font-size: 14px;
        font-weight: 600;
        margin-bottom: 8px;
    }

    .field input,
    .field textarea {
        width: 100%;
        border: 1px solid var(--border);
        border-radius: 14px;
        padding: 14px 16px;
        background: #f9faff;
        transition: .3s;
        font-size: 14px;
    }

    .field input:focus,
    .field textarea:focus {
        outline: none;
        border-color: var(--primary);
        background: white;
        box-shadow: 0 0 0 4px rgba(91,75,255,.1);
    }

    .field textarea {
        min-height: 100px;
        resize: vertical;
    }

    .btn-submit {
        width: 100%;
        border: none;
        padding: 15px;
        border-radius: 16px;
        background: linear-gradient(135deg, var(--primary), var(--primary-light));
        color: white;
        font-weight: 600;
        cursor: pointer;
        transition: .3s;
    }

    .btn-submit:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 20px rgba(91,75,255,.2);
    }

    /* TABLE */
    .table-header {
        padding: 24px 28px;
        border-bottom: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .table-header h3 {
        font-size: 22px;
        color: var(--text);
    }

    .api-badge {
        background: rgba(91,75,255,.1);
        color: var(--primary);
        padding: 10px 16px;
        border-radius: 999px;
        font-size: 12px;
        font-weight: 600;
    }

    .table-wrap {
        overflow-x: auto;
    }

    table {
        width: 100%;
        border-collapse: collapse;
    }

    thead {
        background: #f8f9ff;
    }

    th {
        text-align: left;
        padding: 16px 20px;
        font-size: 13px;
        color: var(--text-light);
    }

    td {
        padding: 18px 20px;
        border-top: 1px solid #f1f1f1;
        vertical-align: middle;
    }

    tbody tr:hover {
        background: #fafbff;
    }

    .donatur-box {
        display: flex;
        align-items: center;
        gap: 12px;
    }

    .avatar {
        width: 44px;
        height: 44px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary), var(--primary-light));
        color: white;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: 700;
    }

    .jumlah {
        color: var(--primary);
        font-weight: 700;
    }

    /* TOAST */
    .toast-ui {
        position: fixed;
        bottom: 30px;
        right: 30px;
        background: #111827;
        color: white;
        padding: 16px 22px;
        border-radius: 14px;
        opacity: 0;
        transform: translateY(50px);
        transition: .3s;
        z-index: 9999;
    }

    .toast-ui.show {
        opacity: 1;
        transform: translateY(0);
    }

    @media(max-width: 992px) {
        .main-layout {
            grid-template-columns: 1fr;
        }

        .stats-grid {
            grid-template-columns: 1fr;
        }

        .hero-title {
            font-size: 36px;
        }
    }
</style>
@endpush

@section('content')

<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<div class="donasi-wrapper">

    <!-- HERO -->
    <section class="donasi-hero">
        <div class="hero-content">

            <div class="hero-badge">
                Sistem Informasi Alumni
            </div>

            <h1 class="hero-title">
                Donasi Alumni 💜
            </h1>

            <p class="hero-desc">
                Berbagi kontribusi untuk membangun jaringan alumni yang lebih kuat dan modern.
            </p>

        </div>
    </section>

    <!-- STATS -->
    <div class="stats-grid">

        <div class="stat-card">
            <div class="stat-label">Total Dana</div>
            <div class="stat-value" id="totalDana">Rp 0</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Jumlah Donatur</div>
            <div class="stat-value" id="totalDonatur">0</div>
        </div>

        <div class="stat-card">
            <div class="stat-label">Rata-rata Donasi</div>
            <div class="stat-value" id="rataRata">Rp 0</div>
        </div>

    </div>

    <!-- MAIN -->
    <div class="main-layout">

        <!-- FORM -->
        <div class="card-ui">

            <div class="card-header-ui">
                <h3>Tambah Donasi</h3>
                <p>Input data donasi alumni</p>
            </div>

            <div class="card-body-ui">

                <form id="donasiForm">

                    <div class="field">
                        <label>Nama Donatur</label>
                        <input type="text" id="nama_donatur" required>
                    </div>

                    <div class="field">
                        <label>Program Studi</label>
                        <input type="text" id="program_studi" required>
                    </div>

                    <div class="field">
                        <label>Jumlah Donasi</label>
                        <input type="number" id="jumlah_donasi" required>
                    </div>

                    <div class="field">
                        <label>Catatan</label>
                        <textarea id="catatan"></textarea>
                    </div>

                    <button type="submit" class="btn-submit">
                        Simpan Donasi
                    </button>

                </form>

            </div>

        </div>

        <!-- TABLE -->
        <div class="card-ui">

            <div class="table-header">

                <h3>Riwayat Donasi</h3>

            </div>

            <div class="table-wrap">

                <table id="donasiTable">

                    <thead>
                        <tr>
                            <th>Donatur</th>
                            <th>Program Studi</th>
                            <th>Jumlah</th>
                            <th>Catatan</th>
                        </tr>
                    </thead>

                    <tbody></tbody>

                </table>

            </div>

        </div>

    </div>

</div>

<div class="toast-ui" id="toast"></div>

@endsection

@push('scripts')
<script>

$(document).ready(function () {

    const apiUrl = '/api/donasi-alumni';

    function showToast(message) {

        $('#toast')
            .text(message)
            .addClass('show');

        setTimeout(() => {
            $('#toast').removeClass('show');
        }, 3000);
    }

    function formatRupiah(num) {
        return 'Rp ' + parseInt(num).toLocaleString('id-ID');
    }

    function getInitial(name) {
        return name ? name.charAt(0).toUpperCase() : '?';
    }

    function loadDonasi() {

        $.ajax({
            url: apiUrl,
            type: 'GET',

            success: function(response) {

                let total = 0;

                response.data.forEach(item => {
                    total += parseInt(item.jumlah_donasi);
                });

                $('#totalDana').text(formatRupiah(total));

                $('#totalDonatur').text(response.data.length);

                const rata = response.data.length
                    ? total / response.data.length
                    : 0;

                $('#rataRata').text(formatRupiah(rata));

                let rows = '';

                response.data.forEach(item => {

                    rows += `
                        <tr>

                            <td>
                                <div class="donatur-box">

                                    <div class="avatar">
                                        ${getInitial(item.nama_donatur)}
                                    </div>

                                    <div>
                                        ${item.nama_donatur}
                                    </div>

                                </div>
                            </td>

                            <td>
                                ${item.program_studi}
                            </td>

                            <td class="jumlah">
                                ${formatRupiah(item.jumlah_donasi)}
                            </td>

                            <td>
                                ${item.catatan ?? '-'}
                            </td>

                        </tr>
                    `;
                });

                $('#donasiTable tbody').html(rows);

            }
        });

    }

    loadDonasi();

    // CREATE ONLY
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
            data: formData,

            success: function () {

                showToast('Donasi berhasil ditambahkan');

                $('#donasiForm')[0].reset();

                loadDonasi();
            },

            error: function () {
                showToast('Gagal menambahkan donasi');
            }
        });

    });

});
</script>
@endpush