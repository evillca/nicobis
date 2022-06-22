@extends('adminlte::page')

@section('template_title')
    Update Coleccion
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Coleccion</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('colecciones.update', $coleccion->id_coleccion) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('coleccion.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
