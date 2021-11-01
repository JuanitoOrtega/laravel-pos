@extends('layouts.admin')

@section('titulo', 'Editar producto')

@section('contenido')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('producto.update', $producto->id) }}" method="post" enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" value="{{ $producto->nombre }}" placeholder="Nombre del producto">
                            </div>

                            <div class="form-group">
                                <label for="categoria_id">Categoría:</label>
                                    <select class="form-control" name="categoria_id" value="{{ $producto->categoria_id }}">

                                        @foreach ($lista_categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                        @endforeach

                                    </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="stock">Stock:</label>
                                        <input type="number" min="0" class="form-control" name="stock" value="{{ $producto->stock }}" placeholder="Ingrese cantidad del producto">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="precio">Precio:</label>
                                        <input type="number" min="0" step="0.01" class="form-control" name="precio" value="{{ $producto->precio }}" placeholder="Ingrese precio del producto">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <textarea class="form-control" name="descripcion" rows="3" placeholder="Ingrese descripción del producto">{{ $producto->descripcion }}</textarea>
                            </div>

                            <div class="form-group">
                                <label for="imagen">Imagen:</label>
                                <input type="file" class="form-control-file" name="imagen">
                            </div>

                            <a class="btn btn-secondary" href="{{ route('producto.index') }}" role="button">Volver</a>
                            <button type="submit" class="btn btn-success float-right">Guardar</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
