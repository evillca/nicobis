@extends('adminlte::page')

@section('template_title')
    Create Publico
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Publico</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('publicos.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf

                            @include('publico.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
