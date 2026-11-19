@extends('layouts.auth')
@section('title', 'Masuk')

@section('content')
<div class="ks-frame">

    {{-- ══ HEADER ══ --}}
    <div class="ks-header">
        <div class="ks-header-deco-1"></div>
        <div class="ks-header-deco-2"></div>

        {{-- Floating Illustration --}}
        <div class="ks-illus" aria-hidden="true">
            <svg width="88" height="88" viewBox="0 0 88 88" fill="none">
                <circle cx="44" cy="44" r="40" fill="rgba(255,255,255,0.10)"/>
                <circle cx="44" cy="30" r="16" fill="rgba(255,255,255,0.90)"/>
                <circle cx="44" cy="30" r="10" fill="#2563eb"/>
                <circle cx="39" cy="26" r="3" fill="rgba(255,255,255,0.65)"/>
                <path d="M22 70c0-12 9.9-22 22-22s22 9.9 22 22" fill="rgba(255,255,255,0.90)"/>
            </svg>
        </div>

        <div class="ks-brand">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" stroke="#93c5fd" stroke-width="2" stroke-linejoin="round"/>
                <polyline points="9,22 9,12 15,12 15,22" stroke="#93c5fd" stroke-width="2"/>
            </svg>
            <span class="ks-brand-name">KOSTSOBAT</span>
        </div>
        <h1 class="ks-title">Selamat Datang!</h1>
        <p class="ks-subtitle">Masuk dan lanjutkan perjalananmu 👋</p>
    </div>

    {{-- ══ BOTTOM CARD ══ --}}
    <div class="ks-card">

        {{-- Success flash --}}
        @if (session('success'))
        <div class="ks-success" role="status">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" style="flex-shrink:0"><polyline points="20,6 9,17 4,12"/></svg>
            {{ session('success') }}
        </div>
        @endif

        {{-- Validation errors --}}
        @if ($errors->any())
        <div class="ks-alert" role="alert">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" style="flex-shrink:0;margin-top:1px"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <span>{{ $errors->first() }}</span>
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}" novalidate>
            @csrf

            {{-- Email --}}
            <div class="ks-field">
                <label class="ks-label" for="email">Email</label>
                <div class="ks-input-wrap">
                    <span class="ks-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="2" y="4" width="20" height="16" rx="3"/><polyline points="2,4 12,13 22,4"/></svg>
                    </span>
                    <input class="ks-input @error('email') is-invalid @enderror"
                           type="email" id="email" name="email"
                           placeholder="email@contoh.com"
                           value="{{ old('email') }}"
                           autocomplete="email" autofocus/>
                </div>
                @error('email')<p class="ks-error-msg">{{ $message }}</p>@enderror
            </div>

            {{-- Password --}}
            <div class="ks-field">
                <label class="ks-label" for="password">Kata Sandi</label>
                <div class="ks-input-wrap">
                    <span class="ks-icon">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                    </span>
                    <input class="ks-input @error('password') is-invalid @enderror"
                           type="password" id="password" name="password"
                           placeholder="Kata sandi kamu"
                           autocomplete="current-password"/>
                    <button type="button" class="ks-eye" onclick="togglePass('password', this)" aria-label="Tampilkan kata sandi">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                    </button>
                </div>
            </div>

            {{-- Remember + Forgot --}}
            <div style="display:flex;align-items:center;justify-content:space-between;margin-bottom:1.25rem;">
                <label class="ks-check-wrap" for="remember">
                    <input type="checkbox" id="remember" name="remember" style="position:absolute;opacity:0;width:0;height:0;" onchange="syncCheck(this)"/>
                    <div class="ks-check-box" id="checkBox">
                        <svg id="checkIcon" width="11" height="11" viewBox="0 0 12 12" fill="none" style="opacity:0;transition:opacity 0.2s;"><polyline points="1,6 4.5,9.5 11,2" stroke="#fff" stroke-width="2.2" stroke-linecap="round"/></svg>
                    </div>
                    <span style="font-size:0.82rem;color:#64748b;user-select:none;">Ingat saya</span>
                </label>
                <a href="#" style="color:#2563eb;font-size:0.82rem;font-weight:600;text-decoration:none;">Lupa sandi?</a>
            </div>

            <button type="submit" class="ks-btn" onclick="handleSubmit(this, event)">
                <span class="ks-btn-text">Masuk</span>
            </button>
        </form>

        <div class="ks-divider">atau masuk dengan</div>

        <button type="button" class="ks-btn-google">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
                <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
                <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
                <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
            </svg>
            <span>Lanjutkan dengan Google</span>
        </button>

        <div class="ks-footer">
            Belum punya akun? <a href="{{ route('register') }}" class="ks-link">Daftar</a>
        </div>
    </div>{{-- /ks-card --}}
</div>{{-- /ks-frame --}}

<script>
/* ── Password toggle ── */
function togglePass(inputId, btn) {
    const inp = document.getElementById(inputId);
    const isHidden = inp.type === 'password';
    inp.type = isHidden ? 'text' : 'password';
    const svg = btn.querySelector('svg');
    svg.innerHTML = isHidden
        ? `<path d="M17.94 17.94A10.07 10.07 0 0112 20C5 20 1 12 1 12a18.1 18.1 0 015.06-5.94" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><path d="M9.9 4.24A9.12 9.12 0 0112 4c7 0 11 8 11 8a18.5 18.5 0 01-2.16 3.19" stroke="currentColor" stroke-width="2" stroke-linecap="round"/><line x1="1" y1="1" x2="23" y2="23" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>`
        : `<path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/>`;
}

/* ── Custom checkbox sync ── */
function syncCheck(inp) {
    const box  = document.getElementById('checkBox');
    const icon = document.getElementById('checkIcon');
    if (inp.checked) {
        box.style.background    = '#2563eb';
        box.style.borderColor   = '#2563eb';
        icon.style.opacity      = '1';
    } else {
        box.style.background    = '#fff';
        box.style.borderColor   = '#cbd5e1';
        icon.style.opacity      = '0';
    }
}

/* ── Ripple + spinner ── */
function handleSubmit(btn, e) {
    const rect = btn.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height) * 1.5;
    const r = document.createElement('span');
    r.className = 'ks-ripple';
    r.style.cssText = `width:${size}px;height:${size}px;left:${e.clientX - rect.left - size/2}px;top:${e.clientY - rect.top - size/2}px;`;
    btn.appendChild(r);
    setTimeout(() => r.remove(), 700);

    btn.querySelector('.ks-btn-text').innerHTML = '<span class="ks-spinner"></span>';
    btn.disabled = true;
}
</script>
@endsection
