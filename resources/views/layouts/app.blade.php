<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mis Notas</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; }

        body {
            font-family: 'Inter', system-ui, -apple-system, sans-serif;
            background: #f0f2f5;
            color: #333;
            min-height: 100vh;
        }

        /* ── NAVBAR ── */
        nav {
            background: #1a1a2e;
            padding: 0 32px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: space-between;
            position: sticky;
            top: 0;
            z-index: 100;
            box-shadow: 0 2px 12px rgba(0,0,0,0.2);
        }
        .nav-brand {
            font-size: 1.2rem;
            font-weight: 700;
            color: #fff;
            text-decoration: none;
            letter-spacing: -0.3px;
        }
        .nav-right {
            display: flex;
            align-items: center;
            gap: 14px;
        }
        .nav-avatar {
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #6c63ff;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: 700;
            font-size: 14px;
            flex-shrink: 0;
        }
        .nav-username {
            color: #e0e0ff;
            font-size: 0.9rem;
            font-weight: 500;
        }
        .nav-btn-new {
            padding: 7px 16px;
            background: #6c63ff;
            color: white;
            border-radius: 8px;
            text-decoration: none;
            font-size: 0.85rem;
            font-weight: 600;
            transition: background 0.2s;
        }
        .nav-btn-new:hover { background: #5a52d5; }
        .nav-btn-logout {
            padding: 7px 14px;
            background: rgba(255,255,255,0.1);
            color: #ccc;
            border: 1px solid rgba(255,255,255,0.15);
            border-radius: 8px;
            cursor: pointer;
            font-size: 0.85rem;
            font-weight: 500;
            transition: background 0.2s;
            font-family: inherit;
        }
        .nav-btn-logout:hover { background: rgba(255,255,255,0.18); color: #fff; }
        .nav-guest-link {
            color: #aaa;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s;
        }
        .nav-guest-link:hover { color: #fff; }

        /* ── CONTENEDOR ── */
        .container {
            max-width: 1200px;
            margin: 28px auto;
            padding: 0 20px;
        }

        /* ── ALERTAS ── */
        .alerta-auto {
            padding: 13px 18px;
            border-radius: 10px;
            margin-bottom: 20px;
            font-size: 0.92rem;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 8px;
        }
        .alerta-success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #6ee7b7;
        }
        .alerta-error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
        }

        /* ── BOTONES GLOBALES ── */
        .btn {
            display: inline-block;
            padding: 9px 18px;
            border-radius: 9px;
            border: none;
            cursor: pointer;
            font-size: 0.9rem;
            font-weight: 500;
            text-decoration: none;
            transition: opacity 0.2s, transform 0.15s;
            font-family: inherit;
        }
        .btn:hover { opacity: 0.88; transform: translateY(-1px); }
        .btn-primary  { background: #6c63ff; color: #fff; }
        .btn-secondary{ background: #6b7280; color: #fff; }
        .btn-danger   { background: #ef4444; color: #fff; }
        .btn-success  { background: #22c55e; color: #fff; }

        /* ── FORMULARIOS ── */
        .form-card {
            max-width: 600px;
            margin: 0 auto;
            background: #fff;
            padding: 36px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.08);
        }
        .form-card h2 {
            margin-bottom: 28px;
            font-size: 1.4rem;
            color: #1a1a2e;
        }
        .form-group { margin-bottom: 18px; }
        .form-label {
            display: block;
            margin-bottom: 7px;
            font-weight: 500;
            color: #444;
            font-size: 0.9rem;
        }
        .form-input, .form-textarea, .form-select {
            width: 100%;
            padding: 10px 14px;
            border: 1.5px solid #e0e0e0;
            border-radius: 10px;
            font-size: 0.95rem;
            background: #f8f9fa;
            color: #333;
            font-family: inherit;
            transition: border-color 0.2s, box-shadow 0.2s;
            outline: none;
        }
        .form-input:focus, .form-textarea:focus, .form-select:focus {
            border-color: #6c63ff;
            box-shadow: 0 0 0 3px rgba(108,99,255,0.12);
            background: #fff;
        }
        .form-textarea { resize: vertical; min-height: 140px; }
        .form-select { cursor: pointer; }
        .form-actions { display: flex; gap: 10px; margin-top: 24px; }
        .btn-guardar {
            padding: 11px 28px;
            background: #6c63ff;
            color: white;
            border: none;
            border-radius: 10px;
            cursor: pointer;
            font-size: 0.95rem;
            font-weight: 600;
            font-family: inherit;
            transition: background 0.2s, transform 0.15s;
        }
        .btn-guardar:hover { background: #5a52d5; transform: translateY(-1px); }
        .btn-cancelar {
            padding: 11px 22px;
            background: #f1f3f4;
            color: #555;
            border-radius: 10px;
            text-decoration: none;
            font-size: 0.95rem;
            font-weight: 500;
            transition: background 0.2s;
            display: inline-flex;
            align-items: center;
        }
        .btn-cancelar:hover { background: #e4e6e8; }

        /* ── ERRORES DE VALIDACIÓN ── */
        .validation-errors {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #fca5a5;
            border-radius: 10px;
            padding: 12px 16px;
            margin-bottom: 20px;
            font-size: 0.88rem;
        }
        .validation-errors p { margin: 3px 0; }

        /* ── MODAL ANIMACIÓN ── */
        @keyframes slideUp {
            from { transform: translateY(20px); opacity: 0; }
            to   { transform: translateY(0);    opacity: 1; }
        }

        /* ── RESPONSIVE ── */
        @media (max-width: 768px) {
            nav { padding: 0 16px; }
            .nav-username { display: none; }
            .container { margin: 16px auto; padding: 0 12px; }
            .grid-4-col { grid-template-columns: 1fr !important; }
            .grid-3-col { grid-template-columns: 1fr !important; }
            .filtros-bar { flex-direction: column !important; align-items: stretch !important; }
            .form-card { padding: 22px 16px; }
        }
    </style>
</head>
<body>

<nav>
    <a class="nav-brand" href="{{ route('notas.index') }}">📝 Mis Notas</a>
    <div class="nav-right">
        @auth
            <div class="nav-avatar">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>
            <span class="nav-username">{{ auth()->user()->name }}</span>
            <a href="{{ route('notas.create') }}" class="nav-btn-new">+ Nueva Nota</a>
            <form method="POST" action="{{ route('logout') }}" style="display:inline;margin:0">
                @csrf
                <button type="submit" class="nav-btn-logout">Cerrar sesión</button>
            </form>
        @endauth
        @guest
            <a href="{{ route('login') }}" class="nav-guest-link">Iniciar sesión</a>
            <a href="/registro" class="nav-btn-new">Registrarse</a>
        @endguest
    </div>
</nav>

<div class="container">
    @if(session('success'))
        <div class="alerta-auto alerta-success">✅ {{ session('success') }}</div>
    @endif
    @if(session('error'))
        <div class="alerta-auto alerta-error">❌ {{ session('error') }}</div>
    @endif

    @yield('content')
</div>

{{-- ── MODAL DE CONFIRMACIÓN PERSONALIZADO ── --}}
<div id="modalEliminar" style="display:none; position:fixed; inset:0; z-index:9999;
    align-items:center; justify-content:center; background:rgba(0,0,0,0.5);
    backdrop-filter:blur(4px)">
    <div style="background:white; border-radius:20px; padding:32px; max-width:380px; width:90%;
                box-shadow:0 24px 60px rgba(0,0,0,0.2); text-align:center;
                animation:slideUp 0.2s ease">
        <div style="width:64px; height:64px; background:#fff0f0; border-radius:50%;
                    display:flex; align-items:center; justify-content:center;
                    font-size:28px; margin:0 auto 16px auto">
            🗑️
        </div>
        <h3 style="margin:0 0 8px 0; font-size:20px; color:#1a1a2e; font-weight:700">
            ¿Eliminar nota?
        </h3>
        <p style="margin:0 0 24px 0; color:#888; font-size:14px; line-height:1.5">
            Esta acción no se puede deshacer. La nota será eliminada permanentemente.
        </p>
        <div style="display:flex; gap:12px; justify-content:center">
            <button onclick="cerrarModal()"
                style="flex:1; padding:12px; background:#f5f5f5; color:#555; border:none;
                border-radius:12px; font-size:14px; font-weight:600; cursor:pointer;
                transition:background 0.2s; font-family:inherit"
                onmouseover="this.style.background='#e5e5e5'"
                onmouseout="this.style.background='#f5f5f5'">
                Cancelar
            </button>
            <button id="btnConfirmarEliminar"
                style="flex:1; padding:12px; background:linear-gradient(135deg, #ef4444, #dc2626);
                color:white; border:none; border-radius:12px; font-size:14px; font-weight:600;
                cursor:pointer; box-shadow:0 4px 12px rgba(239,68,68,0.3); transition:all 0.2s;
                font-family:inherit"
                onmouseover="this.style.transform='translateY(-1px)'"
                onmouseout="this.style.transform='translateY(0)'">
                Sí, eliminar
            </button>
        </div>
    </div>
</div>

<script>
    // ── Alertas que desaparecen solas ──
    setTimeout(function() {
        document.querySelectorAll('.alerta-auto').forEach(function(alerta) {
            alerta.style.transition = 'opacity 0.5s';
            alerta.style.opacity = '0';
            setTimeout(() => alerta.remove(), 500);
        });
    }, 3000);

    // ── Modal de confirmación ──
    let formularioEliminar = null;

    function confirmarEliminar(formulario) {
        formularioEliminar = formulario;
        const modal = document.getElementById('modalEliminar');
        modal.style.display = 'flex';
    }

    function cerrarModal() {
        document.getElementById('modalEliminar').style.display = 'none';
        formularioEliminar = null;
    }

    document.getElementById('btnConfirmarEliminar').addEventListener('click', function() {
        if (formularioEliminar) {
            formularioEliminar.submit();
        }
    });

    document.getElementById('modalEliminar').addEventListener('click', function(e) {
        if (e.target === this) cerrarModal();
    });

    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') cerrarModal();
    });
</script>
</body>
</html>
