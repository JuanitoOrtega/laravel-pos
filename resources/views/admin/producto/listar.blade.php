@extends('layouts.admin')

@section('titulo', 'Lista productos')

@section('contenido')
    <h1>Lista de productos</h1>
    {{ $lista_productos }}

    <button></button>
    {{ route('producto.create') }}
    <table }class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>NOMBRE</th>
                <th>PRECIO</th>
                <th>STOCK</th>
                <th>CATEGORIA</th>
                <th>ACCIONES</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->id }}</td>
                <td>{{ $producto->id }}</td>
            </tr>
        </tbody>
    </table>
@endsection
