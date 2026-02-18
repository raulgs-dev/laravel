<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ClienteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $clientes = Cliente::paginate(10);
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        return view('clientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'    => 'required|string|max:255',
            'email'     => 'required|email|unique:clientes,email',
            'telefono'  => 'required|string|max:20',
            'direccion' => 'required|string|max:500',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $datos = $request->only(['nombre', 'email', 'telefono', 'direccion']);

        if ($request->hasFile('foto')) {
            $datos['foto'] = $request->file('foto')->store('clientes', 'public');
        }

        Cliente::create($datos);

        return redirect()->route('clientes.index')->with('success', 'Cliente creado correctamente.');
    }

    public function show(Cliente $cliente)
    {
        return view('clientes.show', compact('cliente'));
    }

    public function edit(Cliente $cliente)
    {
        return view('clientes.edit', compact('cliente'));
    }

    public function update(Request $request, Cliente $cliente)
    {
        $request->validate([
            'nombre'    => 'required|string|max:255',
            'email'     => 'required|email|unique:clientes,email,' . $cliente->id,
            'telefono'  => 'required|string|max:20',
            'direccion' => 'required|string|max:500',
            'foto'      => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $datos = $request->only(['nombre', 'email', 'telefono', 'direccion']);

        if ($request->hasFile('foto')) {
            if ($cliente->foto) {
                Storage::disk('public')->delete($cliente->foto);
            }
            $datos['foto'] = $request->file('foto')->store('clientes', 'public');
        }

        $cliente->update($datos);

        return redirect()->route('clientes.index')->with('success', 'Cliente actualizado correctamente.');
    }

    public function destroy(Cliente $cliente)
    {
        if (!auth()->user()->esAdmin()) {
            abort(403, 'Solo los administradores pueden eliminar clientes.');
        }

        if ($cliente->foto) {
            Storage::disk('public')->delete($cliente->foto);
        }

        $cliente->delete();

        return redirect()->route('clientes.index')->with('success', 'Cliente eliminado correctamente.');
    }
}
