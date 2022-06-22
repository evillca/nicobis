@extends('adminlte::page')

@section('template_title')
    {{ $objetosDigitale->titulo ?? 'Show Objetos Digitales' }}
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <div class="float-left">
                            <span class="card-title">Show Objetos Digitales</span>
                        </div>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('objetos-digitales.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">
                        
                        <div class="form-group">
                            <strong>Id Objeto Digital:</strong>
                            {{ $objetosDigitale->id_objeto_digital }}
                        </div>
                        <div class="form-group">
                            <strong>Slug Objeto Digital:</strong>
                            {{ $objetosDigitale->slug_objeto_digital }}
                        </div>
                        <div class="form-group">
                            <strong>Titulo:</strong>
                            {{ $objetosDigitale->titulo }}
                        </div>
                        <div class="form-group">
                            <strong>Resumen:</strong>
                            {{ $objetosDigitale->resumen }}
                        </div>
                        <div class="form-group">
                            <strong>Portada Objeto Digital:</strong>
                            {{ $objetosDigitale->ruta_portada_objeto_digital }}
                        </div>
                        <div class="form-group">
                            <strong>Año:</strong>
                            {{ $objetosDigitale->año }}
                        </div>
                        <div class="form-group">
                            <strong>Fecha:</strong>
                            {{ $objetosDigitale->fecha }}
                        </div>
                        <div class="form-group">
                            <strong>Licencia Objeto Digital:</strong>
                            {{ $objetosDigitale->licencia_objeto_digital }}
                        </div>
                        <div class="form-group">
                            <strong>Atributos:</strong>
                            {{ $objetosDigitale->atributos }}
                        </div>

                        <div class="form-group">
                            <strong>Culturas:</strong>
                            @foreach ($culturasSelecc as $selec)
                                {{$selec.'| '}}
                            @endforeach
                        </div>

                        <div class="form-group">
                            <strong>Publicos:</strong>
                            @foreach ($publicosSelecc as $selec)
                                {{$selec.'| '}}
                            @endforeach
                        </div>

                        <div class="form-group">
                            <strong>Idiomas:</strong>
                            @foreach ($idiomasSelecc as $selec)
                                {{$selec.'| '}}
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
