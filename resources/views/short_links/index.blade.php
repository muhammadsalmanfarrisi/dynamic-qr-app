<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Spindo Short Link and Generate QR Code Manager</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome 6 -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <!-- Google Fonts: Inter + Poppins -->
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:opsz,wght@14..32,300;14..32,400;14..32,500;14..32,600;14..32,700&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            transition: background-color 0.25s ease, border-color 0.2s ease, color 0.2s ease, box-shadow 0.2s ease;
        }

        /* CSS Variables for Light & Dark Mode */
        :root {
            --bg-gradient-start: radial-gradient(circle at 10% 30%, #f8f9fc, #eef2f7);
            --bg-solid: #f4f7fc;
            --card-bg: rgba(255, 255, 255, 0.85);
            --card-border: rgba(212, 175, 55, 0.35);
            --text-primary: #1a2634;
            --text-secondary: #2c3e4e;
            --text-gold: #b8860b;
            --gold-light: #D4AF37;
            --gold-gradient: linear-gradient(135deg, #D4AF37, #B8860B);
            --shortcut-bg: rgba(0, 0, 0, 0.04);
            --btn-download-bg: linear-gradient(120deg, #f0f2f5, #e4e8ef);
            --btn-download-border: rgba(212, 175, 55, 0.6);
            --hero-bg: rgba(245, 248, 250, 0.8);
            --badge-scan-bg: rgba(0, 0, 0, 0.05);
            --footer-color: #5a6e7c;
            --shadow-sm: 0 20px 35px -15px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 30px 40px -15px rgba(0, 0, 0, 0.2);
        }

        body.dark {
            --bg-gradient-start: radial-gradient(circle at 10% 30%, #0a0f1e, #03060c);
            --bg-solid: #0b1018;
            --card-bg: rgba(18, 28, 40, 0.85);
            --card-border: rgba(212, 175, 55, 0.3);
            --text-primary: #f0f3fa;
            --text-secondary: #cbd5e6;
            --text-gold: #e6c97e;
            --gold-light: #D4AF37;
            --shortcut-bg: rgba(0, 0, 0, 0.4);
            --btn-download-bg: linear-gradient(120deg, #1E2A3A, #0F1622);
            --btn-download-border: rgba(212, 175, 55, 0.6);
            --hero-bg: rgba(15, 25, 45, 0.7);
            --badge-scan-bg: rgba(0, 0, 0, 0.5);
            --footer-color: #8f9bb3;
            --shadow-sm: 0 20px 35px -15px rgba(0, 0, 0, 0.5);
            --shadow-hover: 0 30px 40px -15px rgba(0, 0, 0, 0.7);
        }

        body {
            background: var(--bg-gradient-start);
            font-family: 'Inter', sans-serif;
            color: var(--text-primary);
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: radial-gradient(rgba(212, 175, 55, 0.03) 1px, transparent 1px);
            background-size: 30px 30px;
            pointer-events: none;
            z-index: 0;
        }

        .luxury-container {
            position: relative;
            z-index: 2;
            padding: 2rem 1.5rem;
        }

        /* Header Mewah Glassmorphic */
        .hero-section {
            background: var(--hero-bg);
            backdrop-filter: blur(14px);
            border-radius: 2rem;
            padding: 1.5rem 2rem;
            margin-bottom: 2.5rem;
            border: 1px solid var(--card-border);
            box-shadow: var(--shadow-sm);
        }

        .hero-title {
            font-family: 'Poppins', sans-serif;
            font-weight: 700;
            background: linear-gradient(135deg, var(--gold-light), #e6c97e, #f9e6b3);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            letter-spacing: -0.02em;
            font-size: 2.2rem;
        }

        .hero-sub {
            color: var(--text-secondary);
            border-left: 3px solid var(--gold-light);
            padding-left: 1rem;
        }

        .btn-create-luxury {
            background: linear-gradient(105deg, #D4AF37, #F3E5AB);
            border: none;
            padding: 12px 28px;
            border-radius: 60px;
            font-weight: 700;
            font-size: 0.95rem;
            color: #0a0f1e;
            box-shadow: 0 8px 20px rgba(212, 175, 55, 0.3);
            transition: 0.2s;
        }

        .btn-create-luxury:hover {
            transform: translateY(-3px);
            box-shadow: 0 15px 30px rgba(212, 175, 55, 0.5);
            background: linear-gradient(105deg, #E5C265, #FFF2CF);
        }

        /* Toggle Dark/Light Switch Mewah */
        .theme-switch-wrapper {
            display: flex;
            align-items: center;
            gap: 12px;
            background: rgba(212, 175, 55, 0.15);
            backdrop-filter: blur(8px);
            padding: 6px 16px 6px 12px;
            border-radius: 60px;
            border: 1px solid var(--gold-light);
        }

        .theme-switch {
            position: relative;
            display: inline-block;
            width: 54px;
            height: 28px;
        }

        .theme-switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #1e2a3a;
            transition: 0.3s;
            border-radius: 34px;
        }

        .slider:before {
            position: absolute;
            content: "☀️";
            font-size: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 22px;
            width: 22px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            transition: 0.3s;
            border-radius: 50%;
            background: #f5e6b0;
            color: #b8860b;
        }

        input:checked+.slider:before {
            content: "🌙";
            transform: translateX(26px);
            background: #2c3e50;
            color: #f5e6b0;
        }

        .theme-label {
            font-size: 0.8rem;
            font-weight: 500;
            color: var(--gold-light);
        }

        /* QR Cards */
        .qr-card {
            background: var(--card-bg);
            backdrop-filter: blur(12px);
            border-radius: 2rem;
            border: 1px solid var(--card-border);
            transition: all 0.35s cubic-bezier(0.2, 0.9, 0.4, 1.1);
            height: 100%;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .qr-card:hover {
            transform: translateY(-8px);
            border-color: var(--gold-light);
            box-shadow: var(--shadow-hover);
            background: var(--card-bg);
        }

        .card-inner {
            padding: 1.8rem 1.5rem;
        }

        .qr-wrapper {
            background: white;
            border-radius: 1.5rem;
            padding: 1rem;
            display: inline-block;
            margin-bottom: 1rem;
            box-shadow: 0 10px 20px -8px rgba(0, 0, 0, 0.2), inset 0 0 0 1px var(--gold-light);
        }

        .qr-wrapper svg {
            display: block;
            margin: 0 auto;
            border-radius: 0.9rem;
            width: 140px;
            height: 140px;
        }

        .shortcut-area {
            background: var(--shortcut-bg);
            border-radius: 1rem;
            padding: 0.7rem 1rem;
            margin: 1rem 0;
            border-left: 3px solid var(--gold-light);
        }

        .short-link-text {
            font-size: 0.8rem;
            font-weight: 600;
            color: var(--gold-light);
        }

        .short-link-url {
            font-weight: 600;
            color: var(--gold-light);
            text-decoration: none;
            word-break: break-all;
        }

        .short-link-url:hover {
            color: var(--text-primary);
            text-shadow: 0 0 2px var(--gold-light);
        }

        .btn-download-gold {
            background: var(--btn-download-bg);
            border: 1px solid var(--btn-download-border);
            border-radius: 40px;
            padding: 8px 20px;
            font-weight: 600;
            font-size: 0.85rem;
            color: var(--gold-light);
            width: 100%;
            transition: 0.2s;
        }

        .btn-download-gold:hover {
            background: var(--gold-light);
            border-color: var(--gold-light);
            color: #0a0f1e;
            transform: scale(1.02);
        }

        .info-stats {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1.4rem;
            flex-wrap: wrap;
            gap: 0.6rem;
            border-top: 1px dashed rgba(212, 175, 55, 0.3);
            padding-top: 1rem;
        }

        .badge-scan {
            background: var(--badge-scan-bg);
            border-radius: 30px;
            padding: 5px 12px;
            font-size: 0.75rem;
            font-weight: 500;
            color: var(--gold-light);
        }

        .btn-edit-icon {
            background: rgba(0, 0, 0, 0.2);
            border: none;
            color: var(--gold-light);
            border-radius: 30px;
            padding: 5px 14px;
            font-size: 0.75rem;
            font-weight: 600;
            text-decoration: none;
        }

        .btn-edit-icon:hover {
            background: var(--gold-light);
            color: #121826;
        }

        .dest-url {
            font-size: 0.7rem;
            max-width: 180px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
            color: var(--text-secondary);
        }

        .title-card {
            font-weight: 700;
            font-size: 1.2rem;
            background: linear-gradient(135deg, var(--text-primary), var(--gold-light));
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
        }

        .alert-luxury {
            background: rgba(212, 175, 55, 0.2);
            backdrop-filter: blur(8px);
            border: 1px solid var(--gold-light);
            color: var(--gold-light);
            border-radius: 60px;
        }

        footer {
            margin-top: 3rem;
            text-align: center;
            font-size: 0.75rem;
            color: var(--footer-color);
        }

        @media (max-width: 768px) {
            .hero-title {
                font-size: 1.6rem;
            }

            .qr-wrapper svg {
                width: 110px;
                height: 110px;
            }

            .card-inner {
                padding: 1.2rem;
            }
        }

        .copy-short-link {
            background: transparent;
            border: none;
            color: var(--gold-light);
            font-size: 0.7rem;
        }

        .copy-short-link:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body class="">
    <div class="luxury-container container-lg">
        <!-- Header dengan Toggle Dark/Light -->
        <div class="hero-section d-flex flex-wrap justify-content-between align-items-center">
            <div>
                <h1 class="hero-title"><i class="fas fa-crown me-2" style="color: #D4AF37;"></i> Spindo Short Link and
                    Generate QR Code Manager</h1>
                <p class="hero-sub mt-2">Mode <span id="theme-status-text">Terang</span> · QR Premium dengan Unduh
                    Otomatis</p>
            </div>
            <div class="d-flex gap-3 align-items-center">
                <div class="theme-switch-wrapper">
                    <span class="theme-label"><i class="fas fa-sun"></i></span>
                    <label class="theme-switch">
                        <input type="checkbox" id="darkmode-toggle">
                        <span class="slider"></span>
                    </label>
                    <span class="theme-label"><i class="fas fa-moon"></i></span>
                </div>
                <a href="{{ route('short_links.create') }}" class="btn btn-create-luxury">
                    <i class="fas fa-plus me-2"></i> Buat QR Code
                </a>
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-luxury d-flex align-items-center mb-4">
                <i class="fas fa-check-circle me-2 fs-5"></i>
                <div>{{ session('success') }}</div>
            </div>
        @endif

        @if ($links->count())
            <div class="row g-4">
                @foreach ($links as $link)
                    @php
                        $shortUrl = url('/go/' . $link->short_code);
                    @endphp
                    <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12">
                        <div class="qr-card">
                            <div class="card-inner">
                                <div class="text-center">
                                    <div class="qr-wrapper d-inline-block" id="qr-container-{{ $link->id }}">
                                        {!! QrCode::size(140)->generate(url('/go/' . $link->short_code)) !!}
                                    </div>
                                </div>

                                <!-- Shortcut Link + Tombol Salin -->
                                <div class="shortcut-area text-center">
                                    <div class="short-link-text mb-1">
                                        <i class="fas fa-link me-1"></i> SHORTCUT PREMIUM
                                    </div>
                                    <a href="{{ $shortUrl }}" target="_blank" class="short-link-url">
                                        {{ $shortUrl }}
                                    </a>
                                    <div>
                                        <button class="copy-short-link" data-url="{{ $shortUrl }}">
                                            <i class="far fa-copy"></i> Salin tautan
                                        </button>
                                    </div>
                                </div>

                                <!-- Tombol Download Gambar QR -->
                                <button class="btn btn-download-gold download-qr-btn mt-2"
                                    data-qr-id="{{ $link->id }}" data-short="{{ $link->short_code }}">
                                    <i class="fas fa-download me-1"></i> Unduh QR Code (PNG)
                                </button>

                                <div class="info-stats">
                                    <div>
                                        <div class="title-card"><i class="fas fa-tag me-1"></i>
                                            {{ $link->title ?? 'Tanpa Judul' }}</div>
                                        <small class="dest-url">
                                            <i class="fas fa-globe me-1"></i>
                                            <a href="{{ $link->destination_url }}" target="_blank"
                                                style="color: inherit; text-decoration: none;">{{ Str::limit($link->destination_url, 45) }}</a>
                                        </small>
                                    </div>
                                    <div class="d-flex gap-2">
                                        <span class="badge-scan"><i class="fas fa-chart-simple"></i>
                                            {{ $link->clicks }} scan</span>
                                        <a href="{{ route('short_links.edit', $link->id) }}" class="btn-edit-icon">
                                            <i class="fas fa-pen-fancy"></i> Edit
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="empty-state-card text-center p-5"
                style="background: var(--card-bg); border-radius: 2rem; border:1px solid var(--card-border);">
                <i class="fas fa-qrcode fa-4x mb-3" style="color: var(--gold-light);"></i>
                <h3 style="font-weight: 500">Belum ada QR Code</h3>
                <p class="mt-2">Klik tombol “Buat QR Code” untuk menambahkan</p>
                <a href="{{ route('short_links.create') }}" class="btn btn-create-luxury mt-2">+ Buat QR Sekarang</a>
            </div>
        @endif
        <footer>
            <i class="fas fa-gem me-1"></i> Luxury QR Management · Toggle Dark/Light · Unduh QR HD
        </footer>
    </div>

    <script>
        (function() {
            // DARK MODE TOGGLE SYSTEM
            const toggle = document.getElementById('darkmode-toggle');
            const themeStatusSpan = document.getElementById('theme-status-text');

            // Cek local storage atau preferensi sistem
            const currentTheme = localStorage.getItem('luxuryTheme');
            if (currentTheme === 'dark') {
                document.body.classList.add('dark');
                if (toggle) toggle.checked = true;
                if (themeStatusSpan) themeStatusSpan.innerText = 'Gelap';
            } else if (currentTheme === 'light') {
                document.body.classList.remove('dark');
                if (toggle) toggle.checked = false;
                if (themeStatusSpan) themeStatusSpan.innerText = 'Terang';
            } else {
                // default terang
                document.body.classList.remove('dark');
                if (toggle) toggle.checked = false;
                localStorage.setItem('luxuryTheme', 'light');
                if (themeStatusSpan) themeStatusSpan.innerText = 'Terang';
            }

            if (toggle) {
                toggle.addEventListener('change', function(e) {
                    if (this.checked) {
                        document.body.classList.add('dark');
                        localStorage.setItem('luxuryTheme', 'dark');
                        if (themeStatusSpan) themeStatusSpan.innerText = 'Gelap';
                    } else {
                        document.body.classList.remove('dark');
                        localStorage.setItem('luxuryTheme', 'light');
                        if (themeStatusSpan) themeStatusSpan.innerText = 'Terang';
                    }
                });
            }

            // FUNGSI DOWNLOAD QR (Mengkonversi SVG ke PNG dengan kualitas tinggi)
            async function downloadQRCode(svgElement, filename = 'qrcode_luxury.png') {
                if (!svgElement) throw new Error('SVG tidak ditemukan');
                const clonedSvg = svgElement.cloneNode(true);
                clonedSvg.setAttribute('xmlns', 'http://www.w3.org/2000/svg');
                const originalWidth = clonedSvg.getAttribute('width') || 140;
                const originalHeight = clonedSvg.getAttribute('height') || 140;
                clonedSvg.setAttribute('width', originalWidth);
                clonedSvg.setAttribute('height', originalHeight);

                const scale = 3;
                const canvas = document.createElement('canvas');
                const ctx = canvas.getContext('2d');
                canvas.width = parseInt(originalWidth) * scale;
                canvas.height = parseInt(originalHeight) * scale;

                const serializer = new XMLSerializer();
                let svgString = serializer.serializeToString(clonedSvg);
                if (!svgString.includes('background')) {
                    svgString = svgString.replace('<svg', '<svg style="background-color: white;"');
                }
                const blob = new Blob([svgString], {
                    type: 'image/svg+xml'
                });
                const url = URL.createObjectURL(blob);
                const img = new Image();

                return new Promise((resolve, reject) => {
                    img.onload = () => {
                        ctx.imageSmoothingEnabled = true;
                        ctx.imageSmoothingQuality = 'high';
                        ctx.fillStyle = '#FFFFFF';
                        ctx.fillRect(0, 0, canvas.width, canvas.height);
                        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
                        URL.revokeObjectURL(url);
                        canvas.toBlob((blob) => {
                            if (blob) {
                                const link = document.createElement('a');
                                const objUrl = URL.createObjectURL(blob);
                                link.href = objUrl;
                                link.download = filename;
                                document.body.appendChild(link);
                                link.click();
                                document.body.removeChild(link);
                                URL.revokeObjectURL(objUrl);
                                resolve();
                            } else {
                                reject('Gagal membuat PNG');
                            }
                        }, 'image/png', 1.0);
                    };
                    img.onerror = (err) => {
                        URL.revokeObjectURL(url);
                        reject(err);
                    };
                    img.src = url;
                });
            }

            // handle download buttons
            const downloadBtns = document.querySelectorAll('.download-qr-btn');
            downloadBtns.forEach(btn => {
                btn.addEventListener('click', async function(e) {
                    e.preventDefault();
                    const qrId = this.getAttribute('data-qr-id');
                    const shortCode = this.getAttribute('data-short') || 'qrcode';
                    const card = this.closest('.qr-card');
                    if (!card) return;
                    const qrWrapper = card.querySelector('.qr-wrapper');
                    if (!qrWrapper) {
                        alert('Tidak ada kode QR');
                        return;
                    }
                    const svg = qrWrapper.querySelector('svg');
                    if (!svg) {
                        alert('Elemen SVG tidak tersedia');
                        return;
                    }

                    const originalHtml = this.innerHTML;
                    this.innerHTML = '<i class="fas fa-spinner fa-pulse"></i> Mengunduh...';
                    this.disabled = true;
                    try {
                        await downloadQRCode(svg, `qrcode_${shortCode}_premium.png`);
                        // notifikasi
                        const toast = document.createElement('div');
                        toast.innerText = '✓ QR Code tersimpan!';
                        toast.style.position = 'fixed';
                        toast.style.bottom = '25px';
                        toast.style.right = '25px';
                        toast.style.background = '#D4AF37';
                        toast.style.color = '#0a0f1e';
                        toast.style.padding = '10px 22px';
                        toast.style.borderRadius = '40px';
                        toast.style.fontWeight = 'bold';
                        toast.style.zIndex = '9999';
                        toast.style.boxShadow = '0 6px 16px rgba(0,0,0,0.2)';
                        document.body.appendChild(toast);
                        setTimeout(() => toast.remove(), 2000);
                    } catch (err) {
                        console.error(err);
                        alert('Gagal mengunduh, coba lagi.');
                    } finally {
                        this.innerHTML = originalHtml;
                        this.disabled = false;
                    }
                });
            });

            // Copy Short Link
            const copyButtons = document.querySelectorAll('.copy-short-link');
            copyButtons.forEach(btn => {
                btn.addEventListener('click', async (e) => {
                    e.preventDefault();
                    const urlToCopy = btn.getAttribute('data-url');
                    if (!urlToCopy) return;
                    try {
                        await navigator.clipboard.writeText(urlToCopy);
                        const original = btn.innerHTML;
                        btn.innerHTML = '<i class="fas fa-check"></i> Tersalin!';
                        setTimeout(() => {
                            btn.innerHTML = original;
                        }, 1500);
                    } catch (err) {
                        alert('Gagal menyalin tautan');
                    }
                });
            });
        })();
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
