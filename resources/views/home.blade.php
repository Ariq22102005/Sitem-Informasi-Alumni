@extends('layouts.app')

@section('content')
<div class="dashboard-container">
    <!-- Welcome Header -->
    <div class="welcome-section">
        <div class="welcome-content">
            <h1 class="welcome-title">Selamat Datang, {{ Auth::user()->name ?? 'Alumni' }}! 👋</h1>
            <p class="welcome-subtitle">Kelola informasi alumni dan jaringan profesional Anda</p>
        </div>
        @if (session('status'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="fas fa-check-circle"></i>
                {{ session('status') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
    </div>

    <!-- Stats Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon bg-primary">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">1,240</h3>
                <p class="stat-label">Total Alumni</p>
            </div>
            <div class="stat-trend">
                <span class="badge bg-success"><i class="fas fa-arrow-up"></i> 12%</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon bg-success">
                <i class="fas fa-briefcase"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">856</h3>
                <p class="stat-label">Teremploy</p>
            </div>
            <div class="stat-trend">
                <span class="badge bg-success"><i class="fas fa-arrow-up"></i> 8%</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon bg-info">
                <i class="fas fa-building"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">342</h3>
                <p class="stat-label">Perusahaan</p>
            </div>
            <div class="stat-trend">
                <span class="badge bg-warning"><i class="fas fa-arrow-up"></i> 5%</span>
            </div>
        </div>

        <div class="stat-card">
            <div class="stat-icon bg-warning">
                <i class="fas fa-graduation-cap"></i>
            </div>
            <div class="stat-content">
                <h3 class="stat-number">28</h3>
                <p class="stat-label">Batch Aktif</p>
            </div>
            <div class="stat-trend">
                <span class="badge bg-success"><i class="fas fa-arrow-up"></i> 3%</span>
            </div>
        </div>
    </div>

    <!-- Main Content Grid -->
    <div class="main-grid">
        <!-- Left Column -->
        <div class="left-column">
            <!-- Quick Actions -->
            <div class="card card-modern">
                <div class="card-header card-header-modern">
                    <h5 class="card-title-modern">
                        <i class="fas fa-rocket"></i> Aksi Cepat
                    </h5>
                </div>
                <div class="card-body">
                    <div class="quick-actions">
                        <a href="#" class="action-btn">
                            <div class="action-icon">
                                <i class="fas fa-user-plus"></i>
                            </div>
                            <div class="action-text">
                                <h6>Tambah Alumni</h6>
                                <p>Daftarkan alumni baru</p>
                            </div>
                        </a>
                        <a href="#" class="action-btn">
                            <div class="action-icon">
                                <i class="fas fa-search"></i>
                            </div>
                            <div class="action-text">
                                <h6>Cari Alumni</h6>
                                <p>Temukan teman Anda</p>
                            </div>
                        </a>
                        <a href="#" class="action-btn">
                            <div class="action-icon">
                                <i class="fas fa-calendar-alt"></i>
                            </div>
                            <div class="action-text">
                                <h6>Event</h6>
                                <p>Lihat acara mendatang</p>
                            </div>
                        </a>
                        <a href="#" class="action-btn">
                            <div class="action-icon">
                                <i class="fas fa-chart-bar"></i>
                            </div>
                            <div class="action-text">
                                <h6>Laporan</h6>
                                <p>Analisis data alumni</p>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <!-- Recent Alumni -->
            <div class="card card-modern">
                <div class="card-header card-header-modern">
                    <h5 class="card-title-modern">
                        <i class="fas fa-star"></i> Alumni Terbaru
                    </h5>
                    <a href="#" class="see-all">Lihat Semua</a>
                </div>
                <div class="card-body">
                    <div class="alumni-list">
                        <div class="alumni-item">
                            <div class="alumni-avatar">
                                <img src="https://i.pravatar.cc/150?u=alumni1" alt="Alumni">
                            </div>
                            <div class="alumni-info">
                                <h6 class="alumni-name">Budi Santoso</h6>
                                <p class="alumni-role">Product Manager at Tech Corp</p>
                                <span class="alumni-year">2018</span>
                            </div>
                            <div class="alumni-action">
                                <button class="btn-icon" title="Hubungi">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>

                        <div class="alumni-item">
                            <div class="alumni-avatar">
                                <img src="https://i.pravatar.cc/150?u=alumni2" alt="Alumni">
                            </div>
                            <div class="alumni-info">
                                <h6 class="alumni-name">Siti Nurhaliza</h6>
                                <p class="alumni-role">UI/UX Designer at StartUp</p>
                                <span class="alumni-year">2019</span>
                            </div>
                            <div class="alumni-action">
                                <button class="btn-icon" title="Hubungi">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>

                        <div class="alumni-item">
                            <div class="alumni-avatar">
                                <img src="https://i.pravatar.cc/150?u=alumni3" alt="Alumni">
                            </div>
                            <div class="alumni-info">
                                <h6 class="alumni-name">Ahmad Wijaya</h6>
                                <p class="alumni-role">Software Engineer at Cloud Solutions</p>
                                <span class="alumni-year">2020</span>
                            </div>
                            <div class="alumni-action">
                                <button class="btn-icon" title="Hubungi">
                                    <i class="fas fa-paper-plane"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column -->
        <div class="right-column">
            <!-- Calendar Events -->
            <div class="card card-modern">
                <div class="card-header card-header-modern">
                    <h5 class="card-title-modern">
                        <i class="fas fa-calendar-check"></i> Event Mendatang
                    </h5>
                </div>
                <div class="card-body">
                    <div class="events-list">
                        <div class="event-item event-primary">
                            <div class="event-date">
                                <span class="event-day">25</span>
                                <span class="event-month">Juni</span>
                            </div>
                            <div class="event-detail">
                                <h6 class="event-title">Reunion Alumni 2024</h6>
                                <p class="event-time">
                                    <i class="fas fa-clock"></i> 18:00 WIB
                                </p>
                                <p class="event-location">
                                    <i class="fas fa-map-marker-alt"></i> Aula Utama
                                </p>
                            </div>
                        </div>

                        <div class="event-item event-success">
                            <div class="event-date">
                                <span class="event-day">10</span>
                                <span class="event-month">Juli</span>
                            </div>
                            <div class="event-detail">
                                <h6 class="event-title">Workshop IT Career</h6>
                                <p class="event-time">
                                    <i class="fas fa-clock"></i> 14:00 WIB
                                </p>
                                <p class="event-location">
                                    <i class="fas fa-map-marker-alt"></i> Online
                                </p>
                            </div>
                        </div>

                        <div class="event-item event-warning">
                            <div class="event-date">
                                <span class="event-day">20</span>
                                <span class="event-month">Juli</span>
                            </div>
                            <div class="event-detail">
                                <h6 class="event-title">Gathering Networking</h6>
                                <p class="event-time">
                                    <i class="fas fa-clock"></i> 19:30 WIB
                                </p>
                                <p class="event-location">
                                    <i class="fas fa-map-marker-alt"></i> Hotel Grand
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Profile Completion -->
            <div class="card card-modern">
                <div class="card-header card-header-modern">
                    <h5 class="card-title-modern">
                        <i class="fas fa-user-check"></i> Profil Anda
                    </h5>
                </div>
                <div class="card-body">
                    <div class="profile-completion">
                        <div class="completion-header">
                            <h6>Kelengkapan Profil</h6>
                            <span class="completion-percent">75%</span>
                        </div>
                        <div class="progress-bar">
                            <div class="progress-fill" style="width: 75%"></div>
                        </div>
                        <div class="completion-items">
                            <div class="completion-item">
                                <i class="fas fa-check-circle text-success"></i>
                                <span>Foto Profil</span>
                            </div>
                            <div class="completion-item">
                                <i class="fas fa-check-circle text-success"></i>
                                <span>Data Pribadi</span>
                            </div>
                            <div class="completion-item">
                                <i class="fas fa-circle text-secondary"></i>
                                <span>Riwayat Pekerjaan</span>
                            </div>
                            <div class="completion-item">
                                <i class="fas fa-check-circle text-success"></i>
                                <span>Kontak</span>
                            </div>
                        </div>
                        <button class="btn btn-primary btn-block mt-3">
                            Lengkapi Profil
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    :root {
        --primary: #3b82f6;
        --primary-dark: #1e40af;
        --success: #10b981;
        --warning: #f59e0b;
        --info: #06b6d4;
        --danger: #ef4444;
        --light: #f9fafb;
        --dark: #111827;
        --border: #e5e7eb;
        --text: #374151;
    }

    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    .dashboard-container {
        padding: 2rem;
        background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
        min-height: 100vh;
    }

    /* Welcome Section */
    .welcome-section {
        margin-bottom: 2rem;
        animation: slideInDown 0.6s ease-out;
    }

    .welcome-content {
        margin-bottom: 1rem;
    }

    .welcome-title {
        font-size: 2.5rem;
        font-weight: 700;
        color: var(--dark);
        margin-bottom: 0.5rem;
        background: linear-gradient(135deg, var(--primary) 0%, var(--info) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
    }

    .welcome-subtitle {
        font-size: 1.1rem;
        color: var(--text);
    }

    .alert {
        border: none;
        border-left: 4px solid var(--success);
        border-radius: 8px;
        padding: 1rem;
        background-color: rgba(16, 185, 129, 0.1);
    }

    /* Stats Grid */
    .stats-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1.5rem;
        margin-bottom: 2rem;
        animation: fadeIn 0.8s ease-out 0.2s both;
    }

    .stat-card {
        background: white;
        border-radius: 12px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        border: 1px solid var(--border);
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: white;
        font-size: 1.5rem;
    }

    .bg-primary {
        background: linear-gradient(135deg, var(--primary) 0%, #2563eb 100%);
    }

    .bg-success {
        background: linear-gradient(135deg, var(--success) 0%, #059669 100%);
    }

    .bg-info {
        background: linear-gradient(135deg, var(--info) 0%, #0891b2 100%);
    }

    .bg-warning {
        background: linear-gradient(135deg, var(--warning) 0%, #d97706 100%);
    }

    .stat-content {
        flex: 1;
    }

    .stat-number {
        font-size: 1.8rem;
        font-weight: 700;
        color: var(--dark);
        margin: 0;
    }

    .stat-label {
        font-size: 0.9rem;
        color: var(--text);
        margin: 0;
    }

    .stat-trend {
        text-align: right;
    }

    .badge {
        font-size: 0.8rem;
        padding: 0.4rem 0.8rem;
        border-radius: 20px;
    }

    /* Main Grid */
    .main-grid {
        display: grid;
        grid-template-columns: 2fr 1fr;
        gap: 2rem;
        animation: fadeIn 0.8s ease-out 0.4s both;
    }

    @media (max-width: 1024px) {
        .main-grid {
            grid-template-columns: 1fr;
        }
    }

    /* Card Styles */
    .card-modern {
        background: white;
        border-radius: 12px;
        border: 1px solid var(--border);
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.08);
        margin-bottom: 1.5rem;
        transition: all 0.3s ease;
        overflow: hidden;
    }

    .card-modern:hover {
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.12);
    }

    .card-header-modern {
        padding: 1.5rem;
        border-bottom: 1px solid var(--border);
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: linear-gradient(to right, rgba(59, 130, 246, 0.03), transparent);
    }

    .card-title-modern {
        font-size: 1.2rem;
        font-weight: 600;
        color: var(--dark);
        margin: 0;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }

    .card-title-modern i {
        color: var(--primary);
    }

    .see-all {
        font-size: 0.9rem;
        color: var(--primary);
        text-decoration: none;
        font-weight: 500;
        transition: all 0.3s ease;
    }

    .see-all:hover {
        color: var(--primary-dark);
    }

    .card-body {
        padding: 1.5rem;
    }

    /* Quick Actions */
    .quick-actions {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 1rem;
    }

    @media (max-width: 768px) {
        .quick-actions {
            grid-template-columns: 1fr;
        }
    }

    .action-btn {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        border-radius: 10px;
        background: var(--light);
        border: 1px solid var(--border);
        text-decoration: none;
        color: inherit;
        transition: all 0.3s ease;
    }

    .action-btn:hover {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
        transform: translateX(4px);
    }

    .action-icon {
        width: 40px;
        height: 40px;
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        background: rgba(59, 130, 246, 0.1);
    }

    .action-btn:hover .action-icon {
        background: rgba(255, 255, 255, 0.2);
    }

    .action-text h6 {
        font-size: 0.95rem;
        font-weight: 600;
        margin: 0 0 0.2rem 0;
    }

    .action-text p {
        font-size: 0.8rem;
        margin: 0;
        opacity: 0.7;
    }

    /* Alumni List */
    .alumni-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .alumni-item {
        display: flex;
        align-items: center;
        gap: 1rem;
        padding: 1rem;
        border-radius: 10px;
        background: var(--light);
        transition: all 0.3s ease;
    }

    .alumni-item:hover {
        background: rgba(59, 130, 246, 0.05);
        transform: translateX(4px);
    }

    .alumni-avatar {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        overflow: hidden;
        flex-shrink: 0;
    }

    .alumni-avatar img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }

    .alumni-info {
        flex: 1;
        min-width: 0;
    }

    .alumni-name {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--dark);
        margin: 0 0 0.3rem 0;
    }

    .alumni-role {
        font-size: 0.8rem;
        color: var(--text);
        margin: 0 0 0.3rem 0;
    }

    .alumni-year {
        display: inline-block;
        font-size: 0.75rem;
        background: var(--primary);
        color: white;
        padding: 0.2rem 0.6rem;
        border-radius: 12px;
    }

    .alumni-action {
        flex-shrink: 0;
    }

    .btn-icon {
        width: 36px;
        height: 36px;
        border-radius: 8px;
        border: 1px solid var(--border);
        background: white;
        color: var(--primary);
        display: flex;
        align-items: center;
        justify-content: center;
        cursor: pointer;
        transition: all 0.3s ease;
        font-size: 0.9rem;
    }

    .btn-icon:hover {
        background: var(--primary);
        color: white;
        border-color: var(--primary);
        transform: scale(1.1);
    }

    /* Events List */
    .events-list {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .event-item {
        display: flex;
        gap: 1rem;
        padding: 1rem;
        border-radius: 10px;
        border-left: 4px solid;
        transition: all 0.3s ease;
    }

    .event-primary {
        background: rgba(59, 130, 246, 0.05);
        border-left-color: var(--primary);
    }

    .event-success {
        background: rgba(16, 185, 129, 0.05);
        border-left-color: var(--success);
    }

    .event-warning {
        background: rgba(245, 158, 11, 0.05);
        border-left-color: var(--warning);
    }

    .event-item:hover {
        transform: translateX(4px);
    }

    .event-date {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        min-width: 50px;
        padding: 0.5rem;
        border-radius: 8px;
        font-weight: 600;
    }

    .event-primary .event-date {
        background: var(--primary);
        color: white;
    }

    .event-success .event-date {
        background: var(--success);
        color: white;
    }

    .event-warning .event-date {
        background: var(--warning);
        color: white;
    }

    .event-day {
        font-size: 1.2rem;
    }

    .event-month {
        font-size: 0.75rem;
        opacity: 0.9;
    }

    .event-detail {
        flex: 1;
    }

    .event-title {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--dark);
        margin: 0 0 0.4rem 0;
    }

    .event-time,
    .event-location {
        font-size: 0.8rem;
        color: var(--text);
        margin: 0.2rem 0;
    }

    .event-time i,
    .event-location i {
        margin-right: 0.4rem;
        width: 16px;
        text-align: center;
    }

    /* Profile Completion */
    .profile-completion {
        display: flex;
        flex-direction: column;
        gap: 1rem;
    }

    .completion-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .completion-header h6 {
        font-size: 0.95rem;
        font-weight: 600;
        color: var(--dark);
        margin: 0;
    }

    .completion-percent {
        font-size: 1.1rem;
        font-weight: 700;
        color: var(--primary);
    }

    .progress-bar {
        width: 100%;
        height: 8px;
        background: var(--light);
        border-radius: 10px;
        overflow: hidden;
    }

    .progress-fill {
        height: 100%;
        background: linear-gradient(90deg, var(--primary) 0%, var(--info) 100%);
        border-radius: 10px;
        transition: width 0.3s ease;
    }

    .completion-items {
        display: flex;
        flex-direction: column;
        gap: 0.6rem;
    }

    .completion-item {
        display: flex;
        align-items: center;
        gap: 0.8rem;
        font-size: 0.9rem;
        color: var(--text);
    }

    .completion-item i {
        font-size: 0.9rem;
    }

    .btn-block {
        width: 100%;
        padding: 0.7rem;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        background: linear-gradient(135deg, var(--primary) 0%, var(--info) 100%);
        color: white;
    }

    .btn-block:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(59, 130, 246, 0.4);
    }

    /* Animations */
    @keyframes slideInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .dashboard-container {
            padding: 1rem;
        }

        .welcome-title {
            font-size: 1.8rem;
        }

        .stats-grid {
            grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
            gap: 1rem;
        }

        .stat-card {
            padding: 1rem;
            gap: 0.8rem;
        }

        .stat-icon {
            width: 45px;
            height: 45px;
            font-size: 1.1rem;
        }

        .stat-number {
            font-size: 1.4rem;
        }
    }
</style>
@endsection