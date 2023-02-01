<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $lista_clientes = Cliente::orderBy('id', 'ASC')->get();
        return view('admin.cliente.index', compact('lista_clientes'));
    }

    public function buscar(Request $request)
    {
        $cliente = Cliente::where('ci', 'like', '%'.$request->valor.'%')->first();
        return response()->json($cliente);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $lista_clientes = Cliente::all();
        return view('admin.cliente.create', compact('lista_clientes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar
        // Subir imagen
        // Guardar
        $proveedor = new Cliente();
        $proveedor->nombre = $request->nombre;
        $proveedor->apellido = $request->apellido;
        $proveedor->ci = $request->ci;
        $proveedor->nit = $request->nit;
        $proveedor->telefono = $request->telefono;
        $proveedor->correo = $request->correo;
        $proveedor->save();

        // Redireccionar
        return redirect()->route('cliente.index')->with('mensaje', 'Cliente creado con éxito');
    }

    public function guardar_cliente(Request $request)
    {
        //
        $cliente = new Cliente();
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->ci = $request->ci;
        $cliente->nit = $request->nit;
        $cliente->telefono = $request->telefono;
        $cliente->correo = $request->correo;
        $cliente->save();
        return response()->json([
            'mensaje' => 'Cliente creado correctamente',
            'cliente' => $cliente
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit(Cliente $cliente)
    {
        //
        $lista_clientes = Cliente::all();
        return view('admin.cliente.editar', compact('cliente', 'lista_clientes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cliente $cliente)
    {
        //
        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->ci = $request->ci;
        $cliente->nit = $request->nit;
        $cliente->telefono = $request->telefono;
        $cliente->correo = $request->correo;
        $cliente->save();

        // Redireccionar
        return redirect()->route('cliente.index')->with('mensaje', 'Cliente modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Cliente $cliente)
    {
        //
        $cliente->delete();
        return redirect()->route('cliente.index')->with('mensaje', 'Cliente eliminado con éxito');
    }
}
