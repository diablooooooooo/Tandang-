<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Kelola Profil Organisasi | TANDANG</title>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <style>
        .profile-container {
            display: grid;
            grid-template-columns: 1fr 340px;
            gap: 24px;
            align-items: start;
        }

        @media (max-width: 980px) {
            .profile-container {
                grid-template-columns: 1fr;
            }
        }

        .card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 28px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            margin-bottom: 24px;
        }

        .card-header {
            margin-bottom: 24px;
            padding-bottom: 16px;
            border-bottom: 1px solid var(--border);
        }

        .card-header h2 {
            margin: 0 0 6px;
            font-size: 20px;
            font-weight: 700;
            color: var(--text);
        }

        .card-header p {
            margin: 0;
            color: var(--muted);
            font-size: 13.5px;
        }

        .form-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
        }

        @media (max-width: 640px) {
            .form-grid {
                grid-template-columns: 1fr;
            }
        }

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .form-group.full-width {
            grid-column: 1 / -1;
        }

        .form-label {
            font-size: 13.5px;
            font-weight: 600;
            color: var(--text);
        }

        .form-label .required {
            color: #e53e3e;
        }

        .form-input,
        .form-select,
        .form-textarea {
            width: 100%;
            padding: 11px 14px;
            font-size: 14px;
            border: 1.5px solid var(--border);
            border-radius: 10px;
            background: #ffffff;
            color: var(--text);
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }

        .form-input:focus,
        .form-select:focus,
        .form-textarea:focus {
            border-color: var(--primary);
            box-shadow: 0 0 0 3px rgba(35, 155, 101, 0.15);
        }

        .form-textarea {
            resize: vertical;
            min-height: 100px;
        }

        .form-help {
            font-size: 12px;
            color: var(--muted);
            margin: 0;
        }

        .logo-upload-box {
            display: flex;
            align-items: center;
            gap: 20px;
            padding: 16px;
            background: var(--primary-soft);
            border: 1.5px dashed var(--primary);
            border-radius: 12px;
        }

        .current-logo-preview {
            width: 80px;
            height: 80px;
            border-radius: 12px;
            object-fit: cover;
            border: 1px solid var(--border);
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            font-weight: 700;
            color: var(--primary);
            overflow: hidden;
            flex-shrink: 0;
        }

        .current-logo-preview img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .btn-submit {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            background: var(--primary);
            color: white;
            padding: 12px 28px;
            font-size: 14px;
            font-weight: 600;
            border-radius: 10px;
            border: none;
            cursor: pointer;
            transition: background 0.2s, transform 0.1s;
        }

        .btn-submit:hover {
            background: var(--primary-dark);
        }

        .btn-submit:active {
            transform: scale(0.98);
        }

        .alert {
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 24px;
            font-size: 14px;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .alert-success {
            background: #e6f9f0;
            color: #0f683f;
            border: 1px solid #b7ebd3;
        }

        .alert-danger {
            background: #fde8e8;
            color: #9b1c1c;
            border: 1px solid #f8b4b4;
        }

        .preview-card {
            background: #ffffff;
            border: 1px solid var(--border);
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.03);
            text-align: center;
            position: sticky;
            top: 24px;
        }

        .preview-avatar {
            width: 90px;
            height: 90px;
            margin: 0 auto 16px;
            border-radius: 18px;
            background: var(--primary-light);
            border: 2px solid var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            font-size: 32px;
            font-weight: 700;
            color: var(--primary);
        }

        .preview-avatar img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .preview-name {
            font-size: 18px;
            font-weight: 700;
            color: var(--text);
            margin: 0 0 6px;
        }

        .preview-tag {
            display: inline-block;
            background: var(--primary-soft);
            color: var(--primary-dark);
            font-size: 12px;
            font-weight: 600;
            padding: 4px 12px;
            border-radius: 20px;
            margin-bottom: 16px;
        }

        .preview-desc {
            font-size: 13px;
            color: #4b5563;
            line-height: 1.6;
            margin: 0 0 16px;
            text-align: left;
            background: #f9fafb;
            padding: 12px;
            border-radius: 8px;
        }

        .preview-info-list {
            list-style: none;
            padding: 0;
            margin: 0;
            text-align: left;
            font-size: 13px;
            display: flex;
            flex-direction: column;
            gap: 10px;
            border-top: 1px solid var(--border);
            padding-top: 16px;
        }

        .preview-info-item {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--text);
        }

        .preview-info-item svg {
            width: 16px;
            height: 16px;
            color: var(--primary);
            flex-shrink: 0;
        }

        .trust-badge {
            margin-top: 18px;
            padding: 10px;
            background: #ecfdf5;
            border-radius: 8px;
            font-size: 12px;
            color: #065f46;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 6px;
            font-weight: 600;
        }
    </style>
</head>
<body>
    <div class="dashboard-layout">
        <!-- ============ SIDEBAR ============ -->
        <aside class="sidebar">
            <a href="{{ route('penyedia.profile') }}" class="brand">
                <img src="{{ asset('images/LogoTandang.png') }}"
                     alt="Logo TANDANG"
                     class="brand-logo">
            </a>

            <div class="sidebar-label">RUANG PENYEDIA PROYEK</div>

            <nav class="sidebar-nav">
                <a href="{{ route('penyedia.profile') }}" class="nav-item active">
                    <span class="nav-icon">
                        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                            <rect x="2" y="7" width="20" height="14" rx="2" ry="2"/>
                            <path d="M16 21V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v16"/>
                        </svg>
                    </span>
                    <span>Profil Organisasi</span>
                </a>
            </nav>

            <div class="sidebar-bottom">
                <div class="help-card">
                    <div class="help-icon">?</div>
                    <div>
                        <strong>Penyedia Proyek</strong>
                        <p>Kelola profil bisnis untuk menarik talenta terbaik.</p>
                    </div>
                </div>

                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="logout-button">
                        <span class="nav-icon">
                            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"/>
                                <path d="m16 17 5-5-5-5"/>
                                <path d="M21 12H9"/>
                            </svg>
                        </span>
                        <span>Keluar</span>
                    </button>
                </form>
            </div>
        </aside>

        <!-- ============ MAIN CONTENT ============ -->
        <main class="main-content">
            <header class="topbar">
                <div class="topbar-search">
                    <span style="font-weight: 600; color: var(--text);">Profil &amp; Legalitas Organisasi</span>
                </div>

                <div class="topbar-actions">
                    <div class="user-chip">
                        <div class="user-avatar" style="background:#239b65; color:white; font-weight:700;">
                            {{ strtoupper(substr($user->name, 0, 1)) }}
                        </div>
                        <div class="user-meta">
                            <strong>{{ $user->name }}</strong>
                            <span>Penyedia Proyek (UMKM)</span>
                        </div>
                    </div>
                </div>
            </header>

            <section class="page-content">
                @if (session('success'))
                    <div class="alert alert-success">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"/>
                            <polyline points="22 4 12 14.01 9 11.01"/>
                        </svg>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <circle cx="12" cy="12" r="10"/>
                            <line x1="12" y1="8" x2="12" y2="12"/>
                            <line x1="12" y1="16" x2="12.01" y2="16"/>
                        </svg>
                        <div>
                            <strong>Terjadi kesalahan:</strong>
                            <ul style="margin: 4px 0 0; padding-left: 18px;">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endif

                <div class="profile-container">
                    <!-- Form Side -->
                    <div>
                        <form action="{{ route('penyedia.profile.update') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="card">
                                <div class="card-header">
                                    <h2>Informasi Organisasi / UMKM</h2>
                                    <p>Lengkapi identitas organisasi agar talenta muda yakin melamar proyek Anda.</p>
                                </div>

                                <div class="form-grid">
                                    <div class="form-group full-width">
                                        <label class="form-label">Logo Organisasi</label>
                                        <div class="logo-upload-box">
                                            <div class="current-logo-preview" id="logoPreviewBox">
                                                @if ($profile->logo && file_exists(public_path($profile->logo)))
                                                    <img src="{{ asset($profile->logo) }}" alt="Logo">
                                                @else
                                                    {{ strtoupper(substr($profile->organization_name ?: $user->name, 0, 1)) }}
                                                @endif
                                            </div>
                                            <div style="flex: 1;">
                                                <input type="file" name="logo" id="logoInput" class="form-input" accept="image/*" style="padding: 8px;">
                                                <p class="form-help">Format: PNG, JPG, WEBP, atau SVG (Maksimal 2MB).</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="organization_name" class="form-label">
                                            Nama Organisasi / Usaha <span class="required">*</span>
                                        </label>
                                        <input type="text"
                                               id="organization_name"
                                               name="organization_name"
                                               class="form-input"
                                               value="{{ old('organization_name', $profile->organization_name ?: $user->name) }}"
                                               required
                                               placeholder="Contoh: CV Tandang Kreatif Nusantara">
                                    </div>

                                    <div class="form-group">
                                        <label for="industry_type" class="form-label">Bidang Usaha / Industri</label>
                                        <select id="industry_type" name="industry_type" class="form-select">
                                            <option value="">-- Pilih Bidang Usaha --</option>
                                            @php
                                                $industries = [
                                                    'Teknologi & Informasi',
                                                    'Desain & Kreatif',
                                                    'Kuliner & F&B',
                                                    'Fashion & Tekstil',
                                                    'Kerajinan & Kriya',
                                                    'Pemasaran & Digital',
                                                    'Pertanian & Agribisnis',
                                                    'Pendidikan & Pelatihan',
                                                    'Jasa Profesional',
                                                    'Lainnya',
                                                ];
                                            @endphp
                                            @foreach ($industries as $ind)
                                                <option value="{{ $ind }}" {{ old('industry_type', $profile->industry_type) === $ind ? 'selected' : '' }}>
                                                    {{ $ind }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group full-width">
                                        <label for="description" class="form-label">Tentang Organisasi / Profil Usaha</label>
                                        <textarea id="description"
                                                  name="description"
                                                  class="form-textarea"
                                                  placeholder="Jelaskan sejarah singkat, visi, fokus usaha, atau portfolio bisnis Anda...">{{ old('description', $profile->description) }}</textarea>
                                        <p class="form-help">Deskripsi yang jelas membantu talenta memahami ruang kerja dan nilai proyek Anda.</p>
                                    </div>

                                    <div class="form-group">
                                        <label for="city" class="form-label">Kota / Kabupaten</label>
                                        <input type="text"
                                               id="city"
                                               name="city"
                                               class="form-input"
                                               value="{{ old('city', $profile->city) }}"
                                               placeholder="Contoh: Bandung">
                                    </div>

                                    <div class="form-group">
                                        <label for="phone" class="form-label">Nomor Kontak / WhatsApp</label>
                                        <input type="text"
                                               id="phone"
                                               name="phone"
                                               class="form-input"
                                               value="{{ old('phone', $profile->phone) }}"
                                               placeholder="Contoh: 081234567890">
                                    </div>

                                    <div class="form-group full-width">
                                        <label for="address" class="form-label">Alamat Lengkap Kantor / Tempat Usaha</label>
                                        <textarea id="address"
                                                  name="address"
                                                  class="form-textarea"
                                                  style="min-height: 70px;"
                                                  placeholder="Contoh: Jl. Dipati Ukur No. 45, Lebakgede, Kecamatan Coblong">{{ old('address', $profile->address) }}</textarea>
                                    </div>

                                    <div class="form-group full-width">
                                        <label for="website" class="form-label">Website / Link Portofolio / Media Sosial</label>
                                        <input type="url"
                                               id="website"
                                               name="website"
                                               class="form-input"
                                               value="{{ old('website', $profile->website) }}"
                                               placeholder="https://contohusaha.com">
                                        <p class="form-help">Gunakan awalan https:// atau http://</p>
                                    </div>
                                </div>

                                <div style="margin-top: 28px; display: flex; justify-content: flex-end;">
                                    <button type="submit" class="btn-submit">
                                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"/>
                                            <polyline points="17 21 17 13 7 13 7 21"/>
                                            <polyline points="7 3 7 8 15 8"/>
                                        </svg>
                                        Simpan Perubahan Profil
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                    <!-- Live Preview Side -->
                    <div>
                        <div class="preview-card">
                            <div class="preview-avatar" id="cardAvatar">
                                @if ($profile->logo && file_exists(public_path($profile->logo)))
                                    <img src="{{ asset($profile->logo) }}" alt="Logo">
                                @else
                                    {{ strtoupper(substr($profile->organization_name ?: $user->name, 0, 1)) }}
                                @endif
                            </div>
                            <h3 class="preview-name" id="cardOrgName">
                                {{ $profile->organization_name ?: $user->name }}
                            </h3>
                            <span class="preview-tag" id="cardIndustry">
                                {{ $profile->industry_type ?: 'Bidang Usaha Belum Diatur' }}
                            </span>

                            <p class="preview-desc" id="cardDesc">
                                {{ $profile->description ?: 'Belum ada deskripsi profil. Lengkapi profil agar talenta muda lebih tertarik dan percaya pada proyek Anda.' }}
                            </p>

                            <ul class="preview-info-list">
                                <li class="preview-info-item">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                                        <circle cx="12" cy="10" r="3"/>
                                    </svg>
                                    <span id="cardCity">{{ $profile->city ?: 'Kota belum diset' }}</span>
                                </li>
                                <li class="preview-info-item">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"/>
                                    </svg>
                                    <span id="cardPhone">{{ $profile->phone ?: 'Kontak belum diset' }}</span>
                                </li>
                                <li class="preview-info-item">
                                    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="12" cy="12" r="10"/>
                                        <line x1="2" y1="12" x2="22" y2="12"/>
                                        <path d="M12 2a15.3 15.3 0 0 1 4 10 15.3 15.3 0 0 1-4 10 15.3 15.3 0 0 1-4-10 15.3 15.3 0 0 1 4-10z"/>
                                    </svg>
                                    <span id="cardWebsite">
                                        @if ($profile->website)
                                            <a href="{{ $profile->website }}" target="_blank" rel="noopener noreferrer" style="color:var(--primary); text-decoration:underline;">
                                                Kunjungi Website
                                            </a>
                                        @else
                                            Website belum diset
                                        @endif
                                    </span>
                                </li>
                            </ul>

                            <div class="trust-badge">
                                <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M12 22s8-4 8-10V5l-8-3-8 3v7c0 6 8 10 8 10z"/>
                                </svg>
                                <span>Akun Resmi Penyedia Proyek</span>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </main>
    </div>

    <script>
        // Real-time live preview update
        const orgNameInput = document.getElementById('organization_name');
        const industryInput = document.getElementById('industry_type');
        const descInput = document.getElementById('description');
        const cityInput = document.getElementById('city');
        const phoneInput = document.getElementById('phone');
        const logoInput = document.getElementById('logoInput');

        const cardOrgName = document.getElementById('cardOrgName');
        const cardIndustry = document.getElementById('cardIndustry');
        const cardDesc = document.getElementById('cardDesc');
        const cardCity = document.getElementById('cardCity');
        const cardPhone = document.getElementById('cardPhone');
        const logoPreviewBox = document.getElementById('logoPreviewBox');
        const cardAvatar = document.getElementById('cardAvatar');

        if (orgNameInput && cardOrgName) {
            orgNameInput.addEventListener('input', (e) => {
                const val = e.target.value.trim();
                cardOrgName.textContent = val || 'Nama Organisasi';
                if (!logoInput.files.length && !cardAvatar.querySelector('img')) {
                    const initial = (val || 'O').charAt(0).toUpperCase();
                    cardAvatar.textContent = initial;
                    logoPreviewBox.textContent = initial;
                }
            });
        }

        if (industryInput && cardIndustry) {
            industryInput.addEventListener('change', (e) => {
                cardIndustry.textContent = e.target.value || 'Bidang Usaha Belum Diatur';
            });
        }

        if (descInput && cardDesc) {
            descInput.addEventListener('input', (e) => {
                cardDesc.textContent = e.target.value.trim() || 'Belum ada deskripsi profil.';
            });
        }

        if (cityInput && cardCity) {
            cityInput.addEventListener('input', (e) => {
                cardCity.textContent = e.target.value.trim() || 'Kota belum diset';
            });
        }

        if (phoneInput && cardPhone) {
            phoneInput.addEventListener('input', (e) => {
                cardPhone.textContent = e.target.value.trim() || 'Kontak belum diset';
            });
        }

        if (logoInput) {
            logoInput.addEventListener('change', function () {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        const img = `<img src="${e.target.result}" alt="Logo">`;
                        logoPreviewBox.innerHTML = img;
                        cardAvatar.innerHTML = img;
                    };
                    reader.readAsDataURL(file);
                }
            });
        }
    </script>
</body>
</html>
