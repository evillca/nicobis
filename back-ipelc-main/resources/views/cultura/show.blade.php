@extends('adminlte::page')

@section('template_title')
    {{ $cultura->nombre_cultura ?? 'Show Cultura' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Cultura</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('culturas.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Slug Cultura:</strong>
                            {{ $cultura->slug_cultura }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Cultura:</strong>
                            {{ $cultura->nombre_cultura }}
                        </div>
                        <div class="form-group">
                            <strong>Descripcion Cultura:</strong>
                            {{ $cultura->descripcion_cultura }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
