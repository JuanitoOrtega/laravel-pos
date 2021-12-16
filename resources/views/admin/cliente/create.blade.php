@extends('layouts.admin')

@section('titulo', 'Nuevo cliente')

@section('contenido')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('cliente.store') }}" method="post" enctype="multipart/form-data">

                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre">Nombre:</label>
                                        <input type="text" class="form-control" name="nombre" placeholder="Nombre del cliente">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="apellido">Apellido:</label>
                                        <input type="text" class="form-control" name="apellido" placeholder="Apellido del cliente">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="ci">CI:</label>
                                        <input type="text" class="form-control" name="ci" placeholder="CI del cliente">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nit">NIT:</label>
                                        <input type="number" min="0" class="form-control" name="nit" placeholder="Ingrese NIT del cliente">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="telefono">Teléfono:</label>
                                <input type="number" class="form-control" name="telefono" placeholder="Ingrese telefono del cliente">
                            </div>
                            <div class="form-group">
                                <label for="correo">Correo:</label>
                                <input type="email" class="form-control" name="correo" placeholder="Ingrese correo del cliente">
                            </div>

                            <a class="btn btn-secondary" href="{{ route('cliente.index') }}" role="button">Volver</a>
                            <button type="submit" class="btn btn-success float-right">Guardar cliente</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
