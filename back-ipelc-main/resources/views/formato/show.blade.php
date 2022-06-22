@extends('adminlte::page')

@section('template_title')
    {{ $formato->nombre_formato ?? 'Show Formato' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Formato</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('formatos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Formato:</strong>
                            {{ $formato->id_formato }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Formato:</strong>
                            {{ $formato->nombre_formato }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion Formato:</strong>
                            {{ $formato->descripcion_formato }}
                        </div>
                        <div class="form-group">
                            <strong>Extension Formato:</strong>
                            {{ $formato->extension_formato }}
                        </div>
                        {{-- <div class="form-group">
                            <strong>Usuario:</strong>
                            {{ $formato->usuario }}
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
