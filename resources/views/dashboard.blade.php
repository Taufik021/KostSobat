@extends('layouts.auth')
@section('title', 'Dashboard')

@section('content')
<style>
    .ks-frame {
        min-height: 100dvh;
        max-height: 900px;
        background: linear-gradient(160deg, #1e3a8a 0%, #2563eb 45%, #93c5fd 100%);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        gap: 1.5rem;
        padding: 2rem;
    }
    @keyframes pop-in {
        0%   { transform: scale(0.5); opacity: 0; }
        70%  { transform: scale(1.1); }
        100% { transform: scale(1);   opacity: 1; }
    }
    .pop-in { animation: pop-in 0.55s cubic-bezier(0.34,1.56,0.64,1) forwards; }
</style>

<div class="ks-frame">
    <div class="pop-in" style="text-align:center;">

        {{-- Success icon --}}
        <div style="width:100px;height:100px;background:rgba(255,255,255,0.15);border-radius:50%;display:flex;align-items:center;justify-content:center;margin:0 auto 1.25rem;border:2px solid rgba(255,255,255,0.3);">
            <svg width="52" height="52" viewBox="0 0 24 24" fill="none">
                <polyline points="20,6 9,17 4,12" stroke="#fff" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
            </svg>
        </div>

        <h2 style="color:#fff;font-size:1.75rem;font-weight:800;margin:0 0 0.5rem;">Selamat Datang! 🎉</h2>
        <p style="color:#bfdbfe;font-size:0.95rem;margin:0 0 0.5rem;">Halo, <strong style="color:#fff;">{{ auth()->user()->name }}</strong>!</p>

        {{-- Role badge --}}
        <div style="display:inline-flex;align-items:center;gap:0.4rem;background:rgba(255,255,255,0.15);border-radius:999px;padding:0.4rem 1rem;border:1px solid rgba(255,255,255,0.3);margin-bottom:0.75rem;">
            @if(auth()->user()->role === 'pemilik')
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#93c5fd" stroke-width="2.5" stroke-linecap="round"><path d="M3 9l9-7 9 7v11a2 2 0 01-2 2H5a2 2 0 01-2-2z"/></svg>
            <span style="color:#e0f2fe;font-size:0.8rem;font-weight:600;">Pemilik Kos</span>
            @else
            <svg width="14" height="14" viewBox="0 0 24 24" fill="none" stroke="#93c5fd" stroke-width="2.5" stroke-linecap="round"><circle cx="12" cy="8" r="4"/><path d="M4 20c0-4 3.6-7 8-7s8 3 8 7"/></svg>
            <span style="color:#e0f2fe;font-size:0.8rem;font-weight:600;">Penghuni</span>
            @endif
        </div>

        <p style="color:#bfdbfe;font-size:0.82rem;margin:0;">{{ auth()->user()->email }}</p>

        @if(session('success'))
        <div style="background:rgba(255,255,255,0.15);border-radius:12px;padding:0.6rem 1rem;margin-top:1rem;border:1px solid rgba(255,255,255,0.25);">
            <p style="color:#e0f2fe;font-size:0.82rem;margin:0;">{{ session('success') }}</p>
        </div>
        @endif
    </div>

    {{-- Action buttons --}}
    <div style="display:flex;gap:0.75rem;">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" style="background:rgba(255,255,255,0.15);border:1.5px solid rgba(255,255,255,0.3);border-radius:14px;color:#fff;padding:0.75rem 1.25rem;font-size:0.875rem;font-weight:600;cursor:pointer;font-family:inherit;transition:transform 0.15s;" onmousedown="this.style.transform='scale(0.95)'" onmouseup="this.style.transform='scale(1)'">
                Keluar
            </button>
        </form>
        <a href="{{ route('register') }}" style="background:rgba(255,255,255,0.9);border:none;border-radius:14px;color:#1d4ed8;padding:0.75rem 1.25rem;font-size:0.875rem;font-weight:700;cursor:pointer;text-decoration:none;display:inline-flex;align-items:center;transition:transform 0.15s;">
            Daftar Akun Baru
        </a>
    </div>
</div>
@endsection
