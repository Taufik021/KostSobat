<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no"/>
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>KostSobat – @yield('title', 'Auth')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        /* ── Custom properties & reset ── */
        *, *::before, *::after { box-sizing: border-box; }

        body {
            margin: 0;
            min-height: 100dvh;
            background: linear-gradient(160deg, #0f172a 0%, #1e3a8a 50%, #1d4ed8 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
            font-family: 'Instrument Sans', -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, sans-serif;
            -webkit-font-smoothing: antialiased;
        }

        /* ── Phone-like frame ── */
        .ks-frame {
            width: 100%;
            max-width: 420px;
            min-height: 100dvh;
            max-height: 900px;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            position: relative;
        }

        @media (min-width: 480px) {
            .ks-frame {
                min-height: auto;
                border-radius: 40px;
                box-shadow:
                    0 0 0 2px #1e293b,
                    0 0 0 8px #0f172a,
                    0 50px 100px rgba(0,0,0,0.6);
                overflow: hidden;
            }
        }

        /* ── Header Arc ── */
        .ks-header {
            background: linear-gradient(145deg, #1e3a8a 0%, #1d4ed8 50%, #3b82f6 100%);
            position: relative;
            padding: 2.5rem 1.75rem 3.5rem;
            overflow: visible;
            flex-shrink: 0;
        }
        .ks-header::after {
            content: '';
            position: absolute;
            bottom: -28px;
            left: -5%;
            right: -5%;
            height: 56px;
            background: linear-gradient(145deg, #1e3a8a 0%, #3b82f6 100%);
            border-radius: 0 0 60% 60%;
            z-index: 1;
        }
        .ks-header-deco-1 {
            position: absolute; top: -40px; right: -40px;
            width: 160px; height: 160px;
            background: rgba(255,255,255,0.07);
            border-radius: 50%;
        }
        .ks-header-deco-2 {
            position: absolute; bottom: 10px; left: -20px;
            width: 100px; height: 100px;
            background: rgba(255,255,255,0.05);
            border-radius: 50%;
        }

        /* ── Floating illustration ── */
        .ks-illus {
            position: absolute;
            right: 1.5rem;
            top: 1rem;
            animation: ks-float 4s ease-in-out infinite;
        }
        @keyframes ks-float {
            0%, 100% { transform: translateY(0) rotate(-2deg); }
            50%       { transform: translateY(-10px) rotate(2deg); }
        }

        /* ── Bottom card (bottom-sheet style) ── */
        .ks-card {
            background: #fff;
            border-radius: 32px 32px 0 0;
            flex: 1;
            overflow-y: auto;
            overflow-x: hidden;
            padding: 1.75rem 1.5rem 2rem;
            position: relative;
            z-index: 2;
            margin-top: -2px;
            scrollbar-width: none;
        }
        .ks-card::-webkit-scrollbar { display: none; }

        @media (min-width: 480px) {
            .ks-card {
                border-radius: 32px 32px 32px 32px;
            }
        }

        /* ── Logo & brand ── */
        .ks-brand {
            display: flex; align-items: center; gap: 0.5rem;
            margin-bottom: 0.4rem;
        }
        .ks-brand-name {
            color: #93c5fd;
            font-size: 0.75rem;
            font-weight: 700;
            letter-spacing: 0.1em;
        }
        .ks-title {
            color: #fff;
            font-size: 1.6rem;
            font-weight: 800;
            line-height: 1.2;
            margin: 0 0 0.3rem;
        }
        .ks-subtitle {
            color: #bfdbfe;
            font-size: 0.85rem;
            margin: 0;
        }

        /* ── Segmented control ── */
        .ks-seg {
            display: flex;
            background: #eff6ff;
            border: 1.5px solid #bfdbfe;
            border-radius: 14px;
            padding: 4px;
            position: relative;
            margin-bottom: 1.25rem;
        }
        .ks-seg-pill {
            position: absolute;
            top: 4px;
            left: 4px;
            height: calc(100% - 8px);
            width: calc(50% - 4px);
            background: linear-gradient(135deg, #1d4ed8, #3b82f6);
            border-radius: 11px;
            transition: transform 0.35s cubic-bezier(0.4,0,0.2,1);
            box-shadow: 0 4px 14px rgba(37,99,235,0.35);
            pointer-events: none;
        }
        .ks-seg-pill.to-right { transform: translateX(calc(100% + 4px)); }
        .ks-seg-btn {
            flex: 1;
            height: 42px;
            border: none;
            background: none;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 600;
            color: #64748b;
            position: relative;
            z-index: 1;
            transition: color 0.3s;
            border-radius: 11px;
            padding: 0;
        }
        .ks-seg-btn.ks-active { color: #fff; }

        /* ── Form panels ── */
        .ks-forms-wrap {
            position: relative;
            overflow: hidden;
        }
        .ks-form-panel {
            width: 100%;
            transition: transform 0.4s cubic-bezier(0.4,0,0.2,1), opacity 0.35s ease;
        }
        .ks-form-panel.ks-visible {
            transform: translateX(0);
            opacity: 1;
            position: relative;
        }
        .ks-form-panel.ks-left {
            transform: translateX(-100%);
            opacity: 0;
            position: absolute;
            top: 0; left: 0;
            pointer-events: none;
        }
        .ks-form-panel.ks-right {
            transform: translateX(100%);
            opacity: 0;
            position: absolute;
            top: 0; left: 0;
            pointer-events: none;
        }

        /* ── Input field ── */
        .ks-field { margin-bottom: 0.9rem; }
        .ks-label {
            display: block;
            font-size: 0.72rem;
            font-weight: 700;
            color: #1e3a8a;
            margin-bottom: 0.4rem;
            letter-spacing: 0.04em;
        }
        .ks-input-wrap { position: relative; }
        .ks-input {
            width: 100%;
            height: 52px;
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            padding: 0 3rem 0 2.9rem;
            font-size: 0.875rem;
            color: #1e293b;
            outline: none;
            transition: border-color 0.25s, box-shadow 0.25s, transform 0.15s;
            background: #f8faff;
            -webkit-appearance: none;
            font-family: inherit;
        }
        .ks-input:focus {
            border-color: #2563eb;
            box-shadow: 0 0 0 4px rgba(37, 99, 235, 0.15);
            background: #fff;
            transform: translateY(-1px);
        }
        .ks-input::placeholder { color: #94a3b8; font-size: 0.82rem; }
        .ks-input.is-invalid {
            border-color: #ef4444;
            box-shadow: 0 0 0 3px rgba(239,68,68,0.12);
        }
        textarea.ks-input {
            height: auto;
            padding-top: 0.9rem;
            padding-bottom: 0.9rem;
            resize: none;
            line-height: 1.5;
        }
        .ks-icon {
            position: absolute;
            left: 0.9rem;
            top: 50%;
            transform: translateY(-50%);
            color: #93c5fd;
            pointer-events: none;
            transition: color 0.25s;
            display: flex;
        }
        .ks-input-wrap:focus-within .ks-icon { color: #2563eb; }
        .ks-eye {
            position: absolute;
            right: 0.9rem;
            top: 50%;
            transform: translateY(-50%);
            color: #94a3b8;
            cursor: pointer;
            background: none;
            border: none;
            padding: 4px;
            display: flex;
            transition: color 0.2s;
        }
        .ks-eye:hover { color: #2563eb; }
        .ks-error-msg {
            font-size: 0.72rem;
            color: #ef4444;
            margin-top: 4px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        /* ── Password strength ── */
        .ks-strength {
            display: flex; gap: 4px; margin-top: 6px;
        }
        .ks-strength-seg {
            flex: 1; height: 3px;
            background: #e2e8f0;
            border-radius: 999px;
            transition: background 0.3s;
        }

        /* ── Primary button ── */
        .ks-btn {
            width: 100%;
            height: 56px;
            background: linear-gradient(135deg, #1d4ed8 0%, #2563eb 50%, #3b82f6 100%);
            border: none;
            border-radius: 16px;
            color: #fff;
            font-size: 1rem;
            font-weight: 700;
            cursor: pointer;
            position: relative;
            overflow: hidden;
            transition: transform 0.15s cubic-bezier(0.34,1.56,0.64,1), box-shadow 0.2s;
            box-shadow: 0 8px 24px rgba(37,99,235,0.4);
            letter-spacing: 0.02em;
            font-family: inherit;
            margin-top: 0.5rem;
        }
        .ks-btn::before {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(135deg, transparent 30%, rgba(255,255,255,0.15) 50%, transparent 70%);
            transform: translateX(-100%) skewX(-20deg);
            transition: transform 0.5s;
        }
        .ks-btn:hover::before { transform: translateX(200%) skewX(-20deg); }
        .ks-btn:active, .ks-btn.pressed { transform: scale(0.96); box-shadow: 0 4px 12px rgba(37,99,235,0.3); }
        .ks-btn:disabled { opacity: 0.75; cursor: not-allowed; transform: none; }

        /* Ripple */
        @keyframes ks-ripple { to { transform: scale(4); opacity: 0; } }
        .ks-ripple {
            position: absolute;
            border-radius: 50%;
            background: rgba(255,255,255,0.4);
            pointer-events: none;
            animation: ks-ripple 0.6s ease-out forwards;
        }

        /* Spinner */
        @keyframes ks-spin { to { transform: rotate(360deg); } }
        .ks-spinner {
            width: 20px; height: 20px;
            border: 2.5px solid rgba(255,255,255,0.35);
            border-top-color: #fff;
            border-radius: 50%;
            animation: ks-spin 0.75s linear infinite;
            display: inline-block;
            vertical-align: middle;
        }

        /* ── Google button ── */
        .ks-btn-google {
            width: 100%;
            height: 52px;
            background: #fff;
            border: 2px solid #e2e8f0;
            border-radius: 14px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 0.6rem;
            font-size: 0.875rem;
            font-weight: 600;
            color: #1e293b;
            cursor: pointer;
            transition: transform 0.15s, border-color 0.2s, box-shadow 0.2s;
            font-family: inherit;
        }
        .ks-btn-google:hover { border-color: #93c5fd; box-shadow: 0 4px 14px rgba(37,99,235,0.1); }
        .ks-btn-google:active { transform: scale(0.97); }

        /* ── Divider ── */
        .ks-divider {
            display: flex; align-items: center; gap: 0.6rem;
            margin: 1rem 0; color: #94a3b8; font-size: 0.75rem;
        }
        .ks-divider::before, .ks-divider::after {
            content: ''; flex: 1; height: 1px; background: #e2e8f0;
        }

        /* ── Checkbox custom ── */
        .ks-check-wrap { display: flex; align-items: center; gap: 0.5rem; cursor: pointer; }
        .ks-check-box {
            width: 20px; height: 20px;
            border: 2px solid #cbd5e1;
            border-radius: 5px;
            background: #fff;
            transition: all 0.2s;
            display: flex; align-items: center; justify-content: center;
            flex-shrink: 0;
        }
        input[type=checkbox]:checked ~ .ks-check-box,
        .ks-check-box.checked {
            background: #2563eb;
            border-color: #2563eb;
        }

        /* ── Link ── */
        .ks-link {
            color: #2563eb; font-weight: 700;
            text-decoration: none;
            transition: color 0.2s;
        }
        .ks-link:hover { color: #1d4ed8; text-decoration: underline; }

        /* ── Alert (error) ── */
        .ks-alert {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #b91c1c;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 0.8rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
        }

        /* ── Success toast ── */
        .ks-success {
            background: #f0fdf4;
            border: 1px solid #bbf7d0;
            color: #15803d;
            border-radius: 12px;
            padding: 0.75rem 1rem;
            font-size: 0.8rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        /* ── Footer ── */
        .ks-footer {
            text-align: center;
            padding-top: 1.25rem;
            margin-top: 1rem;
            border-top: 1px solid #f1f5f9;
            font-size: 0.82rem;
            color: #64748b;
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>
