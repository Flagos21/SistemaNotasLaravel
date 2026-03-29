@extends('layouts.app')

@section('content')
<div style="min-height:90vh; display:flex; align-items:center; justify-content:center; padding:20px">
    <div style="width:100%; max-width:420px">

        {{-- Logo y título --}}
        <div style="text-align:center; margin-bottom:32px">
            <div style="width:64px; height:64px; background:linear-gradient(135deg, #6c63ff, #a855f7);
                        border-radius:16px; display:flex; align-items:center; justify-content:center;
                        font-size:28px; margin:0 auto 16px auto; box-shadow:0 8px 24px rgba(108,99,255,0.3)">
                📝
            </div>
            <h1 style="margin:0 0 4px 0; font-size:26px; font-weight:700; color:#1a1a2e">Bienvenido de vuelta</h1>
            <p style="margin:0; color:#888; font-size:14px">Inicia sesión para ver tus notas</p>
        </div>

        {{-- Card del formulario --}}
        <div style="background:white; border-radius:20px; padding:32px;
                    box-shadow:0 8px 32px rgba(0,0,0,0.08); border:1px solid #f0f0f0">

            @if($errors->any())
                <div style="background:#fff0f0; border:1px solid #fecaca; color:#dc2626;
                            padding:12px 16px; border-radius:10px; margin-bottom:20px;
                            font-size:14px; display:flex; align-items:center; gap:8px">
                    ⚠️ {{ $errors->first() }}
                </div>
            @endif

            @if(session('success'))
                <div style="background:#f0fdf4; border:1px solid #bbf7d0; color:#16a34a;
                            padding:12px 16px; border-radius:10px; margin-bottom:20px; font-size:14px">
                    ✅ {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="/login">
                @csrf

                <div style="margin-bottom:20px">
                    <label style="display:block; font-size:13px; font-weight:600;
                                  color:#374151; margin-bottom:8px">
                        Correo electrónico
                    </label>
                    <div style="position:relative">
                        <span style="position:absolute; left:14px; top:50%;
                                     transform:translateY(-50%); font-size:16px; color:#9ca3af">
                            ✉️
                        </span>
                        <input type="email" name="email" value="{{ old('email') }}"
                            placeholder="tu@correo.com"
                            style="width:100%; padding:12px 14px 12px 42px; border:1.5px solid #e5e7eb;
                            border-radius:12px; font-size:14px; outline:none; box-sizing:border-box;
                            transition:border-color 0.2s, box-shadow 0.2s; background:#fafafa;
                            font-family:inherit"
                            onfocus="this.style.borderColor='#6c63ff';this.style.boxShadow='0 0 0 3px rgba(108,99,255,0.1)';this.style.background='white'"
                            onblur="this.style.borderColor='#e5e7eb';this.style.boxShadow='none';this.style.background='#fafafa'">
                    </div>
                </div>

                <div style="margin-bottom:24px">
                    <label style="display:block; font-size:13px; font-weight:600;
                                  color:#374151; margin-bottom:8px">
                        Contraseña
                    </label>
                    <div style="position:relative">
                        <span style="position:absolute; left:14px; top:50%;
                                     transform:translateY(-50%); font-size:16px; color:#9ca3af">
                            🔒
                        </span>
                        <input type="password" name="password" id="password"
                            placeholder="••••••••"
                            style="width:100%; padding:12px 42px 12px 42px; border:1.5px solid #e5e7eb;
                            border-radius:12px; font-size:14px; outline:none; box-sizing:border-box;
                            transition:border-color 0.2s, box-shadow 0.2s; background:#fafafa;
                            font-family:inherit"
                            onfocus="this.style.borderColor='#6c63ff';this.style.boxShadow='0 0 0 3px rgba(108,99,255,0.1)';this.style.background='white'"
                            onblur="this.style.borderColor='#e5e7eb';this.style.boxShadow='none';this.style.background='#fafafa'">
                        <button type="button" onclick="togglePassword()"
                            style="position:absolute; right:14px; top:50%; transform:translateY(-50%);
                                   background:none; border:none; cursor:pointer; font-size:16px;
                                   color:#9ca3af; padding:0; line-height:1"
                            id="toggleBtn">
                            👁
                        </button>
                    </div>
                </div>

                <button type="submit"
                    style="width:100%; padding:13px; background:linear-gradient(135deg, #6c63ff, #a855f7);
                    color:white; border:none; border-radius:12px; font-size:15px; font-weight:600;
                    cursor:pointer; transition:transform 0.2s, box-shadow 0.2s; font-family:inherit;
                    box-shadow:0 4px 15px rgba(108,99,255,0.35)"
                    onmouseover="this.style.transform='translateY(-1px)';this.style.boxShadow='0 6px 20px rgba(108,99,255,0.45)'"
                    onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 15px rgba(108,99,255,0.35)'">
                    Iniciar Sesión
                </button>
            </form>

            <div style="text-align:center; margin-top:24px; padding-top:24px;
                        border-top:1px solid #f0f0f0">
                <p style="margin:0; color:#888; font-size:14px">
                    ¿No tienes cuenta?
                    <a href="/registro" style="color:#6c63ff; font-weight:600; text-decoration:none">
                        Regístrate gratis
                    </a>
                </p>
            </div>
        </div>

        <p style="text-align:center; margin-top:24px; color:#aaa; font-size:12px">
            📝 Mis Notas — Tu espacio personal
        </p>
    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById('password');
    const btn   = document.getElementById('toggleBtn');
    if (input.type === 'password') {
        input.type      = 'text';
        btn.textContent = '🙈';
    } else {
        input.type      = 'password';
        btn.textContent = '👁';
    }
}
</script>
@endsection
