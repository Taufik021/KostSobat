@extends('layouts.auth')
@section('title', 'Daftar Akun')

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
                <rect x="20" y="26" width="48" height="38" rx="8" fill="rgba(255,255,255,0.90)"/>
                <rect x="28" y="37" width="32" height="5" rx="2.5" fill="#93c5fd"/>
                <rect x="28" y="47" width="22" height="4" rx="2" fill="#bfdbfe"/>
                <circle cx="44" cy="20" r="10" fill="rgba(255,255,255,0.90)"/>
                <circle cx="44" cy="20" r="6" fill="#2563eb"/>
                <path d="M41 20l2.5 2.5L48 17" stroke="#fff" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        <div class="ks-brand">
            <svg width="20" height="20" viewBox="0 0 24 24" fill="none">
                <path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z" stroke="#93c5fd" stroke-width="2" stroke-linejoin="round"/>
                <polyline points="9,22 9,12 15,12 15,22" stroke="#93c5fd" stroke-width="2"/>
            </svg>
            <span class="ks-brand-name">KOSTSOBAT</span>
        </div>
        <h1 class="ks-title">Buat Akun Baru</h1>
        <p class="ks-subtitle">Daftar dan temukan kos impianmu 🏠</p>
    </div>

    {{-- ══ BOTTOM CARD ══ --}}
    <div class="ks-card">

        {{-- Error bag --}}
        @if ($errors->any())
        <div class="ks-alert" role="alert">
            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" style="flex-shrink:0;margin-top:1px"><circle cx="12" cy="12" r="10"/><line x1="12" y1="8" x2="12" y2="12"/><line x1="12" y1="16" x2="12.01" y2="16"/></svg>
            <ul style="margin:0;padding:0;list-style:none;">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        {{-- ── Segmented Control ── --}}
        <div class="ks-seg" role="tablist">
            <div class="ks-seg-pill" id="segPill" aria-hidden="true"></div>
            <button type="button" class="ks-seg-btn ks-active" id="tabPenghuni"
                    role="tab" aria-selected="true" aria-controls="panelPenghuni"
                    onclick="switchTab('penghuni')">Penghuni</button>
            <button type="button" class="ks-seg-btn" id="tabPemilik"
                    role="tab" aria-selected="false" aria-controls="panelPemilik"
                    onclick="switchTab('pemilik')">Pemilik</button>
        </div>

        {{-- ── Forms Wrapper ── --}}
        <div class="ks-forms-wrap" id="formsWrap">

            {{-- Form Penghuni --}}
            <div class="ks-form-panel ks-visible" id="panelPenghuni" role="tabpanel">
                <form method="POST" action="{{ route('register') }}" id="formPenghuni" novalidate>
                    @csrf
                    <input type="hidden" name="role" value="penghuni"/>

                    {{-- Nama --}}
                    <div class="ks-field">
                        <label class="ks-label" for="ph_name">Nama Lengkap</label>
                        <div class="ks-input-wrap">
                            <span class="ks-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                            </span>
                            <input class="ks-input @error('name') is-invalid @enderror"
                                   type="text" id="ph_name" name="name"
                                   placeholder="Masukkan nama lengkap"
                                   value="{{ old('name') }}" autocomplete="name"/>
                        </div>
                        @error('name')<p class="ks-error-msg">{{ $message }}</p>@enderror
                    </div>

                    {{-- Email --}}
                    <div class="ks-field">
                        <label class="ks-label" for="ph_email">Email</label>
                        <div class="ks-input-wrap">
                            <span class="ks-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="2" y="4" width="20" height="16" rx="3"/><polyline points="2,4 12,13 22,4"/></svg>
                            </span>
                            <input class="ks-input @error('email') is-invalid @enderror"
                                   type="email" id="ph_email" name="email"
                                   placeholder="email@contoh.com"
                                   value="{{ old('email') }}" autocomplete="email"/>
                        </div>
                        @error('email')<p class="ks-error-msg">{{ $message }}</p>@enderror
                    </div>

                    {{-- No Telp --}}
                    <div class="ks-field">
                        <label class="ks-label" for="ph_phone">No. Telepon</label>
                        <div class="ks-input-wrap">
                            <span class="ks-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M22 16.9a19.5 19.5 0 01-5.5 5.1c-5.3-1-9.3-5-10.3-10.4A19.5 19.5 0 011.1 6a2 2 0 011.5-2.8l3.1-.4a2 2 0 012 1.5l.8 3.3a2 2 0 01-.6 1.9l-1.5 1.4a16 16 0 007.2 7.2l1.4-1.5a2 2 0 011.9-.6l3.3.8a2 2 0 011.5 2z"/></svg>
                            </span>
                            <input class="ks-input @error('phone') is-invalid @enderror"
                                   type="tel" id="ph_phone" name="phone"
                                   placeholder="+62 812 3456 7890"
                                   value="{{ old('phone') }}" autocomplete="tel"/>
                        </div>
                        @error('phone')<p class="ks-error-msg">{{ $message }}</p>@enderror
                    </div>

                    {{-- Kampus/Instansi --}}
                    <div class="ks-field">
                        <label class="ks-label" for="ph_institution">Kampus / Instansi</label>
                        <div class="ks-input-wrap">
                            <span class="ks-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M12 2L3 7v1h18V7L12 2z"/><rect x="4" y="10" width="2" height="8"/><rect x="11" y="10" width="2" height="8"/><rect x="18" y="10" width="2" height="8"/><rect x="2" y="18" width="20" height="2" rx="1"/></svg>
                            </span>
                            <input class="ks-input @error('institution') is-invalid @enderror"
                                   type="text" id="ph_institution" name="institution"
                                   placeholder="Nama universitas / instansi"
                                   value="{{ old('institution') }}"/>
                        </div>
                        @error('institution')<p class="ks-error-msg">{{ $message }}</p>@enderror
                    </div>

                    {{-- Password --}}
                    <div class="ks-field">
                        <label class="ks-label" for="ph_password">Kata Sandi</label>
                        <div class="ks-input-wrap">
                            <span class="ks-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                            </span>
                            <input class="ks-input @error('password') is-invalid @enderror"
                                   type="password" id="ph_password" name="password"
                                   placeholder="Min. 8 karakter"
                                   autocomplete="new-password"
                                   oninput="checkStrength(this.value)"/>
                            <button type="button" class="ks-eye" onclick="togglePass('ph_password', this)" aria-label="Tampilkan kata sandi">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                        <div class="ks-strength" id="strengthBar" aria-label="Kekuatan kata sandi">
                            <div class="ks-strength-seg" id="ss1"></div>
                            <div class="ks-strength-seg" id="ss2"></div>
                            <div class="ks-strength-seg" id="ss3"></div>
                            <div class="ks-strength-seg" id="ss4"></div>
                        </div>
                        @error('password')<p class="ks-error-msg">{{ $message }}</p>@enderror
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="ks-field">
                        <label class="ks-label" for="ph_password_confirmation">Konfirmasi Kata Sandi</label>
                        <div class="ks-input-wrap">
                            <span class="ks-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                            </span>
                            <input class="ks-input" type="password" id="ph_password_confirmation"
                                   name="password_confirmation" placeholder="Ulangi kata sandi"
                                   autocomplete="new-password"/>
                            <button type="button" class="ks-eye" onclick="togglePass('ph_password_confirmation', this)" aria-label="Tampilkan konfirmasi kata sandi">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="ks-btn" onclick="handleSubmit(this, event)">
                        <span class="ks-btn-text">Daftar Sekarang</span>
                    </button>
                </form>
            </div>{{-- /panelPenghuni --}}

            {{-- Form Pemilik --}}
            <div class="ks-form-panel ks-right" id="panelPemilik" role="tabpanel">
                <form method="POST" action="{{ route('register') }}" id="formPemilik" novalidate>
                    @csrf
                    <input type="hidden" name="role" value="pemilik"/>

                    {{-- Nama --}}
                    <div class="ks-field">
                        <label class="ks-label" for="pm_name">Nama Lengkap Pemilik</label>
                        <div class="ks-input-wrap">
                            <span class="ks-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
                            </span>
                            <input class="ks-input" type="text" id="pm_name" name="name"
                                   placeholder="Nama pemilik kos"
                                   value="{{ old('name') }}" autocomplete="name"/>
                        </div>
                    </div>

                    {{-- Email --}}
                    <div class="ks-field">
                        <label class="ks-label" for="pm_email">Email</label>
                        <div class="ks-input-wrap">
                            <span class="ks-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="2" y="4" width="20" height="16" rx="3"/><polyline points="2,4 12,13 22,4"/></svg>
                            </span>
                            <input class="ks-input" type="email" id="pm_email" name="email"
                                   placeholder="email@contoh.com"
                                   value="{{ old('email') }}" autocomplete="email"/>
                        </div>
                    </div>

                    {{-- No Telp --}}
                    <div class="ks-field">
                        <label class="ks-label" for="pm_phone">No. Telepon</label>
                        <div class="ks-input-wrap">
                            <span class="ks-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M22 16.9a19.5 19.5 0 01-5.5 5.1c-5.3-1-9.3-5-10.3-10.4A19.5 19.5 0 011.1 6a2 2 0 011.5-2.8l3.1-.4a2 2 0 012 1.5l.8 3.3a2 2 0 01-.6 1.9l-1.5 1.4a16 16 0 007.2 7.2l1.4-1.5a2 2 0 011.9-.6l3.3.8a2 2 0 011.5 2z"/></svg>
                            </span>
                            <input class="ks-input" type="tel" id="pm_phone" name="phone"
                                   placeholder="+62 812 3456 7890"
                                   value="{{ old('phone') }}" autocomplete="tel"/>
                        </div>
                    </div>

                    {{-- Nama Kos --}}
                    <div class="ks-field">
                        <label class="ks-label" for="pm_kos_name">Nama Kos</label>
                        <div class="ks-input-wrap">
                            <span class="ks-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/><polyline points="9,22 9,12 15,12 15,22"/></svg>
                            </span>
                            <input class="ks-input" type="text" id="pm_kos_name" name="kos_name"
                                   placeholder="Contoh: Kos Bahagia"
                                   value="{{ old('kos_name') }}"/>
                        </div>
                    </div>

                    {{-- Alamat Kos --}}
                    <div class="ks-field">
                        <label class="ks-label" for="pm_kos_address">Alamat Kos</label>
                        <div class="ks-input-wrap">
                            <span class="ks-icon" style="top:1rem;transform:none;">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M21 10c0 7-9 13-9 13S3 17 3 10a9 9 0 0118 0z"/><circle cx="12" cy="10" r="3"/></svg>
                            </span>
                            <textarea class="ks-input" id="pm_kos_address" name="kos_address"
                                      rows="2" placeholder="Jl. Contoh No.1, Kecamatan, Kota">{{ old('kos_address') }}</textarea>
                        </div>
                    </div>

                    {{-- Jumlah Kamar --}}
                    <div class="ks-field">
                        <label class="ks-label" for="pm_kos_rooms">Jumlah Kamar</label>
                        <div class="ks-input-wrap">
                            <span class="ks-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 00-4 0v2"/></svg>
                            </span>
                            <input class="ks-input" type="number" id="pm_kos_rooms" name="kos_rooms"
                                   placeholder="Jumlah kamar tersedia" min="1"
                                   value="{{ old('kos_rooms') }}"/>
                        </div>
                    </div>

                    {{-- Password --}}
                    <div class="ks-field">
                        <label class="ks-label" for="pm_password">Kata Sandi</label>
                        <div class="ks-input-wrap">
                            <span class="ks-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                            </span>
                            <input class="ks-input" type="password" id="pm_password" name="password"
                                   placeholder="Min. 8 karakter" autocomplete="new-password"/>
                            <button type="button" class="ks-eye" onclick="togglePass('pm_password', this)" aria-label="Tampilkan kata sandi">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                    </div>

                    {{-- Konfirmasi Password --}}
                    <div class="ks-field">
                        <label class="ks-label" for="pm_password_confirmation">Konfirmasi Kata Sandi</label>
                        <div class="ks-input-wrap">
                            <span class="ks-icon">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><rect x="3" y="11" width="18" height="11" rx="2"/><path d="M7 11V7a5 5 0 0110 0v4"/></svg>
                            </span>
                            <input class="ks-input" type="password" id="pm_password_confirmation"
                                   name="password_confirmation" placeholder="Ulangi kata sandi"
                                   autocomplete="new-password"/>
                            <button type="button" class="ks-eye" onclick="togglePass('pm_password_confirmation', this)" aria-label="Tampilkan konfirmasi">
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"/><circle cx="12" cy="12" r="3"/></svg>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="ks-btn" onclick="handleSubmit(this, event)">
                        <span class="ks-btn-text">Daftar Sekarang</span>
                    </button>
                </form>
            </div>{{-- /panelPemilik --}}

        </div>{{-- /formsWrap --}}

        <div class="ks-footer">
            Sudah punya akun? <a href="{{ route('login') }}" class="ks-link">Masuk</a>
        </div>
    </div>{{-- /ks-card --}}
</div>{{-- /ks-frame --}}

<script>
/* ── Segmented Control ── */
let currentTab = 'penghuni';

function switchTab(tab) {
    if (tab === currentTab) return;
    currentTab = tab;

    const pill       = document.getElementById('segPill');
    const btnPenghuni = document.getElementById('tabPenghuni');
    const btnPemilik  = document.getElementById('tabPemilik');
    const panelP     = document.getElementById('panelPenghuni');
    const panelM     = document.getElementById('panelPemilik');

    // Update ARIA
    btnPenghuni.setAttribute('aria-selected', tab === 'penghuni');
    btnPemilik.setAttribute('aria-selected', tab === 'pemilik');
    btnPenghuni.classList.toggle('ks-active', tab === 'penghuni');
    btnPemilik.classList.toggle('ks-active', tab === 'pemilik');

    if (tab === 'pemilik') {
        pill.classList.add('to-right');
        panelP.className = 'ks-form-panel ks-left';
        panelM.className = 'ks-form-panel ks-visible';
    } else {
        pill.classList.remove('to-right');
        panelP.className = 'ks-form-panel ks-visible';
        panelM.className = 'ks-form-panel ks-right';
    }
}

/* ── Restore tab if validation error ── */
@if(old('role') === 'pemilik')
document.addEventListener('DOMContentLoaded', () => switchTab('pemilik'));
@endif

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

/* ── Password strength ── */
function checkStrength(val) {
    const segs   = ['ss1','ss2','ss3','ss4'].map(id => document.getElementById(id));
    const colors = ['#ef4444','#f97316','#eab308','#22c55e'];
    let score = 0;
    if (val.length >= 8)         score++;
    if (/[A-Z]/.test(val))       score++;
    if (/[0-9]/.test(val))       score++;
    if (/[^A-Za-z0-9]/.test(val)) score++;
    segs.forEach((s, i) => { s.style.background = i < score ? colors[score-1] : '#e2e8f0'; });
}

/* ── Ripple + spinner on submit ── */
function handleSubmit(btn, e) {
    // Ripple
    const rect = btn.getBoundingClientRect();
    const size = Math.max(rect.width, rect.height) * 1.5;
    const x = e.clientX - rect.left - size / 2;
    const y = e.clientY - rect.top  - size / 2;
    const r = document.createElement('span');
    r.className = 'ks-ripple';
    r.style.cssText = `width:${size}px;height:${size}px;left:${x}px;top:${y}px;`;
    btn.appendChild(r);
    setTimeout(() => r.remove(), 700);

    // Spinner
    const textSpan = btn.querySelector('.ks-btn-text');
    textSpan.innerHTML = '<span class="ks-spinner"></span>';
    btn.disabled = true;
}
</script>
@endsection
