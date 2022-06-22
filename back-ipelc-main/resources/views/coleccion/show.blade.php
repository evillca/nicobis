@extends('adminlte::page')

@section('template_title')
    {{ $coleccion->nombre_coleccion ?? 'Show Coleccione' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Coleccion</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('colecciones.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Coleccion:</strong>
                            {{ $coleccion->id_coleccion }}
                        </div>
                        <div class="form-group">
                            <strong>Slug Coleccion:</strong>
                            {{ $coleccion->slug_coleccion }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Coleccion:</strong>
                            {{ $coleccion->nombre_coleccion }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion Coleccion:</strong>
                            {{ $coleccion->descripcion_coleccion }}
                        </div>
                        <div class="form-group">
                            <strong>Titulo Coleccion:</strong>
                            {{ $coleccion->titulo_coleccion }}
                        </div>
                        <div class="form-group">
                            <strong>Subtitulo Coleccion:</strong>
                            {{ $coleccion->subtitulo_coleccion }}
                        </div>
                        <div class="form-group">
                            <strong>Es Principal Coleccion:</strong>
                            {{ ($coleccion->es_principal_coleccion==1?'Importante':'No importante') }}
                        </div>
                        <div class="form-group">
                            <strong>Objetos:</strong>
                            @foreach ($coleccionSelecc as $selec)
                            <br> - {{$selec}}
                            @endforeach
                        </div>
                        {{-- <div class="form-group">
                            <strong>Usuario:</strong>
                            {{ $coleccion->usuario }}
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
