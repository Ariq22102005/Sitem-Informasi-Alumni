<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Detail Alumni</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body style="background-color: #f5f7fa;">

<div class="container mt-5">

    <div class="card shadow-lg border-0 rounded-4">

        <div class="card-header bg-info text-white rounded-top-4">

            <h3>Detail Alumni</h3>

        </div>

        <div class="card-body">

            <table class="table">

                <tr>
                    <th>Nama</th>
                    <td>{{ $alumni->nama }}</td>
                </tr>

                <tr>
                    <th>NIM</th>
                    <td>{{ $alumni->nim }}</td>
                </tr>

                <tr>
                    <th>Jurusan</th>
                    <td>{{ $alumni->jurusan }}</td>
                </tr>

                <tr>
                    <th>Angkatan</th>
                    <td>{{ $alumni->angkatan }}</td>
                </tr>

                <tr>
                    <th>Tahun Lulus</th>
                    <td>{{ $alumni->tahun_lulus }}</td>
                </tr>

                <tr>
                    <th>Email</th>
                    <td>{{ $alumni->email }}</td>
                </tr>

                <tr>
                    <th>Pekerjaan</th>
                    <td>{{ $alumni->pekerjaan }}</td>
                </tr>

                <tr>
                    <th>Alamat</th>
                    <td>{{ $alumni->alamat }}</td>
                </tr>

            </table>

            <a href="/alumni"
               class="btn btn-secondary">
               Kembali
            </a>

        </div>

    </div>

</div>

</body>
</html>