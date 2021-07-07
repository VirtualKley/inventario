@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @include('partials.session-status')
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between items-align-center">
        <h1>Listado de productos</h1>
        <a href="{{ route('products.create') }}" class="btn btn-primary">Adicionar</a>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="table-responsive-lg">
            <table class="table">
                <thead class="thead-dark">
                <tr style="text-align: center">
                    <th scope="col">#</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Modelo</th>
                    <th scope="col">Color</th>
                    <th scope="col">Precio compra</th>
                    <th scope="col">Precio venta</th>
                    <th scope="col">Stock</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                    @forelse($products as $product)
                        <tr style="text-align: center">
                            <th scope="row">{{ $product->id }}</th>
                            <td>{{ $product->nombre }}</td>
                            <td>{{ $product->model->nombre }}</td>
                            <td>{{ $product->color->nombre }}</td>
                            <td>{{ $product->precio_compra }}</td>
                            <td>{{ $product->precio_venta }}</td>
                            <td>{{ $product->stock }}</td>
                            <td>
                                <a href="{{ route('products.edit', $product) }}"><i class="fas fa-edit"></i></a>
                                <a href="#" onclick="showModal({{$product}})" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash"></i></a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" style="text-align: center">No existen registros</td>
                        </tr>
                    @endforelse

                </tbody>
            </table>
        </div>
    </div>
@include('partials.modal-delete')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        function showModal(product){
            document.getElementById('Name').innerHTML = product.nombre;
            document.getElementById('deleteForm').action = "{{ route('products.store') }}/" + product.id;
        }
    </script>
@stop
