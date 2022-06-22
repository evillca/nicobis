@extends('adminlte::page')

@section('template_title')
    Update Archivo
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Archivo</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('archivos.update', $archivo->id_archivo) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('archivo.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
