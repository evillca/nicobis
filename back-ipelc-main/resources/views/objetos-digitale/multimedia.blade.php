@extends('adminlte::page')

@section('template_title')
    Update Objetos Digitale
@endsection

@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">
                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Multimedia: {{ $objetosDigitale->titulo }}</span>
                        <div class="float-right">
                            <a class="btn btn-primary" href="{{ route('objetos-digitales.index') }}"> Back</a>
                        </div>
                    </div>

                    <div class="card-body">

                        <form method="POST" action="{{ route('uploadFilePortada', $objetosDigitale->id_objeto_digital) }}"
                            role="form" enctype="multipart/form-data">
                            {{ method_field('PATCH') }}
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {{ Form::label('ruta_portada_objeto_digital') }}<br>
                                        {{-- {{ Form::text('ruta_portada_objeto_digital', $objetosDigitale->ruta_portada_objeto_digital, ['class' => 'form-control' . ($errors->has('ruta_portada_objeto_digital') ? ' is-invalid' : ''), 'placeholder' => 'Portada Objeto Digital']) }} --}}
                                        {{ Form::file('ruta_portada_objeto_digital') }}
                                        {!! $errors->first('ruta_portada_objeto_digital', '<div class="invalid-feedback">:message</p></div>') !!}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    @if($objetosDigitale->ruta_portada_objeto_digital)
                                        {{ Html::image($objetosDigitale->ruta_portada_objeto_digital,'Portada', array( 'width' => 70, 'height' => 70 )) }}
                                        <a href="{{ route('deleteFileObjetos', $objetosDigitale->id_objeto_digital) }}" class="btn btn-danger">Eliminar</a>   
                                    @endif
                                    
                                    
                                </div>
                            </div>
                            <div class="box-footer mt20">
                                <button type="submit" class="btn btn-primary">Subir</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
