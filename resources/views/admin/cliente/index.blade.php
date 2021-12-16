@extends('layouts.admin')

@section('titulo', 'Lista de clientes')

@section('contenido')

<a class="btn btn-primary" href="{{ route('cliente.create') }}" role="button">Nuevo cliente</a>

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
                    <th>ID:</th>
                    <th>Nombre:</th>
                    <th>Apellido:</th>
                    <th>CI:</th>
                    <th>NIT:</th>
                    <th>Teléfono:</th>
                    <th>Correo:</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lista_clientes as $cliente)
                <tr>
                    <td scope="row">{{ $cliente->id }}</td>
                    <td>{{ $cliente->nombre }}</td>
                    <td>{{ $cliente->apellido }}</td>
                    <td>{{ $cliente->ci }}</td>
                    <td>{{ $cliente->nit }}</td>
                    <td>{{ $cliente->telefono }}</td>
                    <td>{{ $cliente->correo }}</td>
                    <td>
                        <a class="btn btn-warning" href="{{ route('cliente.edit', $cliente->id) }}" role="button">
                            <i class="fas fa-edit"></i>
                        </a>
                        |
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminarCliente{{ $cliente->id }}">
                            <i class="far fa-trash-alt"></i>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="eliminarCliente{{ $cliente->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">¿Seguro que quiere eliminar el cliente?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form action="{{ route('cliente.destroy', $cliente->id) }}" method="post">
                                        <div class="modal-body">
                                            @csrf
                                            {{-- Para actualizar se necesita sobreescribir el método post --}}
                                            @method('DELETE')
                                            <div class="alert alert-warning" role="alert">
                                                {{ $cliente->nombre }}
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
