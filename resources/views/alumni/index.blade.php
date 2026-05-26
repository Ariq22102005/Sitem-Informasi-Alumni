<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dashboard Alumni</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Poppins -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <style>

        body{
            background: #f4f7f4;
            font-family: 'Poppins', sans-serif;
        }

        .navbar-custom{
            background: #6b8f71;
            padding: 18px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.08);
        }

        .navbar-title{
            color: white;
            font-size: 28px;
            font-weight: 600;
            margin: 0;
        }

        .dashboard-card{
            background: white;
            border-radius: 20px;
            padding: 25px;
            box-shadow: 0 5px 18px rgba(0,0,0,0.06);
            border: none;
        }

        .stats-card{
            background: linear-gradient(
                135deg,
                #7a9e7e,
                #5f7d63
            );

            color: white;

            border-radius: 20px;

            padding: 25px;

            box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        }

        .stats-number{
            font-size: 40px;
            font-weight: 700;
        }

        .table{
            vertical-align: middle;
        }

        .table thead{
            background: #d8e3d5;
        }

        .table thead th{
            color: #4f6b52;
            font-weight: 600;
            border: none;
        }

        .table tbody tr{
            transition: 0.2s;
        }

        .table tbody tr:hover{
            background: #f0f5ef;
        }

        .btn-sage{
            background: #6b8f71;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px 18px;
            font-weight: 500;
        }

        .btn-sage:hover{
            background: #58745d;
            color: white;
        }

        .btn-detail{
            background: #6b8f71;
            color: white;
            border-radius: 8px;
            border: none;
        }

        .btn-detail:hover{
            background: #55705a;
            color: white;
        }

        .btn-edit{
            border-radius: 8px;
        }

        .btn-delete{
            border-radius: 8px;
        }

        .page-title{
            font-size: 30px;
            font-weight: 700;
            color: #4f6b52;
        }

        .subtitle{
            color: #7c8b7d;
            margin-top: -5px;
        }

    </style>

</head>

<body>

    <!-- Navbar -->

    <div class="navbar-custom">

        <div class="container">

            <h2 class="navbar-title">
                Sistem Informasi Alumni
            </h2>

        </div>

    </div>

    <!-- Content -->

    <div class="container mt-5">

        <!-- Header -->

        <div class="d-flex justify-content-between align-items-center mb-4">

            <div>

                <h1 class="page-title">
                    Dashboard Alumni
                </h1>

                <p class="subtitle">
                    Data dan informasi alumni universitas
                </p>

            </div>

            <a href="/alumni/create"
               class="btn btn-sage">

               + Tambah Alumni

            </a>

        </div>

        <!-- Statistik -->

        <div class="row mb-4">

            <div class="col-md-4">

                <div class="stats-card">

                    <p>Total Alumni</p>

                    <h1 class="stats-number">
                        {{ $alumnis->count() }}
                    </h1>

                </div>

            </div>

        </div>

        <!-- Alert -->

        @if(session('success'))

            <div class="alert alert-success rounded-4 border-0 shadow-sm">
                {{ session('success') }}
            </div>

        @endif

        <!-- Table -->

        <div class="dashboard-card">

            <table class="table">

                <thead>

                    <tr>

                        <th>No</th>
                        <th>Nama</th>
                        <th>NIM</th>
                        <th>Jurusan</th>
                        <th>Angkatan</th>
                        <th>Tahun Lulus</th>
                        <th>Aksi</th>

                    </tr>

                </thead>

                <tbody>

                    @forelse($alumnis as $alumni)

                    <tr>

                        <td>{{ $loop->iteration }}</td>

                        <td>
                            <strong>{{ $alumni->nama }}</strong>
                        </td>

                        <td>{{ $alumni->nim }}</td>

                        <td>{{ $alumni->jurusan }}</td>

                        <td>{{ $alumni->angkatan }}</td>

                        <td>{{ $alumni->tahun_lulus }}</td>

                        <td>

                            <a href="/alumni/{{ $alumni->id }}"
                               class="btn btn-detail btn-sm">
                               Detail
                            </a>

                            <a href="/alumni/{{ $alumni->id }}/edit"
                               class="btn btn-warning btn-sm text-white btn-edit">
                               Edit
                            </a>

                            <form
                                action="/alumni/{{ $alumni->id }}"
                                method="POST"
                                class="d-inline"
                            >

                                @csrf
                                @method('DELETE')

                                <button
                                    type="submit"
                                    class="btn btn-danger btn-sm btn-delete"
                                    onclick="return confirm('Yakin ingin menghapus data alumni ini?')"
                                >
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>

                    @empty

                    <tr>

                        <td colspan="7" class="text-center text-muted py-4">

                            Belum ada data alumni

                        </td>

                    </tr>

                    @endforelse

                </tbody>

            </table>

        </div>

    </div>

</body>

</html>