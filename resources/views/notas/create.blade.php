@extends('layouts.app')

@section('content')
<div class="form-card">
    <h2>✏️ Nueva Nota</h2>

    @if($errors->any())
        <div class="validation-errors">
            @foreach($errors->all() as $error)
                <p>• {{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form method="POST" action="{{ route('notas.store') }}">
        @csrf

        <div class="form-group">
            <label class="form-label" for="titulo">Título</label>
            <input id="titulo" type="text" name="titulo" value="{{ old('titulo') }}"
                   placeholder="Escribe el título..." class="form-input" required>
        </div>

        <div class="form-group">
            <label class="form-label" for="contenido">Contenido</label>
            <textarea id="contenido" name="contenido" class="form-textarea"
                      placeholder="Escribe el contenido de tu nota..." required>{{ old('contenido') }}</textarea>
        </div>

        <div class="form-group">
            <label class="form-label" for="color">Color</label>
            <select id="color" name="color" class="form-select">
                <option value="amarillo" {{ old('color', 'amarillo') === 'amarillo' ? 'selected' : '' }}>🟡 Amarillo</option>
                <option value="azul"     {{ old('color') === 'azul'     ? 'selected' : '' }}>🔵 Azul</option>
                <option value="verde"    {{ old('color') === 'verde'    ? 'selected' : '' }}>🟢 Verde</option>
                <option value="rosado"   {{ old('color') === 'rosado'   ? 'selected' : '' }}>🌸 Rosado</option>
            </select>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn-guardar">💾 Guardar</button>
            <a href="{{ route('notas.index') }}" class="btn-cancelar">Cancelar</a>
        </div>
    </form>
</div>

<script>
    const selectColor = document.getElementById('color');
    const coloresPreview = {
        'amarillo': '#FFF9C4',
        'azul':     '#E3F2FD',
        'verde':    '#E8F5E9',
        'rosado':   '#FCE4EC'
    };
    function actualizarColor() {
        selectColor.style.background = coloresPreview[selectColor.value] || '#f8f9fa';
        selectColor.style.fontWeight = '600';
    }
    selectColor.addEventListener('change', actualizarColor);
    actualizarColor();
</script>
@endsection
