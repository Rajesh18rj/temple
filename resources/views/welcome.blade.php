<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Saivaperumakkalperavai – Matrimony Registration</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Madurai:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700;900&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <style>
        :root {
            --saffron: #E8550A;
            --saffron-light: #FFF0E8;
            --crimson: #9B1C1C;
            --gold: #C8860A;
            --gold-light: #FEF3C7;
            --cream: #FDFAF5;
            --ink: #1C1410;
            --muted: #6B5E52;
        }

        html { scroll-behavior: smooth; }

        body {
            font-family: 'Inter', sans-serif;
            background: var(--cream);
            color: var(--ink);
        }

        /* ── DISPLAY FONT ── */
        .font-display { font-family: 'Playfair Display', Georgia, serif; }

        /* ── HERO ── */
        .hero-section {
            min-height: 100svh;
            background:
                linear-gradient(160deg, rgba(28, 20, 16, 0.82) 0%, rgba(155, 28, 28, 0.55) 60%, rgba(200, 134, 10, 0.35) 100%),
                url('{{  asset('images/') }}') center/cover no-repeat;
            position: relative;
            overflow: hidden;
        }
        .hero-section::after {
            content: '';
            position: absolute;
            inset: 0;
            background: url("data:image/svg+xml,%3Csvg width='60' height='60' viewBox='0 0 60 60' xmlns='http://www.w3.org/2000/svg'%3E%3Cg fill='none' fill-rule='evenodd'%3E%3Cg fill='%23ffffff' fill-opacity='0.03'%3E%3Cpath d='M36 34v-4h-2v4h-4v2h4v4h2v-4h4v-2h-4zm0-30V0h-2v4h-4v2h4v4h2V6h4V4h-4zM6 34v-4H4v4H0v2h4v4h2v-4h4v-2H6zM6 4V0H4v4H0v2h4v4h2V6h4V4H6z'/%3E%3C/g%3E%3C/g%3E%3C/svg%3E");
            pointer-events: none;
        }

        /* ── NAV GLASS ── */
        .nav-glass {
            background: rgba(28, 20, 16, 0.45);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            border-bottom: 1px solid rgba(255,255,255,0.08);
        }

        /* ── KOLAM ACCENT ── */
        .kolam-dot {
            width: 6px; height: 6px;
            border-radius: 50%;
            background: var(--gold);
            display: inline-block;
        }

        /* ── CARDS ── */
        .feature-card {
            background: #fff;
            border: 1px solid rgba(200, 134, 10, 0.15);
            border-radius: 20px;
            transition: transform 0.22s ease, box-shadow 0.22s ease;
        }
        .feature-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 24px 48px rgba(28, 20, 16, 0.10);
        }

        .stat-card {
            background: rgba(255,255,255,0.12);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255,255,255,0.18);
            border-radius: 18px;
        }

        /* ── HIGHLIGHT PANEL ── */
        .panel-glass {
            background: rgba(255,255,255,0.92);
            backdrop-filter: blur(24px);
            border: 1px solid rgba(200,134,10,0.2);
            border-radius: 28px;
            box-shadow: 0 32px 80px rgba(28, 20, 16, 0.12);
        }

        /* ── SECTION CHIP ── */
        .section-chip {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: var(--saffron-light);
            color: var(--saffron);
            border: 1px solid rgba(232, 85, 10, 0.2);
            border-radius: 100px;
            padding: 6px 16px;
            font-size: 12px;
            font-weight: 600;
            letter-spacing: 0.08em;
            text-transform: uppercase;
        }

        /* ── STEP CONNECTOR ── */
        .step-line {
            position: absolute;
            top: 28px;
            left: calc(50% + 40px);
            width: calc(100% - 80px);
            height: 1px;
            background: linear-gradient(90deg, var(--gold), transparent);
        }

        /* ── CTA SECTION ── */
        .cta-section {
            background:
                linear-gradient(135deg, rgba(28,20,16,0.96) 0%, rgba(155,28,28,0.85) 100%),
                url('https://images.unsplash.com/photo-1604017011826-d3b4c23f8914?q=80&w=1200&auto=format&fit=crop') center/cover no-repeat;
            border-radius: 32px;
        }

        /* ── BTN ── */
        .btn-primary {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, var(--saffron), var(--gold));
            color: #fff;
            font-weight: 700;
            font-size: 14px;
            padding: 14px 28px;
            border-radius: 14px;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            box-shadow: 0 8px 24px rgba(232, 85, 10, 0.35);
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 12px 32px rgba(232, 85, 10, 0.45);
        }

        .btn-outline-white {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.1);
            color: #fff;
            font-weight: 600;
            font-size: 14px;
            padding: 14px 28px;
            border-radius: 14px;
            border: 1px solid rgba(255,255,255,0.25);
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
            backdrop-filter: blur(8px);
        }
        .btn-outline-white:hover {
            background: rgba(255,255,255,0.18);
        }

        /* ── PHOTO COLLAGE ── */
        .photo-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            grid-template-rows: 200px 160px;
            gap: 10px;
        }
        .photo-grid img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 16px;
        }
        .photo-grid .span-2 {
            grid-column: span 2;
            height: 200px;
        }

        /* ── LOGO PLACEHOLDER ── */
        .logo-slot {
            width: 52px;
            height: 52px;
            border-radius: 14px;
            background: rgba(255,255,255,0.12);
            border: 1.5px dashed rgba(255,255,255,0.35);
            display: flex;
            align-items: center;
            justify-content: center;
            color: rgba(255,255,255,0.5);
            font-size: 10px;
            font-weight: 600;
            letter-spacing: 0.04em;
            text-align: center;
            line-height: 1.2;
            flex-shrink: 0;
            text-transform: uppercase;
        }

        /* ── GALLERY ROW ── */
        .gallery-row {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 12px;
        }
        .gallery-row img {
            width: 100%;
            height: 220px;
            object-fit: cover;
            border-radius: 18px;
        }

        /* ── FOOTER ── */
        .footer-band {
            background: var(--ink);
            color: rgba(255,255,255,0.6);
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            .gallery-row { grid-template-columns: 1fr; }
            .gallery-row img { height: 180px; }
            .photo-grid { grid-template-rows: 160px 130px; }
        }
        @media (max-width: 640px) {
            .photo-grid .span-2 { height: 160px; }
        }

        /* ── BADGE ── */
        .badge-live {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            background: rgba(255,255,255,0.12);
            border: 1px solid rgba(255,255,255,0.2);
            border-radius: 100px;
            padding: 7px 14px;
            font-size: 12.5px;
            font-weight: 500;
            color: rgba(255,255,255,0.9);
            backdrop-filter: blur(8px);
        }
        .live-dot {
            width: 7px; height: 7px;
            border-radius: 50%;
            background: #4ADE80;
            box-shadow: 0 0 0 3px rgba(74,222,128,0.25);
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0%, 100% { opacity: 1; }
            50% { opacity: 0.5; }
        }

        /* ── DIVIDER MOTIF ── */
        .divider-motif {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--gold);
            font-size: 18px;
        }
        .divider-motif::before,
        .divider-motif::after {
            content: '';
            flex: 1;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(200,134,10,0.3), transparent);
        }
    </style>
</head>
<body>

{{-- ========================= STICKY NAV ========================= --}}
<header class="nav-glass fixed inset-x-0 top-0 z-50">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="flex items-center justify-between h-16 sm:h-18">

            {{-- LOGO SLOT + BRAND --}}
            <a href="/" class="flex items-center gap-3 min-w-0">
                     <img src="{{ asset('images/logo.jpg') }}" alt="Logo" class="h-12 w-12 rounded-xl object-contain">

                <div class="min-w-0">
                    <p class="font-sans text-white font-bold text-base sm:text-lg leading-tight tracking-tight truncate">
                        Saiva Perumakkal Peravai
                    </p>
                    <p class="tamil text-[12px] font-medium uppercase tracking-widest text-white/50 truncate">
                        திருமணப் பதிவு மையம்
                    </p>
                </div>
            </a>

            {{-- NAV LINKS --}}
            <nav class="tamil hidden md:flex items-center gap-1">
                <a href="#about" class="px-4 py-2 rounded-xl text-sm font-medium text-white/75 hover:text-white hover:bg-white/10 transition">
                    எங்களைப் பற்றி
                </a>

                <a href="#how-it-works" class="px-4 py-2 rounded-xl text-sm font-medium text-white/75 hover:text-white hover:bg-white/10 transition">
                    செயல்முறை
                </a>

                <a href="#gallery" class="px-4 py-2 rounded-xl text-sm font-medium text-white/75 hover:text-white hover:bg-white/10 transition">
                    புகைப்படங்கள்
                </a>
            </nav>

            {{-- MOBILE CTA --}}
            <a href="{{ route('profile-register.create') }}" class="tamil btn-primary md:hidden !py-2 !px-4 !text-sm">
                <i class="fa-solid fa-user-plus text-xs"></i>
                பதிவு செய்யுங்கள்
            </a>
        </div>
    </div>
</header>


{{-- ========================= HERO ========================= --}}
<section class="hero-section flex flex-col justify-center pt-16">
    <div class="relative z-10 mx-auto max-w-7xl w-full px-4 sm:px-6 lg:px-8 py-20 lg:py-28">
        <div class="grid lg:grid-cols-12 gap-12 lg:gap-16 items-center">

            {{-- LEFT --}}
            <div class="tamil lg:col-span-6 xl:col-span-7">
                <div class="badge-live mb-6 w-fit">
                    <span class="live-dot"></span>
                    சைவ திருமண மையம்
                </div>

                <h1 class="text-white text-4xl sm:text-5xl xl:text-6xl font-bold leading-[1.35] tamil">
                    சைவ சமூகத்திற்கான <br>
                    <span style="color: #F8C87A;">
        நம்பகமான திருமணப் பதிவு மையம்
    </span>
                </h1>

                <p class="mt-6 text-white/70 text-base sm:text-lg leading-relaxed max-w-xl">
                    மணமகன் அல்லது மணமகள் சுயவிவரத்தை தனிப்பட்ட தகவல்கள், குடும்ப விவரங்கள், கல்வி, தொழில், ஜாதகம் மற்றும் இருப்பிட விவரங்களுடன் ஒரே இடத்தில் எளிதாக பதிவு செய்யுங்கள்.
                </p>

                <div class="mt-8 flex flex-wrap gap-3">
                    <a href="{{ route('profile-register.create') }}" class="btn-primary">
                        <i class="fa-solid fa-address-card text-sm"></i>
                        உங்கள் சுயவிவரத்தை பதிவு செய்யுங்கள்
                    </a>

                    <a href="#about" class="btn-outline-white">
                        <i class="fa-solid fa-circle-info text-sm"></i>
                        மேலும் அறிய
                    </a>
                </div>

                {{-- STATS ROW --}}
                <div class="mt-10 grid grid-cols-3 gap-3 max-w-sm">
                    <div class="stat-card px-4 py-4 text-center">
                        <p class="font-display text-white text-2xl font-bold">500+</p>
                        <p class="text-white/55 text-xs mt-1 leading-tight">
                            பதிவு செய்யப்பட்ட<br>சுயவிவரங்கள்
                        </p>
                    </div>

                    <div class="stat-card px-4 py-4 text-center">
                        <p class="font-display text-white text-2xl font-bold">100%</p>
                        <p class="text-white/55 text-xs mt-1 leading-tight">
                            சரிபார்க்கப்பட்ட<br>சமூகம்
                        </p>
                    </div>

                    <div class="stat-card px-4 py-4 text-center">
                        <p class="font-display text-2xl font-bold text-white">சைவம்</p>
                        <p class="mt-1 text-xs leading-tight text-white/55">
                            சமூகத்தை<br>மையமாகக் கொண்டது
                        </p>
                    </div>
                </div>
            </div>

            {{-- RIGHT – GLASS CARD --}}
            <div class="lg:col-span-6 xl:col-span-5">
                <div class="panel-glass p-6 sm:p-7">
                    <div class="flex items-center gap-3 mb-5">
                        <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0"
                             style="background: linear-gradient(135deg, var(--saffron), var(--gold));">
                            <i class="fa-solid fa-id-card text-white text-sm"></i>
                        </div>
                        <div>
                            <p class="text-xs font-bold tracking-widest tamil"
                               style="color: var(--saffron);">
                                சுயவிவர பதிவு
                            </p>

                            <h2 class="text-lg font-bold text-slate-900 leading-tight tamil">
                                பதிவு செய்ய வேண்டிய விவரங்கள்
                            </h2>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3">
                        @php
                            $items = [
                                [
                                    'icon' => 'fa-user',
                                    'color' => '#E8550A',
                                    'bg' => '#FFF0E8',
                                    'title' => 'தனிப்பட்ட விவரங்கள்',
                                    'desc' => 'பெயர், பிறந்த தேதி, உயரம், பாலினம்'
                                ],
                                [
                                    'icon' => 'fa-users',
                                    'color' => '#C8860A',
                                    'bg' => '#FEF3C7',
                                    'title' => 'குடும்ப விவரங்கள்',
                                    'desc' => 'தந்தை பெயர் மற்றும் குடும்பத் தகவல்கள்'
                                ],
                                [
                                    'icon' => 'fa-graduation-cap',
                                    'color' => '#4F46E5',
                                    'bg' => '#EEF2FF',
                                    'title' => 'கல்வி',
                                    'desc' => 'படிப்பு மற்றும் தகுதிகள்'
                                ],
                                [
                                    'icon' => 'fa-briefcase',
                                    'color' => '#059669',
                                    'bg' => '#ECFDF5',
                                    'title' => 'தொழில் & வருமானம்',
                                    'desc' => 'பணி மற்றும் வருமான விவரங்கள்'
                                ],
                                [
                                    'icon' => 'fa-star',
                                    'color' => '#DB2777',
                                    'bg' => '#FDF2F8',
                                    'title' => 'ராசி & நட்சத்திரம்',
                                    'desc' => 'ராசி மற்றும் நட்சத்திர விவரங்கள்'
                                ],
                                [
                                    'icon' => 'fa-location-dot',
                                    'color' => '#0891B2',
                                    'bg' => '#ECFEFF',
                                    'title' => 'சொந்த ஊர் & பணியிடம்',
                                    'desc' => 'வசிப்பிடம் மற்றும் பணியிடம்'
                                ],
                            ];
                        @endphp

                        @foreach($items as $item)
                            <div class="rounded-2xl border p-3.5 transition hover:shadow-sm"
                                 style="border-color: rgba(0,0,0,0.07); background: #fafaf9;">

                                <div class="w-9 h-9 rounded-xl flex items-center justify-center"
                                     style="background: {{ $item['bg'] }};">
                                    <i class="fa-solid {{ $item['icon'] }} text-sm"
                                       style="color: {{ $item['color'] }};"></i>
                                </div>

                                <p class="mt-2.5 text-sm font-semibold text-slate-800 tamil">
                                    {{ $item['title'] }}
                                </p>

                                <p class="mt-0.5 text-xs text-slate-400 leading-snug tamil">
                                    {{ $item['desc'] }}
                                </p>
                            </div>
                        @endforeach
                    </div>

                    <a href="{{ route('profile-register.create') }}"
                       class="tamil mt-5 btn-primary w-full justify-center">
                        <i class="fa-solid fa-user-plus text-sm"></i>
                        இப்போதே பதிவு செய்யுங்கள்
                    </a>
                </div>
            </div>
        </div>
    </div>

    {{-- WAVE --}}
    <div class="relative z-10 w-full overflow-hidden leading-none" style="height: 60px;">
        <svg viewBox="0 0 1440 60" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none" style="width:100%;height:100%;display:block;">
            <path d="M0,40 C360,0 1080,60 1440,20 L1440,60 L0,60 Z" fill="#FDFAF5"/>
        </svg>
    </div>
</section>


{{-- ========================= GALLERY ROW ========================= --}}
<section id="gallery" class="py-16 sm:py-20" style="background: var(--cream);">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="text-center mb-10 tamil">
            <div class="divider-motif">
                <i class="fa-solid fa-om"></i>
            </div>
            <p class="mt-4 text-sm font-semibold uppercase tracking-widest" style="color: var(--gold);">சைவப் பெருமக்கள் பேரவை</p>
            <h2 class="text-3xl sm:text-4xl font-bold mt-2" style="color: var(--ink);">புனிதமான திருமண உறவுகளை இணைக்கும் நம்பிக்கையான தளம்</h2>
        </div>

        <div class="gallery-row">
            <img src="{{ asset('images/img1.jpg') }}"
                 alt="Traditional wedding" >
            <img src="{{ asset('images/img3.jpg') }}"
                 alt="Wedding ceremony">
            <img src="{{ asset('images/img2.jpg') }}"
                 alt="Couple celebration">
        </div>
    </div>
</section>


{{-- ========================= ABOUT ========================= --}}
<section id="about" class="py-20 sm:py-24" style="background: #fff;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="grid lg:grid-cols-12 gap-12 items-center">

            {{-- PHOTO COLLAGE --}}
            <div class="lg:col-span-5">
                <div class="photo-grid">
                    <img class="span-2" src="{{ asset('images/img4.jpg') }}" alt="Wedding decoration" >
                    <img src="{{ asset('images/img5.jpg') }}" alt="Floral mandap">
                    <img src="{{ asset('images/img6.jpg') }}" alt="Traditional attire">
                    <img src="{{ asset('images/img7.jpg') }}" alt="Floral mandap">
                    <img src="{{ asset('images/img8.jpg') }}" alt="Traditional attire">
                    <img src="{{ asset('images/img9.jpg') }}" alt="Floral mandap">
                    <img src="{{ asset('images/img10.jpg') }}" alt="Traditional attire">

                </div>
                {{-- FLOATING BADGE --}}
                <div class="mt-4 inline-flex items-center gap-3 bg-white border rounded-2xl px-5 py-3.5 shadow-lg" style="border-color: rgba(200,134,10,0.2);">
                    <div class="w-10 h-10 rounded-xl flex items-center justify-center shrink-0" style="background: var(--gold-light);">
                        <i class="fa-solid fa-heart text-sm" style="color: var(--saffron);"></i>
                    </div>
                    <div class="tamil">
                        <p class="text-sm font-bold" style="color: var(--ink);">2010 முதல் நம்பிக்கையுடன்</p>
                        <p class="text-xs" style="color: var(--muted);">சைவ சமூகத்திற்கு அர்ப்பணிப்புடன் சேவையாற்றுகிறோம்</p>
                    </div>
                </div>
            </div>

            {{-- TEXT --}}
            <div class="tamil lg:col-span-7">
                <span class="section-chip">எங்களைப் பற்றி</span>

                <h2 class="text-3xl sm:text-4xl font-bold mt-5 leading-tight" style="color: var(--ink);">
                    சைவப் பெருமக்கள் பேரவை திருமணத் தகவல் மையம்...
                </h2>

                <p class="mt-5 text-base leading-8 tamil" style="color: var(--muted);">
                    சைவப் பெருமக்கள் பேரவை திருமணத் தகவல் மையம், மணமகன் மற்றும் மணமகள் சுயவிவரங்களை
                    ஒழுங்குபடுத்தப்பட்ட மற்றும் நம்பகமான முறையில் பதிவு செய்வதற்காக உருவாக்கப்பட்டுள்ளது.
                    குடும்பங்கள் மற்றும் தனிநபர்கள் தங்களின் தனிப்பட்ட விவரங்கள், குடும்ப விவரங்கள்,
                    கல்வி, தொழில், வருமானம், நட்சத்திரம், இருப்பிடம் உள்ளிட்ட அனைத்து தகவல்களையும்
                    பதிவு செய்து, எங்கள் சமூகத்திற்குள் சிறந்த வாழ்க்கைத் துணையைத் தேட உதவுகிறது.
                </p>

                <div class="mt-8 grid sm:grid-cols-2 gap-4">

                    <div class="feature-card p-5">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center"
                             style="background: var(--saffron-light);">
                            <i class="fa-solid fa-file-signature text-lg"
                               style="color: var(--saffron);"></i>
                        </div>

                        <h3 class="mt-4 font-bold text-slate-800 tamil">
                            எளிய பதிவு முறை
                        </h3>

                        <p class="mt-2 text-sm leading-7 text-slate-500 tamil">
                            படிப்படியாக வடிவமைக்கப்பட்ட எளிய பதிவு முறையில் உங்கள் திருமணத் தகவல்களை முழுமையாக பதிவு செய்யலாம்.
                        </p>
                    </div>

                    <div class="feature-card p-5">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center"
                             style="background: var(--gold-light);">
                            <i class="fa-solid fa-magnifying-glass text-lg"
                               style="color: var(--gold);"></i>
                        </div>

                        <h3 class="mt-4 font-bold text-slate-800 tamil">
                            துல்லியமான பொருத்தம்
                        </h3>

                        <p class="mt-2 text-sm leading-7 text-slate-500 tamil">
                            நட்சத்திரம், கல்வி, வருமானம் மற்றும் இருப்பிட விவரங்களின் அடிப்படையில் சிறந்த பொருத்தத்தைத் தேர்வு செய்ய உதவுகிறது.
                        </p>
                    </div>

                    <div class="feature-card p-5">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center"
                             style="background: #ECFDF5;">
                            <i class="fa-solid fa-shield-heart text-lg"
                               style="color: #059669;"></i>
                        </div>

                        <h3 class="mt-4 font-bold text-slate-800 tamil">
                            பாதுகாப்பும் தனியுரிமையும்
                        </h3>

                        <p class="mt-2 text-sm leading-7 text-slate-500 tamil">
                            உங்கள் சுயவிவரத் தகவல்கள் சைவப் பெருமக்கள் பேரவை சமூக உறுப்பினர்களுக்குள் மட்டுமே பாதுகாப்பாக பகிரப்படும்.
                        </p>
                    </div>

                    <div class="feature-card p-5">
                        <div class="w-12 h-12 rounded-2xl flex items-center justify-center"
                             style="background: #EEF2FF;">
                            <i class="fa-solid fa-people-group text-lg"
                               style="color: #4F46E5;"></i>
                        </div>

                        <h3 class="mt-4 font-bold text-slate-800 tamil">
                            சமூகத்தை மையமாகக் கொண்டது
                        </h3>

                        <p class="mt-2 text-sm leading-7 text-slate-500 tamil">
                            சைவ சமூகத்தின் மரபுகள், பண்பாடு மற்றும் திருமணத் தேவைகளை கருத்தில் கொண்டு உருவாக்கப்பட்ட தளம்.
                        </p>
                    </div>

                </div>
            </div>
        </div>
    </div>
</section>


{{-- ========================= HOW IT WORKS ========================= --}}
<section id="how-it-works" class="py-20 sm:py-24" style="background: var(--cream);">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">

        <div class="text-center max-w-2xl mx-auto mb-14">
            <span class="section-chip font-700 tamil">எவ்வாறு செயல்படுகிறது ?</span>

            <h2 class="text-3xl sm:text-4xl font-700 mt-5 tamil" style="color: var(--ink);">
                3 எளிய படிகளில் உங்கள் சுயவிவரத்தை பதிவு செய்யுங்கள்
            </h2>

            <p class="mt-4 text-slate-500 text-base tamil">
                மணமகன் மற்றும் மணமகள் சுயவிவரங்களை எளிதாக பதிவு செய்ய வழிகாட்டும் பதிவு முறை.
            </p>
        </div>

        <div class="grid lg:grid-cols-3 gap-6">

            {{-- Step 1 --}}
            <div class="feature-card p-7 relative">
                <div class="flex items-center gap-4 mb-5">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center shrink-0"
                         style="background: var(--saffron-light);">
                        <i class="fa-solid fa-file-pen text-xl" style="color: var(--saffron);"></i>
                    </div>

                    <div>
                        <span class="text-xs font-bold tracking-widest tamil"
                              style="color: var(--gold);">
                            படி 01
                        </span>

                        <h3 class="text-lg font-bold text-slate-800 tamil">
                            பதிவு படிவத்தைத் திறக்கவும்
                        </h3>
                    </div>
                </div>

                <p class="text-sm leading-7 text-slate-500 tamil">
                    திருமணப் பதிவு படிவத்தைத் திறந்து, படிப்படியாக வழங்கப்படும் வழிகாட்டுதலின் மூலம் உங்கள் சுயவிவரத்தை எளிதாக பதிவு செய்யுங்கள்.                </p>

                <img src="{{ asset('images/register.jpg') }}"
                     alt="Open form"
                     class="mt-5 w-full h-36 object-cover rounded-xl">
            </div>

            {{-- Step 2 --}}
            <div class="feature-card p-7">
                <div class="flex items-center gap-4 mb-5">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center shrink-0"
                         style="background: var(--gold-light);">
                        <i class="fa-solid fa-pen-to-square text-xl" style="color: var(--gold);"></i>
                    </div>

                    <div>
                        <span class="text-xs font-bold tracking-widest tamil"
                              style="color: var(--gold);">
                            படி 02
                        </span>

                        <h3 class="text-lg font-bold text-slate-800 tamil">
                            உங்கள் விவரங்களை நிரப்புங்கள்
                        </h3>
                    </div>
                </div>

                <p class="text-sm leading-7 text-slate-500 tamil">
                    தனிப்பட்ட தகவல்கள், குடும்ப விவரங்கள், கல்வி, தொழில், வருமானம், ராசி, நட்சத்திரம் மற்றும் இருப்பிட விவரங்களை முழுமையாக பதிவு செய்யுங்கள்.
                </p>

                <img src="{{ asset('images/fill.jpg') }}"
                     alt="Fill details"
                     class="mt-5 w-full h-36 object-cover rounded-xl">
            </div>

            {{-- Step 3 --}}
            <div class="feature-card p-7">
                <div class="flex items-center gap-4 mb-5">
                    <div class="w-14 h-14 rounded-2xl flex items-center justify-center shrink-0"
                         style="background: #ECFDF5;">
                        <i class="fa-solid fa-paper-plane text-xl" style="color: #059669;"></i>
                    </div>

                    <div>
                        <span class="text-xs font-bold tracking-widest tamil"
                              style="color: var(--gold);">
                            படி 03
                        </span>

                        <h3 class="text-lg font-bold text-slate-800 tamil">
                            சுயவிவரத்தை சமர்ப்பிக்கவும்
                        </h3>
                    </div>
                </div>

                <p class="text-sm leading-7 text-slate-500 tamil">
                    அனைத்து விவரங்களையும் சரிபார்த்து சுயவிவரத்தை சமர்ப்பிக்கவும். அதன் பிறகு உங்கள் பதிவு எங்கள் சமூகத்தின் திருமணத் தகவல் பட்டியலில் இடம்பெறும்.
                </p>

                <img src="{{ asset('images/submit.jpg') }}"
                     alt="Submit profile"
                     class="mt-5 w-full h-36 object-cover rounded-xl">
            </div>

        </div>

    </div>
</section>

{{-- ========================= CTA STRIP ========================= --}}
<section class="py-16 sm:py-20" style="background: #fff;">
    <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
        <div class="cta-section px-8 py-14 sm:px-12 sm:py-16 overflow-hidden relative">

            {{-- Decorative circles --}}
            <div class="pointer-events-none absolute -right-16 -top-16 w-72 h-72 rounded-full opacity-10" style="background: radial-gradient(circle, #C8860A, transparent);"></div>
            <div class="pointer-events-none absolute -left-12 -bottom-12 w-64 h-64 rounded-full opacity-10" style="background: radial-gradient(circle, #E8550A, transparent);"></div>

            <div class="tamil relative flex flex-col lg:flex-row lg:items-center lg:justify-between gap-8">
                <div class="max-w-xl">
        <span class="section-chip !bg-white/10 !text-amber-200 !border-white/20">
            சைவப் பெருமக்கள் பேரவை
        </span>

                    <h2 class="font-display text-3xl sm:text-4xl font-bold text-white mt-5 leading-tight tamil">
                        உங்கள் வாழ்க்கைத் துணையைத் தேடும் பயணத்தை இன்றே தொடங்குங்கள்
                    </h2>

                    <p class="mt-4 text-white/65 text-base leading-8 tamil">
                        மணமகன் அல்லது மணமகள் சுயவிவரத்தை தனிப்பட்ட தகவல்கள், குடும்ப விவரங்கள்,
                        கல்வி, தொழில், ஜாதகம் மற்றும் தேவையான அனைத்து விவரங்களுடன் பதிவு செய்து,
                        உங்கள் வாழ்க்கைத் துணையை எளிதாகத் தேர்வு செய்யுங்கள்.
                    </p>
                </div>

                <div class="flex flex-col sm:flex-row gap-3 shrink-0">
                    <a href="#" class="btn-primary">
                        <i class="fa-solid fa-user-plus text-sm"></i>
                        இப்போதே பதிவு செய்யுங்கள்
                    </a>

                    <a href="#about" class="btn-outline-white">
                        <i class="fa-solid fa-circle-info text-sm"></i>
                        எங்களைப் பற்றி
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


{{-- ========================= FOOTER ========================= --}}
<footer class="relative mt-24 overflow-hidden bg-gradient-to-b from-slate-950 via-slate-900 to-black">

    {{-- Decorative Top --}}
    <div class="absolute inset-x-0 top-0 h-px bg-gradient-to-r from-transparent via-orange-500 to-transparent"></div>

    <div class="absolute -top-24 left-0 w-72 h-72 rounded-full bg-orange-500/10 blur-3xl"></div>

    <div class="absolute bottom-0 right-0 w-80 h-80 rounded-full bg-red-600/10 blur-3xl"></div>


    <div class="relative max-w-7xl mx-auto px-6 py-10">

        <div class="rounded-3xl
                    border border-white/10
                    bg-white/5
                    backdrop-blur-xl
                    p-6 lg:p-8
                    shadow-[0_20px_60px_rgba(0,0,0,.4)]">

            <div class="grid lg:grid-cols-12 gap-8 items-center">

                {{-- LEFT --}}
                <div class="lg:col-span-4">

                    <div class="flex items-center gap-3">

                        <div class="relative">

                            <div class="absolute inset-0 rounded-2xl bg-orange-500 blur-lg opacity-40"></div>

                            <img
                                src="{{ asset('images/logo.jpg') }}"
                                class="relative w-12 h-12 rounded-2xl object-cover border border-white/20">

                        </div>

                        <div>
                            <h3 class="text-orange-400 text-md font-semibold leading-tight">
                                Saiva Perumakkal Peravai
                            </h3>

                        </div>

                    </div>

                    <p class="mt-4 text-slate-400 text-sm leading-6">
                        சைவ சமூகத்தினருக்கு பாதுகாப்பாகவும் நம்பிக்கையுடனும் சிறந்த திருமணத் தொடர்புகளை உருவாக்க உதவுகிறோம்.                    </p>

                    <div class="flex gap-2.5 mt-5">

                        <a href="#" class="group w-9 h-9 rounded-xl bg-white/10 hover:bg-orange-500 transition flex items-center justify-center">
                            <i class="fab fa-facebook-f text-white text-sm group-hover:scale-110 transition"></i>
                        </a>

                        <a href="#" class="group w-9 h-9 rounded-xl bg-white/10 hover:bg-pink-500 transition flex items-center justify-center">
                            <i class="fab fa-instagram text-white text-sm group-hover:scale-110 transition"></i>
                        </a>

                        <a href="#" class="group w-9 h-9 rounded-xl bg-white/10 hover:bg-red-600 transition flex items-center justify-center">
                            <i class="fab fa-youtube text-white text-sm group-hover:scale-110 transition"></i>
                        </a>

                        <a href="#" class="group w-9 h-9 rounded-xl bg-white/10 hover:bg-sky-500 transition flex items-center justify-center">
                            <i class="fab fa-x-twitter text-white text-sm group-hover:scale-110 transition"></i>
                        </a>

                    </div>

                </div>


                {{-- LINKS --}}
                <div class="lg:col-span-2">

                    <h3 class="text-sm font-semibold text-white mb-4 tracking-wide tamil">
                        தகவல் பிரிவுகள்
                    </h3>

                    <div class="space-y-3 text-sm">

                        <a href="#about"
                           class="flex items-center gap-2 text-slate-400 hover:text-orange-400 transition tamil">
                            <i class="fa-solid fa-angle-right text-xs text-orange-400"></i>
                            <span>எங்களைப் பற்றி</span>
                        </a>

                        <a href="#how-it-works"
                           class="flex items-center gap-2 text-slate-400 hover:text-orange-400 transition tamil">
                            <i class="fa-solid fa-angle-right text-xs text-orange-400"></i>
                            <span>செயல்முறை</span>
                        </a>

                        <a href="#gallery"
                           class="flex items-center gap-2 text-slate-400 hover:text-orange-400 transition tamil">
                            <i class="fa-solid fa-angle-right text-xs text-orange-400"></i>
                            <span>புகைப்படங்கள்</span>
                        </a>

                        <a href="#faq"
                           class="flex items-center gap-2 text-slate-400 hover:text-orange-400 transition tamil">
                            <i class="fa-solid fa-angle-right text-xs text-orange-400"></i>
                            <span>கேள்விகள்</span>
                        </a>

                    </div>
                </div>

                {{-- CONTACT --}}
                <div class="lg:col-span-3">

                    <h3 class="text-sm font-semibold text-white mb-4 tracking-wide uppercase">
                        Contact
                    </h3>

                    <div class="space-y-2.5 text-sm text-slate-400">

                        <div class="flex gap-2.5">
                            <i class="fa-solid fa-location-dot text-orange-400 mt-0.5"></i>
                            Tamil Nadu
                        </div>

                        <div class="flex gap-2.5">
                            <i class="fa-solid fa-phone text-orange-400"></i>
                            +91 9876543210
                        </div>

                        <div class="flex gap-2.5">
                            <i class="fa-solid fa-envelope text-orange-400"></i>
                            info@example.com
                        </div>

                    </div>

                </div>


                {{-- CTA --}}
                <div class="lg:col-span-3">

                    <a href="{{ route('profile-register.create') }}"
                       class="group flex items-center justify-between gap-3
                              rounded-2xl
                              bg-gradient-to-br from-orange-500 via-orange-600 to-red-600
                              px-5 py-4
                              shadow-lg
                              hover:scale-[1.02]
                              transition">

                        <div>
                            <h3 class="text-white text-sm font-bold tamil">
                                சைவப் பெருமக்கள் பேரவையில் இணையுங்கள்
                            </h3>
                            <p class="text-orange-200 text-xs mt-0.5  tamil">
                                உங்கள் சுயவிவரத்தை இன்றே பதிவு செய்யுங்கள்
                            </p>
                        </div>

                        <span class="w-9 h-9 rounded-full bg-white text-orange-600 flex items-center justify-center shrink-0 group-hover:translate-x-0.5 transition">
                            <i class="fa-solid fa-arrow-right text-sm"></i>
                        </span>

                    </a>

                </div>

            </div>

            <div class="my-6 h-px bg-gradient-to-r from-transparent via-white/15 to-transparent"></div>

            <div class="flex flex-col lg:flex-row justify-between items-center gap-4 text-sm">

                <p class="text-slate-500">
                    © {{ date('Y') }}
                    <span class="text-white font-semibold">
                        Saiva Perumakkal Peravai
                    </span>
                    · All Rights Reserved.
                </p>

                <div class="flex gap-6">

                    <a href="#" class="text-slate-500 hover:text-white transition">
                        Privacy Policy
                    </a>

                    <a href="#" class="text-slate-500 hover:text-white transition">
                        Terms & Conditions
                    </a>

                    <a href="#" class="text-slate-500 hover:text-white transition">
                        Support
                    </a>

                </div>

            </div>

        </div>

    </div>

</footer>
</body>
</html>
