@extends('layouts.admin')

@section('titulo', 'Lista pedidos')

@section('contenido')

<a class="btn btn-primary" href="{{ route('pedido.create') }}" role="button">Nuevo pedido</a>

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
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nro. Factura</th>
                    <th>Fecha Factura</th>
                    <th>Usuario</th>
                    <th>Cliente</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                <tr>
                    <td scope="row">{{ $pedido->id }}</td>
                    <td>{{ $pedido->cod_factura }}</td>
                    <td>{{ $pedido->fecha }}</td>
                    <td>{{ $pedido->user->name }}</td>
                    <td>{{ $pedido->cliente->nombre }} {{ $pedido->cliente->apellido }}</td>
                    <td>
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#detallePedido{{$pedido->id}}">
                            Detalle
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="detallePedido{{$pedido->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Detalles del pedido</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <table class="table">
                                            <tr>
                                                <td>ID</td>
                                                <td>Nombre</td>
                                                <td>Cantidad</td>
                                                <td>Precio</td>
                                                <td>Subtotal</td>
                                            </tr>
                                            @foreach ($pedido->productos as $prod)
                                            <tr>
                                                <td>{{ $prod->id }}</td>
                                                <td>{{ $prod->nombre }}</td>
                                                <td>{{ $prod->pivot->cantidad }}</td>
                                                <td>{{ $prod->precio }}</td>
                                                <td>{{ $prod->pivot->cantidad * $prod->precio }}</td>
                                            </tr>
                                            @endforeach
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                                    </div>
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
