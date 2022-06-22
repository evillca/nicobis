@extends('adminlte::page')

@section('template_title')
    {{ $categoria->name ?? 'Show Categoria' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Categoria</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('categorias.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Categoria:</strong>
                            {{ $categoria->id_categoria }}
                        </div>
                        <div class="form-group">
                            <strong>Slug Categoria:</strong>
                            {{ $categoria->slug_categoria }}
                        </div>
                        <div class="form-group">
                            <strong>Nombre Categoria:</strong>
                            {{ $categoria->nombre_categoria }}
                        </div>
                        <div class="form-group">
                            <strong>Usuario:</strong>
                            {{ $categoria->usuario }}
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
