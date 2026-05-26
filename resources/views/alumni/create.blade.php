<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Tambah Alumni</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #f5f7fa;">

<div class="container mt-5">

    <div class="card shadow-lg border-0 rounded-4">

        <div class="card-header bg-success text-white rounded-top-4">

            <h3>Tambah Data Alumni</h3>

        </div>

        <div class="card-body">

            <form action="/alumni" method="POST">

                @csrf

                <div class="mb-3">
                    <label>Nama</label>

                    <input type="text"
                           name="nama"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>NIM</label>

                    <input type="text"
                           name="nim"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Jurusan</label>

                    <input type="text"
                           name="jurusan"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Angkatan</label>

                    <input type="text"
                           name="angkatan"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Tahun Lulus</label>

                    <input type="number"
                           name="tahun_lulus"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Email</label>

                    <input type="email"
                           name="email"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Pekerjaan</label>

                    <input type="text"
                           name="pekerjaan"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Alamat</label>

                    <textarea
                        name="alamat"
                        class="form-control"
                        rows="4"></textarea>
                </div>

                <button type="submit"
                        class="btn btn-success">
                    Simpan
                </button>

                <a href="/alumni"
                   class="btn btn-secondary">
                   Kembali
                </a>

            </form>

        </div>

    </div>

</div>

</body>
</html>