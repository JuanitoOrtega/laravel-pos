@extends('layouts.admin')

@section('titulo', 'Lista pedidos')

@section('contenido')

<a class="btn btn-primary" href="" role="button">Nuevo pedido</a>

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
                    <th>Fecha</th>
                    <th>Usuario</th>
                    <th>Cliente</th>
                    <th>Detalle</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pedidos as $pedido)
                <tr>
                    <td scope="row">{{ $pedido->id }}</td>
                    <td>2021-11-18</td>
                    <td>Carlos</td>
                    <td>Felipe</td>
                    <td>Hola</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
