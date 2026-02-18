<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $productos = Producto::paginate(10);
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        return view('productos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'precio'      => 'required|numeric|min:0',
            'cantidad'    => 'required|integer|min:0',
            'descripcion' => 'nullable|string|max:1000',
            'imagen'      => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'pdf'         => 'nullable|mimes:pdf|max:5120',
        ]);

        $datos = $request->only(['nombre', 'precio', 'cantidad', 'descripcion']);

        if ($request->hasFile('imagen')) {
            $datos['imagen'] = $request->file('imagen')->store('productos/imagenes', 'public');
        }

        if ($request->hasFile('pdf')) {
            $datos['pdf'] = $request->file('pdf')->store('productos/pdfs', 'public');
        }

        Producto::create($datos);

        return redirect()->route('productos.index')->with('success', 'Producto creado correctamente.');
    }

    public function show(Producto $producto)
    {
        return view('productos.show', compact('producto'));
    }

    public function edit(Producto $producto)
    {
        return view('productos.edit', compact('producto'));
    }

    public function update(Request $request, Producto $producto)
    {
        $request->validate([
            'nombre'      => 'required|string|max:255',
            'precio'      => 'required|numeric|min:0',
            'cantidad'    => 'required|integer|min:0',
            'descripcion' => 'nullable|string|max:1000',
            'imagen'      => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
            'pdf'         => 'nullable|mimes:pdf|max:5120',
        ]);

        $datos = $request->only(['nombre', 'precio', 'cantidad', 'descripcion']);

        if ($request->hasFile('imagen')) {
            if ($producto->imagen) {
                Storage::disk('public')->delete($producto->imagen);
            }
            $datos['imagen'] = $request->file('imagen')->store('productos/imagenes', 'public');
        }

        if ($request->hasFile('pdf')) {
            if ($producto->pdf) {
                Storage::disk('public')->delete($producto->pdf);
            }
            $datos['pdf'] = $request->file('pdf')->store('productos/pdfs', 'public');
        }

        $producto->update($datos);

        return redirect()->route('productos.index')->with('success', 'Producto actualizado correctamente.');
    }

    public function destroy(Producto $producto)
    {
        if (!auth()->user()->esAdmin()) {
            abort(403, 'Solo los administradores pueden eliminar productos.');
        }

        if ($producto->imagen) {
            Storage::disk('public')->delete($producto->imagen);
        }
        if ($producto->pdf) {
            Storage::disk('public')->delete($producto->pdf);
        }

        $producto->delete();

        return redirect()->route('productos.index')->with('success', 'Producto eliminado correctamente.');
    }
}
