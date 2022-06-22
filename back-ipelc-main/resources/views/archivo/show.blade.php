@extends('adminlte::page')

@section('template_title')
    {{ $archivo->name ?? 'Show Archivo' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Archivo</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('archivos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Archivo:</strong>
                            {{ $archivo->id_archivo }}
                        </div>
                        <div class="form-group">
                            <strong>Ruta Archivo:</strong>
                            {{ $archivo->ruta_archivo }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Archivo:</strong>
                            {{ $archivo->nombre_archivo }}
                        </div>
                        <div class="form-group">
                            <strong>Id Objeto Digital:</strong>
                            {{ $archivo->id_objeto_digital }}
                        </div>
                        <div class="form-group">
                            <strong>Id Forma:</strong>
                            {{ $archivo->id_forma }}
                        </div>
                        <div class="form-group">
                            <strong>Id Formato:</strong>
                            {{ $archivo->id_formato }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
