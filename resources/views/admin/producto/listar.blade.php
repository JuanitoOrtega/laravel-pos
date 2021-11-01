@extends('layouts.admin')

@section('titulo', 'Lista productos')

@section('contenido')

<a class="btn btn-primary" href="{{ route('producto.create') }}" role="button">Crear producto</a>

@if (session('mensaje'))

    <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
        {{ session('mensaje') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
    </div>

@endif

<div class="card mt-3">
    <div class="card-body">

            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Imagen</th>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Descripción</th>
                        <th>Stock</th>
                        <th>Precio</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($lista_productos as $producto)
                    <tr>
                        <td scope="row">{{ $producto->id }}</td>
                        <td>{{ $producto->imagen }}</td>
                        <td>{{ $producto->nombre }}</td>
                        <td>{{ $producto->categoria_id }}</td>
                        <td>{{ $producto->descripcion }}</td>
                        <td>{{ $producto->stock }}</td>
                        <td>{{ $producto->precio }}</td>
                        <td>
                            <a class="btn btn-warning" href="{{ route('producto.edit', $producto->id) }}" role="button">
                                <i class="fas fa-edit"></i>
                            </a>
                            |
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminarProducto{{ $producto->id }}">
                                <i class="far fa-trash-alt"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="eliminarProducto{{ $producto->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">¿Seguro que quiere eliminar el producto?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="{{ route('producto.destroy', $producto->id) }}" method="post">
                                            <div class="modal-body">
                                                @csrf
                                                {{-- Para actualizar se necesita sobreescribir el método post --}}
                                                @method('DELETE')
                                                <div class="alert alert-warning" role="alert">
                                                    {{ $producto->nombre }}
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-danger">Sí, eliminar</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>

                        </td>
                    </tr>
                    @endforeach

                </tbody>
            </table>

    </div>
</div>

@endsection
