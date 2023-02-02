<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $pedidos = Pedido::paginate(10);
        return view('admin.pedido.index', compact('pedidos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lista_productos = Producto::all();
        return view('admin.pedido.nuevo', compact('lista_productos'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cliente_id = $request->cliente_id;
        $user_id = $request->user_id;
        $productos = $request->productos;

        // obtener el último código de factura
        $ultimo_codigo = Pedido::latest('cod_factura')->first();
        if ($ultimo_codigo) {
            $cod_factura = (int) substr($ultimo_codigo->cod_factura, 0, 5) + 1;
        } else {
            $cod_factura = 1;
        }

        // formatear el código de factura a 5 dígitos
        $cod_factura = str_pad($cod_factura, 5, "0", STR_PAD_LEFT);

        // guardar el pedido
        $pedido = new Pedido;
        $pedido->fecha = date("Y-m-d H:i:s");
        $pedido->cod_factura = $cod_factura;
        $pedido->cliente_id = $cliente_id;
        $pedido->user_id = $user_id;
        $pedido->save();

        // asignar los productos al pedido
        foreach ($productos as $producto) {
            $pedido->productos()->attach($producto["id"], ["cantidad" => $producto["cantidad"]]);
        }
        return response()->json(["mensaje" => "Pedido registrado"], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function show(Pedido $pedido)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function edit(Pedido $pedido)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Pedido $pedido)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pedido  $pedido
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pedido $pedido)
    {
        //
    }
}
