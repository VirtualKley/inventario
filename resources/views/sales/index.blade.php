@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @include('partials.session-status')
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-between items-align-center">
        <h1>Listado de ventas</h1>
        <a href="{{ route('sales.create') }}" class="btn btn-primary">Adicionar</a>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="table-responsive-lg">
            <table class="table">
                <thead class="thead-dark">
                <tr style="text-align: center">
                    <th scope="col">#</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Total</th>
                    <th scope="col">Usuario Registrador</th>
                    <th scope="col"></th>
                </tr>
                </thead>
                <tbody>
                    @forelse($sales as $sale)
                        <tr style="text-align: center">
                            <th scope="row">{{ $sale->id }}</th>
                            <td>{{ $sale->created_at->format('d/m/Y') }}</td>
                            <td>{{ $sale->total }}</td>
                            <td>{{ $sale->user->name }}</td>
                            <td>
                                {{-- <a href="{{ route('sales.edit', $sale) }}"><i class="fas fa-edit"></i></a> --}}
                                <a href="{{ route('sales.show', $sale) }}"><i class="fas fa-eye"></i></a>
                                {{-- <a href="#" onclick="showModal({{$sale}})" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash"></i></a> --}}
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
        function showModal(sale){
            document.getElementById('Name').innerHTML = sale.nombre;
            document.getElementById('deleteForm').action = "{{ route('sales.store') }}/" + sale.id;
        }
    </script>
@stop
