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
            <h1 style="margin:0 0 4px 0; font-size:26px; font-weight:700; color:#1a1a2e">Crea tu cuenta</h1>
            <p style="margin:0; color:#888; font-size:14px">Empieza a organizar tus notas hoy</p>
        </div>

        <div style="background:white; border-radius:20px; padding:32px;
                    box-shadow:0 8px 32px rgba(0,0,0,0.08); border:1px solid #f0f0f0">

            @if($errors->any())
                <div style="background:#fff0f0; border:1px solid #fecaca; color:#dc2626;
                            padding:12px 16px; border-radius:10px; margin-bottom:20px; font-size:14px">
                    @foreach($errors->all() as $error)
                        <p style="margin:2px 0">⚠️ {{ $error }}</p>
                    @endforeach
                </div>
            @endif

            <form method="POST" action="/registro">
                @csrf

                @php
                $campos = [
                    ['name' => 'name',                  'label' => 'Nombre completo',      'type' => 'text',     'placeholder' => 'Tu nombre',         'emoji' => '👤'],
                    ['name' => 'email',                 'label' => 'Correo electrónico',   'type' => 'email',    'placeholder' => 'tu@correo.com',     'emoji' => '✉️'],
                    ['name' => 'password',              'label' => 'Contraseña',           'type' => 'password', 'placeholder' => 'Mínimo 6 caracteres','emoji' => '🔒'],
                    ['name' => 'password_confirmation', 'label' => 'Confirmar contraseña', 'type' => 'password', 'placeholder' => 'Repite tu contraseña','emoji' => '🔐'],
                ];
                @endphp

                @foreach($campos as $campo)
                <div style="margin-bottom:18px">
                    <label style="display:block; font-size:13px; font-weight:600;
                                  color:#374151; margin-bottom:8px">
                        {{ $campo['label'] }}
                    </label>
                    <div style="position:relative">
                        <span style="position:absolute; left:14px; top:50%;
                                     transform:translateY(-50%); font-size:15px; color:#9ca3af">
                            {{ $campo['emoji'] }}
                        </span>
                        <input type="{{ $campo['type'] }}"
                            name="{{ $campo['name'] }}"
                            value="{{ $campo['type'] !== 'password' ? old($campo['name']) : '' }}"
                            placeholder="{{ $campo['placeholder'] }}"
                            style="width:100%; padding:12px 14px 12px 42px; border:1.5px solid #e5e7eb;
                            border-radius:12px; font-size:14px; outline:none; box-sizing:border-box;
                            transition:all 0.2s; background:#fafafa; font-family:inherit"
                            onfocus="this.style.borderColor='#6c63ff';this.style.boxShadow='0 0 0 3px rgba(108,99,255,0.1)';this.style.background='white'"
                            onblur="this.style.borderColor='#e5e7eb';this.style.boxShadow='none';this.style.background='#fafafa'">
                    </div>
                </div>
                @endforeach

                <button type="submit"
                    style="width:100%; padding:13px; background:linear-gradient(135deg, #6c63ff, #a855f7);
                    color:white; border:none; border-radius:12px; font-size:15px; font-weight:600;
                    cursor:pointer; transition:transform 0.2s, box-shadow 0.2s; margin-top:6px;
                    box-shadow:0 4px 15px rgba(108,99,255,0.35); font-family:inherit"
                    onmouseover="this.style.transform='translateY(-1px)';this.style.boxShadow='0 6px 20px rgba(108,99,255,0.45)'"
                    onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 4px 15px rgba(108,99,255,0.35)'">
                    Crear mi cuenta
                </button>
            </form>

            <div style="text-align:center; margin-top:24px; padding-top:24px; border-top:1px solid #f0f0f0">
                <p style="margin:0; color:#888; font-size:14px">
                    ¿Ya tienes cuenta?
                    <a href="/login" style="color:#6c63ff; font-weight:600; text-decoration:none">
                        Inicia sesión
                    </a>
                </p>
            </div>
        </div>

        <p style="text-align:center; margin-top:24px; color:#aaa; font-size:12px">
            📝 Mis Notas — Tu espacio personal
        </p>
    </div>
</div>
@endsection
