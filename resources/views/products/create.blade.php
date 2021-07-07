@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <div class="d-flex justify-content-between items-align-center">
        <h1>Ingreso de productos</h1>
        <a class="btn btn-primary" href="{{ route('products.index') }}">Regresar</a>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-10 col-lg-8 mx-auto">
                @include('partials.validation-errors')
                <form class="bg-white py-3 px-4 shadow rounded" action="{{ route('products.store') }}" method="POST">
                    @include('products.partials._form', [
                        'btnText' => 'Guardar'
                    ])
                </form>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>

    </script>
@stop
