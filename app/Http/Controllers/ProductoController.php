<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\Proveedor;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista_productos = Producto::orderBy('id', 'ASC')->get();
        $lista_proveedores = Proveedor::orderBy('id', 'ASC')->get();
        return view('admin.producto.listar', compact('lista_productos', 'lista_proveedores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $lista_categorias = Categoria::all();
        return view('admin.producto.nuevo', compact('lista_categorias'));
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
        $nombre_imagen = "";
        if ($file = $request->file('imagen')) {
            $nombre_imagen = time()."-".$file->getClientOriginalName();
            $file->move('images', $nombre_imagen);
        }
        // Subir imagen
        // Guardar
        $producto = new Producto();
        $producto->nombre = $request->nombre;
        $producto->categoria_id = $request->categoria_id;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion;
        $producto->imagen = $nombre_imagen;
        $producto->save();

        // Redireccionar
        return redirect()->route('producto.index')->with('mensaje', 'Producto creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function show(Producto $producto)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function edit(Producto $producto)
    {
        $lista_categorias = Categoria::all();
        return view('admin.producto.editar', compact('producto', 'lista_categorias'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Producto $producto)
    {
        $producto->nombre = $request->nombre;
        $producto->categoria_id = $request->categoria_id;
        $producto->precio = $request->precio;
        $producto->stock = $request->stock;
        $producto->descripcion = $request->descripcion;

        $nombre_imagen = "";
        if ($file = $request->file('imagen')) {
            $nombre_imagen = time()."-".$file->getClientOriginalName();
            $file->move('images', $nombre_imagen);
            $producto->imagen = $nombre_imagen;
        }

        $producto->save();

        // Redireccionar
        return redirect()->route('producto.index')->with('mensaje', 'Producto modificado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Producto  $producto
     * @return \Illuminate\Http\Response
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('producto.index')->with('mensaje', 'Producto eliminado con éxito');
    }

    public function actualizarProductos(Request $request, $id)
    {
        $cantidad = $request->cantidad;
        $proveedor_id = $request->proveedor;

        // Actualizar stock del producto
        $producto = Producto::find($id);
        $producto->stock = $producto->stock + $cantidad;
        $producto->save();

        // Registrar al proveedor + la cantidad actualizada
        // N:M
        $producto->proveedors()->attach($proveedor_id, ['cantidad' => $cantidad]);

        return redirect()->route('producto.index')->with('mensaje', 'Stock actualizado con éxito');
    }

}
