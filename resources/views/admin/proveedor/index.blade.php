@extends('layouts.admin')

@section('titulo', 'Lista de proveedores')

@section('contenido')

<a class="btn btn-primary" href="{{ route('proveedor.create') }}" role="button">Nuevo proveedor</a>

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
                    <th>Dirección</th>
                    <th>NIT</th>
                    <th>Teléfono</th>
                    <th>Email</th>
                    <th>Contacto</th>
                    <th>Teléfono contacto</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>

                @foreach ($lista_proveedores as $proveedor)
                <tr>
                    <td scope="row">{{ $proveedor->id }}</td>
                    <td>{{ $proveedor->nombre }}</td>
                    <td>{{ $proveedor->direccion }}</td>
                    <td>{{ $proveedor->nit }}</td>
                    <td>{{ $proveedor->telefono }}</td>
                    <td>{{ $proveedor->email }}</td>
                    <td>{{ $proveedor->nombre_contacto }}</td>
                    <td>{{ $proveedor->telefono_contacto  }}</td>
                    <td>
                        <a class="btn btn-warning" href="{{ route('proveedor.edit', $proveedor->id) }}" role="button">
                            <i class="fas fa-edit"></i>
                        </a>
                        |
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#eliminarProveedor{{ $proveedor->id }}">
                            <i class="far fa-trash-alt"></i>
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="eliminarProveedor{{ $proveedor->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">¿Seguro que quiere eliminar el proveedor?</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>

                                    <form action="{{ route('proveedor.destroy', $proveedor->id) }}" method="post">
                                        <div class="modal-body">
                                            @csrf
                                            {{-- Para actualizar se necesita sobreescribir el método post --}}
                                            @method('DELETE')
                                            <div class="alert alert-warning" role="alert">
                                                {{ $proveedor->nombre }}
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
