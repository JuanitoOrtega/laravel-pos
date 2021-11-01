@extends('layouts.admin')

@section('titulo', 'Lista de categorías')

@section('contenido')

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modalCategoria">
    Nueva categoría
</button>

<!-- Modal -->
<div class="modal fade" id="modalCategoria" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear nueva categoría</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>

            <form action="{{ route('categoria.store') }}" method="post">
                <div class="modal-body">
                    @csrf
                    <div class="form-group">
                        <label for="nombre">Nombre:</label>
                        <input type="text" class="form-control" name="nombre" placeholder="Ingrese el nombre de la categoría" required>
                    </div>

                    <div class="form-group">
                        <label for="detalle">Descripción:</label>
                        <textarea class="form-control" name="detalle" rows="3" placeholder="Ingrese descripción de la categoría"></textarea>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Guardar categoría</button>
                </div>
            </form>

        </div>
    </div>
</div>

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
                        <th>Nombre</th>
                        <th>Detalle</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>

                    @foreach ($lista_categorias as $categoria)
                    <tr>
                        <td scope="row">{{ $categoria->id }}</td>
                        <td>{{ $categoria->nombre }}</td>
                        <td>{{ $categoria->detalle }}</td>
                        <td>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#editarCategoria{{ $categoria->id }}">
                                <i class="fas fa-edit"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="editarCategoria{{ $categoria->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Editar categoría</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <form action="{{ route('categoria.update', $categoria->id) }}" method="post">
                                            <div class="modal-body">
                                                @csrf
                                                {{-- Para actualizar se necesita sobreescribir el método post --}}
                                                @method('PUT')
                                                <div class="form-group">
                                                    <label for="nombre">Nombre:</label>
                                                    <input type="text" class="form-control" name="nombre" placeholder="Ingrese el nombre de la categoría" value="{{ $categoria->nombre }}" required>
                                                </div>

                                                <div class="form-group">
                                                    <label for="detalle">Descripción:</label>
                                                    <textarea class="form-control" name="detalle" rows="3" placeholder="Ingrese descripción de la categoría">{{ $categoria->detalle }}</textarea>
                                                </div>

                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary">Guardar categoría</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            |
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminarCategoria{{ $categoria->id }}">
                                <i class="far fa-trash-alt"></i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="eliminarCategoria{{ $categoria->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">¿Seguro que quiere eliminar la categoría?</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>

                                        <form action="{{ route('categoria.destroy', $categoria->id) }}" method="post">
                                            <div class="modal-body">
                                                @csrf
                                                {{-- Para actualizar se necesita sobreescribir el método post --}}
                                                @method('DELETE')
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $categoria->nombre }}
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
