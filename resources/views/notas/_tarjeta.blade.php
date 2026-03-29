@php
    $configs = [
        'amarillo' => ['fondo' => '#FFF9C4', 'borde' => '#F9A825'],
        'azul'     => ['fondo' => '#E3F2FD', 'borde' => '#1565C0'],
        'verde'    => ['fondo' => '#E8F5E9', 'borde' => '#2E7D32'],
        'rosado'   => ['fondo' => '#FCE4EC', 'borde' => '#C2185B'],
    ];
    $config = $configs[$nota->color] ?? ['fondo' => '#f5f5f5', 'borde' => '#999'];
@endphp

<div style="background:{{ $config['fondo'] }}; border-radius:14px; padding:20px;
            border-left:4px solid {{ $config['borde'] }};
            box-shadow:0 3px 10px rgba(0,0,0,0.07); margin-bottom:12px;
            transition:transform 0.2s, box-shadow 0.2s; cursor:pointer"
    onmouseover="this.style.transform='translateY(-3px)';this.style.boxShadow='0 8px 20px rgba(0,0,0,0.12)'"
    onmouseout="this.style.transform='translateY(0)';this.style.boxShadow='0 3px 10px rgba(0,0,0,0.07)'">

    <h4 style="margin:0 0 8px 0; font-size:16px; color:#1a1a2e; font-weight:600;
               white-space:nowrap; overflow:hidden; text-overflow:ellipsis">
        {{ $nota->titulo }}
    </h4>

    <p style="margin:0 0 14px 0; color:#555; font-size:13px; line-height:1.5;
              overflow:hidden; display:-webkit-box; -webkit-line-clamp:2;
              -webkit-box-orient:vertical">
        {{ $nota->contenido }}
    </p>

    <div style="display:flex; justify-content:space-between; align-items:center;
                border-top:1px solid rgba(0,0,0,0.06); padding-top:12px">
        <small style="color:#999; font-size:11px">
            {{ $nota->created_at->format('d/m/Y') }}
        </small>
        <div style="display:flex; gap:6px">
            <a href="{{ route('notas.show', $nota) }}"
               title="Ver nota"
               style="width:32px; height:32px; background:rgba(0,0,0,0.08);
               border-radius:8px; display:flex; align-items:center;
               justify-content:center; text-decoration:none; font-size:15px;
               transition:background 0.2s"
               onmouseover="this.style.background='rgba(0,0,0,0.15)'"
               onmouseout="this.style.background='rgba(0,0,0,0.08)'">👁</a>

            @auth
            <a href="{{ route('notas.edit', $nota) }}"
               title="Editar nota"
               style="width:32px; height:32px; background:rgba(0,0,0,0.08);
               border-radius:8px; display:flex; align-items:center;
               justify-content:center; text-decoration:none; font-size:15px;
               transition:background 0.2s"
               onmouseover="this.style.background='rgba(0,0,0,0.15)'"
               onmouseout="this.style.background='rgba(0,0,0,0.08)'">✏️</a>

            <form method="POST" action="{{ route('notas.destroy', $nota) }}" style="margin:0"
                  id="form-eliminar-{{ $nota->id }}">
                @csrf
                @method('DELETE')
                <button type="button"
                    title="Eliminar nota"
                    onclick="confirmarEliminar(document.getElementById('form-eliminar-{{ $nota->id }}'))"
                    style="width:32px; height:32px; background:rgba(220,53,69,0.1);
                    border-radius:8px; border:none; cursor:pointer; font-size:15px;
                    transition:background 0.2s"
                    onmouseover="this.style.background='rgba(220,53,69,0.25)'"
                    onmouseout="this.style.background='rgba(220,53,69,0.1)'">🗑️</button>
            </form>
            @endauth
        </div>
    </div>
</div>
