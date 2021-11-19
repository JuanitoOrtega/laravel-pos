@extends('layouts.admin')

@section('titulo', 'Nuevo pedido')

@section("css")
<!-- DataTables -->
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
<link rel="stylesheet" href="{{ asset('adminlte/plugins/datatables-buttons/css/buttons.bootstrap4.min.css') }}">
@endsection

@section("js")
<!-- DataTables  & Plugins -->
<script src="{{ asset('adminlte/plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('adminlte/plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<script>
    $(function () {
      $("#tableProducts").DataTable({
        "responsive": true,
        "lengthChange": false,
        "autoWidth": false,
        "buttons": ["copy", "csv", "excel", "pdf", "print"]
        // "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
      }).buttons().container().appendTo('#tableProducts_wrapper .col-md-6:eq(0)');
    });

    // carrito
    let carrito = [];
    // let cliente_id;
    function adicionarCarrito(prod){
        prod = JSON.parse(prod); // Convierte el string a objeto (JSON)

        let producto = {id: prod.id, nombre: prod.nombre, precio: prod.precio, cantidad: 1};
        carrito.push(producto);

        actualizarCarrito();
    }

    function actualizarCarrito(){
        let html = ``;
        let total = 0;
        for (let i = 0; i < carrito.length; i++) {
            const element = carrito[i];
            html = html + `
            <tr>
                <td scope="row">${element.nombre}</td>
                <td>${element.precio}</td>
                <td>${element.cantidad}</td>
                <td>
                    <button class="btn btn-danger" onclick="quitarCarrito(${i})">x</button>
                </td>
            </tr>`;
            total += parseFloat((element.precio * element.cantidad));
        }
        total = total.toFixed(2);
        document.getElementById("carrito").innerHTML = html;
        document.getElementById("total").innerHTML = total;
    }

    function quitarCarrito(posicion) {
        carrito.splice(posicion, 1);
        actualizarCarrito();
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

@endsection

@section('contenido')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <h3>Lista de productos</h3>
                    <table id="tableProducts" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Categoría</th>
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
                                <td>{{ $producto->categoria->nombre }}</td>
                                <td>{{ $producto->stock }}</td>
                                <td>{{ $producto->precio }}</td>
                                <td>
                                    <button class="btn btn-primary btn-xs" onclick="adicionarCarrito('{{ $producto }}')">Adicionar</button>
                                </td>
                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h3>Detalles</h3>
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Cantidad</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody id="carrito">
                        </tbody>
                    </table>
                    <h2>TOTAL: Bs. <span id="total"></span></h2>
                    <hr>

                    <table class="table">
                    <tr>
                        <td>
                        <h5>CI/NIT: <span id="cliente"></span></h5>
                        <strong><span id="buscar"></span></strong>
                        </td>
                    </tr>
                        <tr>
                        <label for="">Buscar CI o NIT</label>
                        <td><input type="text" id="valor" class="form-control" placeholder="ci / nit" onkeyup="buscarCliente()"></td>
                        </tr>
                        <tr>
                        <td>

                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#Modal">
                        Nuevo Cliente
                        </button>

                        <!-- Modal -->
                        <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                </div>
                                <div class="modal-body">
                                <label for="">Nombre Completo</label>
                                <input type="text" class="form-control" id="nombre_completo">
                                <label for="">CI / NIT</label>
                                <input type="text" class="form-control" id="ci_nit">
                                <label for="">Telefono</label>
                                <input type="text" class="form-control" id="telefono">
                                <label for="">Correo</label>
                                <input type="email" class="form-control" id="correo">



                                </div>
                                <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="guardarCliente()">Guardar Cliente</button>
                                </div>
                            </div>
                            </div>
                        </div>

                        </td>
                        </tr>
                        <tr>
                        <td>
                        <button class="btn btn-success btn-block" onclick="realizarPedido()">Realizar Pedido</button>
                        </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
