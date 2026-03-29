@extends('layouts.app')

@section('content')

{{-- BARRA DE FILTROS CON BÚSQUEDA EN TIEMPO REAL --}}
<div style="background:white; border-radius:16px; padding:20px 24px;
            margin-bottom:24px; box-shadow:0 2px 8px rgba(0,0,0,0.06)">

    {{-- Búsqueda en tiempo real --}}
    <div style="position:relative; margin-bottom:16px">
        <span style="position:absolute; left:16px; top:50%;
                     transform:translateY(-50%); font-size:18px; color:#9ca3af; pointer-events:none">
            🔍
        </span>
        <input type="text" id="inputBuscar"
            value="{{ request('buscar') }}"
            placeholder="Buscar notas por título..."
            style="width:100%; padding:13px 44px 13px 48px; border:1.5px solid #e5e7eb;
            border-radius:12px; font-size:15px; outline:none; box-sizing:border-box;
            transition:all 0.2s; background:#fafafa; font-family:inherit"
            onfocus="this.style.borderColor='#6c63ff';this.style.boxShadow='0 0 0 3px rgba(108,99,255,0.1)';this.style.background='white'"
            onblur="this.style.borderColor='#e5e7eb';this.style.boxShadow='none';this.style.background='#fafafa'">

        {{-- Botón X para limpiar --}}
        <button id="btnLimpiarBuscar" type="button"
            onclick="limpiarBusqueda()"
            style="position:absolute; right:14px; top:50%; transform:translateY(-50%);
                   background:none; border:none; cursor:pointer; font-size:18px; color:#9ca3af;
                   display:{{ request('buscar') ? 'block' : 'none' }};
                   transition:color 0.2s; line-height:1; padding:0"
            onmouseover="this.style.color='#ef4444'"
            onmouseout="this.style.color='#9ca3af'">
            ✕
        </button>
    </div>

    {{-- Filtros de color --}}
    <div style="display:flex; gap:8px; flex-wrap:wrap">
        @php
            $coloresFiltro = [
                'todas'    => ['emoji' => '📋', 'label' => 'Todas',    'bg' => '#6c63ff'],
                'amarillo' => ['emoji' => '🟡', 'label' => 'Amarillo', 'bg' => '#F9A825'],
                'azul'     => ['emoji' => '🔵', 'label' => 'Azul',     'bg' => '#1565C0'],
                'verde'    => ['emoji' => '🟢', 'label' => 'Verde',    'bg' => '#2E7D32'],
                'rosado'   => ['emoji' => '🌸', 'label' => 'Rosado',   'bg' => '#C2185B'],
            ];
        @endphp

        @foreach($coloresFiltro as $key => $color)
            <button type="button"
                onclick="filtrarColor('{{ $key }}')"
                data-color="{{ $key }}"
                class="btn-filtro-color"
                style="padding:8px 18px; border-radius:20px; font-size:13px; font-weight:600;
                       cursor:pointer; transition:all 0.2s; border:2px solid {{ $color['bg'] }};
                       background:{{ $colorFiltro === $key ? $color['bg'] : 'white' }};
                       color:{{ $colorFiltro === $key ? 'white' : $color['bg'] }};
                       font-family:inherit">
                {{ $color['emoji'] }} {{ $color['label'] }}
            </button>
        @endforeach
    </div>
</div>

{{-- CONTADOR + BOTÓN NUEVA NOTA --}}
<div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:20px">
    <h2 style="margin:0; font-size:22px; color:#1a1a2e; font-weight:700">
        Mis Notas
        <span style="font-size:14px; color:#888; font-weight:400">
            — Mostrando {{ $notas->count() }} de {{ $total }}
        </span>
    </h2>
    @auth
    <a href="{{ route('notas.create') }}"
        style="padding:10px 20px; background:#6c63ff; color:white; border-radius:10px;
        text-decoration:none; font-size:14px; font-weight:600; transition:background 0.2s;
        white-space:nowrap"
        onmouseover="this.style.background='#5a52d5'"
        onmouseout="this.style.background='#6c63ff'">
        + Nueva Nota
    </a>
    @endauth
</div>

{{-- LAYOUT COLUMNAS --}}
@if($colorFiltro === 'todas' && !$buscar)

    {{-- Vista de 4 columnas por color --}}
    @php
        $columnas = [
            'amarillo' => ['label' => '🟡 Amarillo', 'fondo' => '#FFF9C4', 'borde' => '#F9A825', 'bg_col' => '#fffef0'],
            'azul'     => ['label' => '🔵 Azul',     'fondo' => '#E3F2FD', 'borde' => '#1565C0', 'bg_col' => '#f0f7ff'],
            'verde'    => ['label' => '🟢 Verde',     'fondo' => '#E8F5E9', 'borde' => '#2E7D32', 'bg_col' => '#f0faf0'],
            'rosado'   => ['label' => '🌸 Rosado',   'fondo' => '#FCE4EC', 'borde' => '#C2185B', 'bg_col' => '#fff0f5'],
        ];
    @endphp

    <div class="grid-4-col" style="display:grid; grid-template-columns:repeat(4,1fr); gap:20px; align-items:start">
        @foreach($columnas as $key => $col)
            <div style="background:{{ $col['bg_col'] }}; border-radius:14px; padding:14px">

                {{-- Encabezado columna --}}
                <div style="background:white; border-radius:10px; padding:11px 14px;
                            margin-bottom:12px; box-shadow:0 2px 6px rgba(0,0,0,0.05);
                            border-left:4px solid {{ $col['borde'] }};
                            display:flex; align-items:center; justify-content:space-between">
                    <span style="font-weight:600; color:#1a1a2e; font-size:14px">{{ $col['label'] }}</span>
                    <span style="background:{{ $col['fondo'] }}; color:{{ $col['borde'] }};
                                 padding:2px 9px; border-radius:20px; font-size:12px; font-weight:700">
                        {{ isset($notasPorColor[$key]) ? $notasPorColor[$key]->count() : 0 }}
                    </span>
                </div>

                {{-- Notas de esta columna --}}
                @if(isset($notasPorColor[$key]) && $notasPorColor[$key]->count() > 0)
                    @foreach($notasPorColor[$key] as $nota)
                        @include('notas._tarjeta', ['nota' => $nota])
                    @endforeach
                @else
                    <div style="background:white; border-radius:10px; padding:22px 14px;
                                text-align:center; color:#bbb; font-size:13px;
                                box-shadow:0 2px 6px rgba(0,0,0,0.04)">
                        Sin notas
                    </div>
                @endif

            </div>
        @endforeach
    </div>

@else

    {{-- Vista de grilla 3 columnas cuando hay filtro --}}
    @if($notas->count() > 0)
        <div class="grid-3-col" style="display:grid; grid-template-columns:repeat(3,1fr); gap:20px; align-items:start">
            @foreach($notas as $nota)
                @include('notas._tarjeta', ['nota' => $nota])
            @endforeach
        </div>
    @else
        <div style="text-align:center; padding:80px 20px; background:white;
                    border-radius:16px; box-shadow:0 2px 8px rgba(0,0,0,0.06)">
            <div style="font-size:52px; margin-bottom:16px">🔍</div>
            <h3 style="color:#1a1a2e; margin:0 0 8px 0; font-size:20px">Sin resultados</h3>
            <p style="color:#888; margin:0 0 24px 0">No se encontraron notas con esos filtros</p>
            <a href="{{ route('notas.index') }}"
                style="padding:11px 24px; background:#6c63ff; color:white;
                border-radius:10px; text-decoration:none; font-weight:600">
                Ver todas las notas
            </a>
        </div>
    @endif

@endif

<script>
    // ── Estado del filtro de color actual ──
    let colorFiltroActual = '{{ $colorFiltro }}';
    let timeoutBusqueda   = null;

    // ── Búsqueda en tiempo real con debounce 300ms ──
    document.getElementById('inputBuscar').addEventListener('input', function() {
        const valor = this.value.trim();
        document.getElementById('btnLimpiarBuscar').style.display = valor.length > 0 ? 'block' : 'none';
        clearTimeout(timeoutBusqueda);
        timeoutBusqueda = setTimeout(aplicarFiltros, 300);
    });

    // ── Filtrar por color ──
    function filtrarColor(color) {
        colorFiltroActual = color;

        const configs = {
            'todas':    '#6c63ff',
            'amarillo': '#F9A825',
            'azul':     '#1565C0',
            'verde':    '#2E7D32',
            'rosado':   '#C2185B',
        };

        document.querySelectorAll('.btn-filtro-color').forEach(function(btn) {
            const c = btn.getAttribute('data-color');
            if (c === color) {
                btn.style.background = configs[c];
                btn.style.color      = 'white';
            } else {
                btn.style.background = 'white';
                btn.style.color      = configs[c];
            }
        });

        aplicarFiltros();
    }

    // ── Limpiar búsqueda de texto ──
    function limpiarBusqueda() {
        const input = document.getElementById('inputBuscar');
        input.value = '';
        document.getElementById('btnLimpiarBuscar').style.display = 'none';
        aplicarFiltros();
        input.focus();
    }

    // ── Construir URL y navegar ──
    function aplicarFiltros() {
        const buscar = document.getElementById('inputBuscar').value.trim();
        const url    = new URL(window.location.href);

        if (buscar) {
            url.searchParams.set('buscar', buscar);
        } else {
            url.searchParams.delete('buscar');
        }

        if (colorFiltroActual && colorFiltroActual !== 'todas') {
            url.searchParams.set('color', colorFiltroActual);
        } else {
            url.searchParams.delete('color');
        }

        window.location.href = url.toString();
    }
</script>

@endsection
