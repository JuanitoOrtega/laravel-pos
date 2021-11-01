@extends('layouts.admin')

@section('titulo', 'Editar proveedor')

@section('contenido')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-body">

                    <form action="{{ route('proveedor.update', $proveedor->id) }}" method="post" enctype="multipart/form-data">

                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="nombre">Nombre:</label>
                                <input type="text" class="form-control" name="nombre" value="{{ $proveedor->nombre }}" placeholder="Nombre del proveedor">
                            </div>

                            <div class="form-group">
                                <label for="direccion">Dirección:</label>
                                <input type="text" class="form-control" name="direccion" value="{{ $proveedor->direccion }}" placeholder="Dirección del proveedor">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nit">NIT:</label>
                                        <input type="number" min="0" class="form-control" name="nit" value="{{ $proveedor->nit }}" placeholder="Ingrese NIT del proveedor">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telefono">Teléfono:</label>
                                        <input type="tel" class="form-control" name="telefono" value="{{ $proveedor->telefono }}" placeholder="Ingrese número de teléfono">
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" name="email" value="{{ $proveedor->email }}" placeholder="Ingrese correo electrónico">
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombre_contacto">Nombre de contacto:</label>
                                        <input type="text" class="form-control" name="nombre_contacto" value="{{ $proveedor->nombre_contacto }}" placeholder="Ingrese nombre de contacto">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="telefono_contacto">Teléfono de contacto:</label>
                                        <input type="text" class="form-control" name="telefono_contacto" value="{{ $proveedor->telefono_contacto }}" placeholder="Ingrese teléfono de contacto">
                                    </div>
                                </div>
                            </div>

                            <a class="btn btn-secondary" href="{{ route('proveedor.index') }}" role="button">Volver</a>
                            <button type="submit" class="btn btn-success float-right">Guardar</button>

                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection
