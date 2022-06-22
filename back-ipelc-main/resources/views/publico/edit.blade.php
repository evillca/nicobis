@extends('adminlte::page')

@section('template_title')
    Update Publico
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Update Publico</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('publicos.update', $publico->id_publico) }}"  role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf

                            @include('publico.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
