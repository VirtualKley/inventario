@extends('adminlte::page')

@section('title', 'Modelos')

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-2">Modelos para productos</h1>
        <a href="#" onclick="restartForm()" class="btn btn-primary">Adicionar</a>
    </div>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                @include('partials.session-status')
            </div>
            <div class="col-lg-6">
                @include('partials.validation-errors')
                <form class="border border-primary m-2 p-4" id="colorForm"
                action="{{ route('models.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label for="nombre">Nombre</label>
                      <input name="nombre" type="text" class="form-control" id="nombre" placeholder="Ingrese un modelo">
                    </div>
                    <button id="buttonsend" type="submit" class="btn btn-primary">Guardar</button>
                  </form>
            </div>
            <div class="col-lg-6">
                <table class="table">
                    <thead class="thead-dark">
                      <tr style="text-align: center">
                        <th scope="col">#</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Acciones</th>
                      </tr>
                    </thead>
                    <tbody>
                        @forelse ( $models as $model)
                            <tr style="text-align: center">
                                <th scope="row">{{ $model->id }}</th>
                                <td>{{ $model->nombre }}</td>
                                <td>
                                    <a href="#" onclick="configForm({{$model}})"><i class="fas fa-edit"></i></a>
                                    <a href="#" onclick="showModal({{$model}})" data-toggle="modal" data-target="#exampleModal"><i class="fas fa-trash"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td>No existen modelos registrados</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $models->links() }}
            </div>
        </div>
    </div>
@include('partials.modal-delete')
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        function configForm(color){
            document.getElementById('nombre').value = color.nombre;
            document.getElementById('colorForm').action = "{{ route('models.store') }}/" + color.id;
            var x = document.createElement('INPUT');
            x.setAttribute('id', 'editControl');
            x.setAttribute('type', 'hidden');
            x.setAttribute('name', '_method');
            x.setAttribute('value', 'PATCH');
            document.getElementById('colorForm').appendChild(x);
        }

        function restartForm(){
            document.getElementById('nombre').value = '';
            document.getElementById('colorForm').action = "{{ route('models.store') }}";
            document.getElementById('editControl').remove();
        }

        function showModal(color){
            document.getElementById('Name').innerHTML = color.nombre;
            document.getElementById('deleteForm').action = "{{ route('models.store') }}/" + color.id;
        }
    </script>
@stop
