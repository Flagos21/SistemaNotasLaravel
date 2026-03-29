<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Nota;

class NotaController extends Controller
{
    public function index(Request $request)
    {
        $query = Nota::where('user_id', auth()->id());

        if ($request->filled('buscar')) {
            $query->where('titulo', 'like', '%' . $request->buscar . '%');
        }

        if ($request->filled('color') && $request->color !== 'todas') {
            $query->where('color', $request->color);
        }

        $notas = $query->latest()->get();
        $total = Nota::where('user_id', auth()->id())->count();

        $notasPorColor = $notas->groupBy('color');

        $buscar      = $request->buscar;
        $colorFiltro = $request->color ?? 'todas';

        return view('notas.index', compact('notas', 'total', 'notasPorColor', 'buscar', 'colorFiltro'));
    }

    public function create()
    {
        return view('notas.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo'    => ['required', 'min:3'],
            'contenido' => ['required'],
            'color'     => ['required', 'in:amarillo,azul,verde,rosado'],
        ]);

        Nota::create([
            'titulo'    => $request->titulo,
            'contenido' => $request->contenido,
            'color'     => $request->color,
            'user_id'   => auth()->id(),
        ]);

        return redirect()->route('notas.index')->with('success', 'Nota creada correctamente.');
    }

    public function show(Nota $nota)
    {
        if ($nota->user_id !== auth()->id()) {
            abort(403);
        }
        return view('notas.show', compact('nota'));
    }

    public function edit(Nota $nota)
    {
        if ($nota->user_id !== auth()->id()) {
            abort(403);
        }
        return view('notas.edit', compact('nota'));
    }

    public function update(Request $request, Nota $nota)
    {
        if ($nota->user_id !== auth()->id()) {
            abort(403);
        }

        $request->validate([
            'titulo'    => ['required', 'min:3'],
            'contenido' => ['required'],
            'color'     => ['required', 'in:amarillo,azul,verde,rosado'],
        ]);

        $nota->update([
            'titulo'    => $request->titulo,
            'contenido' => $request->contenido,
            'color'     => $request->color,
        ]);

        return redirect()->route('notas.index')->with('success', 'Nota actualizada correctamente.');
    }

    public function destroy(Nota $nota)
    {
        if ($nota->user_id !== auth()->id()) {
            abort(403);
        }

        $nota->delete();

        return redirect()->route('notas.index')->with('success', 'Nota eliminada correctamente.');
    }
}
