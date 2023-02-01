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
    let cliente_id;
    function adicionarCarrito(prod){
        prod = JSON.parse(prod); // Convierte el string a objeto (JSON)
        let sw = 0;
        for (let i = 0; i < carrito.length; i++) {
            const prod_carrito = carrito[i];
            if(prod_carrito.id == prod.id){
                sw = 1;
                prod_carrito.cantidad = prod_carrito.cantidad + 1
            }
        }
        if(sw == 0){
            let producto = {id: prod.id, nombre: prod.nombre, precio: prod.precio, cantidad: 1};
            carrito.push(producto);
        }

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
            total += parseFloat(element.precio * element.cantidad);
        }
        total = total.toFixed(2);
        document.getElementById("carrito").innerHTML = html;
        document.getElementById("total").innerHTML = total;
    }

    function quitarCarrito(posicion) {
        carrito.splice(posicion, 1);
        actualizarCarrito();
    }

    async function buscarCliente() {
        document.getElementById("buscar").innerHTML = "Buscando...";
        let valor = document.getElementById("valor").value;
        let {data} = await axios.get("/api/admin/buscar_cliente?valor="+valor);
        if (Object.keys(data).length === 0) {
            document.getElementById("cliente").innerHTML = "";
            document.getElementById("buscar").innerHTML = "Cliente NO ENCONTRADO";
        } else {
            cliente_id = data.id;
            document.getElementById("cliente").innerHTML = data.ci;
            document.getElementById("buscar").innerHTML = "ENCONTRADO";
        }
    }

    async function guardarCliente() {
        nombre = document.getElementById("nombre").value;
        apellido = document.getElementById("apellido").value;
        ci = document.getElementById("ci").value;
        nit = document.getElementById("nit").value;
        telefono = document.getElementById("telefono").value;
        correo = document.getElementById("correo").value;

        let datos_cliente = {
            nombre: nombre,
            apellido: apellido,
            ci: ci,
            nit: nit,
            telefono: telefono,
            correo: correo
        }
        const {data} = await axios.post("/api/admin/cliente", datos_cliente);
        console.log(data);
        document.getElementById("cliente").innerHTML = data.cliente.ci;
        document.getElementById("buscar").innerHTML = data.mensaje;
        cliente_id = data.cliente.id;
    }

    async function realizarPedido(){
        let personal_id = document.getElementById("personal_id").value;
        let datos = {
            productos: carrito,
            cliente_id: cliente_id,
            user_id: personal_id
        }
        const {data} = await axios.post("/api/admin/pedido", datos);
        console.log(data);
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
                    <input type="hidden" id="personal_id" value="{{ Auth::user()->id }}">
                    <table id="tableProducts" class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
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
                    <table class="table">
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
                    <table class="table">
                        <tr>
                            <td>
                                <div class="form-group">
                                    <h5>CI: <span id="cliente"></span></h5>
                                    <strong><span id="buscar"></span></strong>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="form-group">
                                    <label>Buscar CI</label>
                                    <input type="text" id="valor" class="form-control" placeholder="CI" onkeyup="buscarCliente()">
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <!-- Button trigger modal -->
                                <button type="button" class="btn btn-warning btn-block" data-toggle="modal" data-target="#nuevoCliente">
                                  Nuevo cliente
                                </button>

                                <!-- Modal -->
                                <div class="modal fade" id="nuevoCliente" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title">Crear nuevo cliente</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="nombre">Nombre:</label>
                                                            <input type="text" id="nombre" class="form-control" placeholder="Nombre">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="apellido">Apellido:</label>
                                                            <input type="text" id="apellido" class="form-control" placeholder="Apellido">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="ci">CI:</label>
                                                            <input type="text" id="ci" class="form-control" placeholder="CI">
                                                        </div>
                                                    </div>
                                                    <div class="col-6">
                                                        <div class="form-group">
                                                            <label for="nit">NIT:</label>
                                                            <input type="text" id="nit" class="form-control" placeholder="NIT">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="telefono">Teléfono:</label>
                                                    <input type="text" id="telefono" class="form-control" placeholder="Teléfono">
                                                </div>
                                                <div class="form-group">
                                                    <label for="correo">Correo:</label>
                                                    <input type="text" id="correo" class="form-control" placeholder="Correo">
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button type="button" class="btn btn-primary" data-dismiss="modal" onclick="guardarCliente()">Guardar cliente</button>
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
