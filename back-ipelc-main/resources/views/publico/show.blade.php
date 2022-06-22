@extends('adminlte::page')

@section('template_title')
    {{ $publico->nombre_publico ?? 'Show Publico' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Publico</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('publicos.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Publico:</strong>
                            {{ $publico->id_publico }}
                        </div>
                        <div class="form-group">
                            <strong>Slug Publico:</strong>
                            {{ $publico->slug_publico }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Publico:</strong>
                            {{ $publico->nombre_publico }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion Publico:</strong>
                            {{ $publico->descripcion_publico }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
