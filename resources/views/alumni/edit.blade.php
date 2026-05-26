<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Alumni</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #f5f7fa;">

<div class="container mt-5">

    <div class="card shadow-lg border-0 rounded-4">

        <div class="card-header bg-warning text-white rounded-top-4">

            <h3>Edit Data Alumni</h3>

        </div>

        <div class="card-body">

            <form action="/alumni/{{ $alumni->id }}" method="POST">

                @csrf
                @method('PUT')

                <div class="mb-3">
                    <label>Nama</label>

                    <input type="text"
                           name="nama"
                           value="{{ $alumni->nama }}"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>NIM</label>

                    <input type="text"
                           name="nim"
                           value="{{ $alumni->nim }}"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Jurusan</label>

                    <input type="text"
                           name="jurusan"
                           value="{{ $alumni->jurusan }}"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Angkatan</label>

                    <input type="text"
                           name="angkatan"
                           value="{{ $alumni->angkatan }}"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Tahun Lulus</label>

                    <input type="number"
                           name="tahun_lulus"
                           value="{{ $alumni->tahun_lulus }}"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Email</label>

                    <input type="email"
                           name="email"
                           value="{{ $alumni->email }}"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Pekerjaan</label>

                    <input type="text"
                           name="pekerjaan"
                           value="{{ $alumni->pekerjaan }}"
                           class="form-control">
                </div>

                <div class="mb-3">
                    <label>Alamat</label>

                    <textarea
                        name="alamat"
                        class="form-control"
                        rows="4">{{ $alumni->alamat }}</textarea>
                </div>

                <button type="submit"
                        class="btn btn-warning text-white">
                    Update
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