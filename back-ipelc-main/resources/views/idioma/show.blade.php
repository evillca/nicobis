@extends('adminlte::page')

@section('template_title')
    {{ $idioma->nombre_idioma ?? 'Show Idioma' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Idioma</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('idiomas.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Idioma:</strong>
                            {{ $idioma->id_idioma }}
                        </div>
                        <div class="form-group">
                            <strong>Slug Idioma:</strong>
                            {{ $idioma->slug_idioma }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Idioma:</strong>
                            {{ $idioma->nombre_idioma }}
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
