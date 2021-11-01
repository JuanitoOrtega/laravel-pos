@extends('layouts.admin')

@section('titulo', 'Lista de usuarios')

@section('container')
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Lista de usuarios</h5>
                    <p class="card-text">
                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Fuga in perspiciatis debitis fugit unde ducimus dolorem labore eius voluptatem voluptate esse voluptates eum odio iusto, quis consequuntur exercitationem error cupiditate.
                    </p>
                    @auth
                        Logueado
                    @else
                        <a href="#" class="btn btn-primary">Crear usuario</a>
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
