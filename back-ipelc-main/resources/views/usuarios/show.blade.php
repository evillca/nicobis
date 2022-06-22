@extends('adminlte::page')

@section('template_title')
    {{ $usuario->name ?? 'Show User' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Usuarios</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('usuarios.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id User:</strong>
                            {{ $usuario->id }}
                        </div>
                        <div class="form-group">
                            <strong>Name:</strong>
                            {{ $usuario->name }}
                        </div>
                        <div class="form-group">
                            <strong>Email:</strong>
                            {{ $usuario->email }}
                        </div>
                       
                        <div class="form-group">
                            <strong>Menús Asignados:</strong>
                            @foreach ($menusSelecc as $selec)
                                {{$selec.'| '}}
                            @endforeach
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
