@extends('layouts.admin')

@section('titulo', 'Crear producto')

@section('contenido')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('producto.store') }}" method="post" enctype="multipart/form-data">

                            @csrf

                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" placeholder="Nombre del producto" required>
                            </div>

                            <div class="form-group">
                                <label>Categoría:</label>
                                    <select class="form-control select2" name="categoria_id" style="width: 100%;" required>
                                        <option value="">Seleccione una categoría</option>
                                        @foreach ($lista_categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                                        @endforeach
                                    </select>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="stock">Stock:</label>
                                        <input type="number" min="0" class="form-control" name="stock" placeholder="Ingrese cantidad del producto">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="precio">Precio:</label>
                                        <input type="number" min="0" step="0.01" class="form-control" name="precio" placeholder="Ingrese precio del producto">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="descripcion">Descripción:</label>
                                <textarea class="form-control" name="descripcion" rows="3" placeholder="Ingrese descripción del producto"></textarea>
                            </div>

                            <div class="form-group">
                                <label for="imagen">Imagen:</label>
                                <input type="file" class="form-control-file" name="imagen">
                            </div>

                            <a class="btn btn-secondary" href="{{ route('producto.index') }}" role="button">Volver</a>
                            <button type="submit" class="btn btn-success float-right">Enviar</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
