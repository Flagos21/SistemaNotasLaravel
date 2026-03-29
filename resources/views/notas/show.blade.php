@extends('layouts.app')

@section('content')
@php
    $configs = [
        'amarillo' => ['fondo' => '#FFF9C4', 'borde' => '#F9A825', 'label' => '🟡 Amarillo', 'texto' => '#7a6000'],
        'azul'     => ['fondo' => '#E3F2FD', 'borde' => '#1565C0', 'label' => '🔵 Azul',     'texto' => '#0d3b75'],
        'verde'    => ['fondo' => '#E8F5E9', 'borde' => '#2E7D32', 'label' => '🟢 Verde',     'texto' => '#1a4d1d'],
        'rosado'   => ['fondo' => '#FCE4EC', 'borde' => '#C2185B', 'label' => '🌸 Rosado',   'texto' => '#7a0d38'],
    ];
    $cfg = $configs[$nota->color] ?? ['fondo' => '#f5f5f5', 'borde' => '#999', 'label' => $nota->color, 'texto' => '#555'];
@endphp

<div style="max-width:700px; margin:0 auto">

    <div style="background:{{ $cfg['fondo'] }}; border-radius:18px; padding:36px;
                border-left:5px solid {{ $cfg['borde'] }};
                box-shadow:0 4px 20px rgba(0,0,0,0.09); position:relative">

        {{-- Badge color --}}
        <span style="position:absolute; top:20px; right:20px;
                     background:{{ $cfg['borde'] }}; color:white;
                     padding:4px 12px; border-radius:20px; font-size:12px; font-weight:600">
            {{ $cfg['label'] }}
        </span>

        {{-- Título --}}
        <h1 style="font-size:28px; color:#1a1a2e; font-weight:700; margin:0 0 10px 0;
                   padding-right:120px; line-height:1.3">
            {{ $nota->titulo }}
        </h1>

        {{-- Fecha --}}
        <p style="font-size:13px; color:#999; margin:0 0 28px 0">
            Creada el {{ $nota->created_at->format('d \d\e F \d\e Y \a \l\a\s H:i') }}
        </p>

        {{-- Separador --}}
        <hr style="border:none; border-top:1px solid rgba(0,0,0,0.08); margin-bottom:24px">

        {{-- Contenido --}}
        <div style="font-size:16px; color:#333; line-height:1.8; white-space:pre-wrap">{{ $nota->contenido }}</div>
    </div>

    {{-- Acciones --}}
    <div style="display:flex; gap:10px; margin-top:24px; flex-wrap:wrap">
        <a href="{{ route('notas.index') }}"
           style="padding:10px 20px; background:#f1f3f4; color:#555; border-radius:10px;
           text-decoration:none; font-size:14px; font-weight:500; transition:background 0.2s"
           onmouseover="this.style.background='#e4e6e8'"
           onmouseout="this.style.background='#f1f3f4'">
            ← Volver al listado
        </a>
        @auth
        <a href="{{ route('notas.edit', $nota) }}"
           style="padding:10px 20px; background:#6c63ff; color:white; border-radius:10px;
           text-decoration:none; font-size:14px; font-weight:600; transition:background 0.2s"
           onmouseover="this.style.background='#5a52d5'"
           onmouseout="this.style.background='#6c63ff'">
            ✏️ Editar
        </a>

        <form method="POST" action="{{ route('notas.destroy', $nota) }}" style="margin:0"
              id="form-eliminar-show">
            @csrf
            @method('DELETE')
            <button type="button"
                onclick="confirmarEliminar(document.getElementById('form-eliminar-show'))"
                style="padding:10px 20px; background:#ef4444; color:white; border:none;
                border-radius:10px; cursor:pointer; font-size:14px; font-weight:600;
                font-family:inherit; transition:background 0.2s"
                onmouseover="this.style.background='#dc2626'"
                onmouseout="this.style.background='#ef4444'">
                🗑️ Eliminar
            </button>
        </form>
        @endauth
    </div>

</div>
@endsection
