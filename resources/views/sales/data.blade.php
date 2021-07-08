@extends('adminlte::page')

@section('title', 'Estadistica')

@section('plugins.Chartjs', true)

@section('content_header')
    <div class="d-flex justify-content-between align-items-center">
        <h1 class="mb-2">Datos de ventas</h1>
    </div>
@stop

@section('content')
    <div class="container">
        

        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Totales</h3>

                <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="card-body" style="display: block;">
                <div class="row">
                    <div class="col-md-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>${{ $tventa }}</h3>
                                <p>Ventas</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-cash-register"></i>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="small-box bg-success">
                            <div class="inner">
                                <h3>${{ $tcompra }}</h3>
                                <p>Compras</p>
                            </div>
                            <div class="icon">
                                <i class="fas fa-money-bill"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card card-primary collapsed-card">
              <div class="card-header">
                <h3 class="card-title">Semanales</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                        <div class="col-md-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>${{ $sventa }}</h3>
                                    <p>Ventas</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-cash-register"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>${{ $scompra }}</h3>
                                    <p>Compras</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-money-bill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
              </div>
              <!-- /.card-body -->
        </div>

        <div class="card card-primary collapsed-card">
              <div class="card-header">
                <h3 class="card-title">Anuales</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-plus"></i>
                  </button>
                </div>
                <!-- /.card-tools -->
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <div class="row">
                        <div class="col-md-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>${{ $aventa }}</h3>
                                    <p>Ventas</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-cash-register"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>${{ $acompra }}</h3>
                                    <p>Compras</p>
                                </div>
                                <div class="icon">
                                    <i class="fas fa-money-bill"></i>
                                </div>
                            </div>
                        </div>
                    </div>
              </div>
              <!-- /.card-body -->
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
