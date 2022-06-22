@extends('adminlte::page')

@section('template_title')
    {{ $forma->nombre_forma ?? 'Show Forma' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Forma</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('formas.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Forma:</strong>
                            {{ $forma->id_forma }}
                        </div>
                        <div class="form-group">
                            <strong>Slug Forma:</strong>
                            {{ $forma->slug_forma }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Forma:</strong>
                            {{ $forma->nombre_forma }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion Forma:</strong>
                            {{ $forma->descripcion_forma }}
                        </div>
                        <div class="form-group">
                            <strong>Id Categoria:</strong>
                            {{ $forma->nombre_categoria }}
                        </div>
                        {{-- <div class="form-group">
                            <strong>Usuario:</strong>
                            {{ $forma->usuario }}
                        </div> --}}

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
