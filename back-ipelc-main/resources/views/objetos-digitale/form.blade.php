@if ($message = Session::get('success'))
<div class="alert alert-success alert-dismissible fade show">
    <p>{{ $message }}</p>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
</div>
@endif
    <form method="POST" action="{{ route('objetos-digitales.'.$accion, $objetosDigitale->id_objeto_digital) }}"
        role="form" enctype="multipart/form-data">
        @if($accion == 'update')
            {{ method_field('PATCH') }}
        @endif
        @csrf
        <div class="row">
            <div class="col-8">
                <div class="form-group">
                    {{ Form::label('slug_objeto_digital') }}
                    {{ Form::text('slug_objeto_digital', $objetosDigitale->slug_objeto_digital, ['class' => 'form-control' . ($errors->has('slug_objeto_digital') ? ' is-invalid' : ''), 'placeholder' => 'Slug Objeto Digital']) }}
                    {!! $errors->first('slug_objeto_digital', '<div class="invalid-feedback">:message</p></div>') !!}
                </div>
                <div class="form-group">
                    {{ Form::label('titulo') }}
                    {{ Form::text('titulo', $objetosDigitale->titulo, ['class' => 'form-control' . ($errors->has('titulo') ? ' is-invalid' : ''), 'placeholder' => 'Titulo']) }}
                    {!! $errors->first('titulo', '<div class="invalid-feedback">:message</p></div>') !!}
                </div>
            </div>
            <div class="col-4">
                @if ($objetosDigitale->ruta_portada_objeto_digital == '')
                    <div class="form-group">
                        {{ Form::label('ruta_portada_objeto_digital') }}<br>
                        {{-- {{ Form::text('ruta_portada_objeto_digital', $objetosDigitale->ruta_portada_objeto_digital, ['class' => 'form-control' . ($errors->has('ruta_portada_objeto_digital') ? ' is-invalid' : ''), 'placeholder' => 'Portada Objeto Digital']) }} --}}
                        {{ Form::file('ruta_portada_objeto_digital', ['id' => 'ruta_portada_objeto_digital']) }}
                        {!! $errors->first('ruta_portada_objeto_digital', '<div class="invalid-feedback">:message</p></div>') !!}
                        <div id="preview"> </div>
                    </div>
                @else
                    {{ Html::image($objetosDigitale->ruta_portada_objeto_digital, 'Portada', ['height' => 150]) }}
                    <a href="{{ route('deleteFileObjetos', $objetosDigitale->id_objeto_digital) }}"
                        class="btn btn-danger">Eliminar</a>

                @endif

            </div>

        </div>
        <div class="row">
            <div class="col-12">
                <!-- input states -->
                <div class="form-group">
                    {{ Form::label('resumen') }}
                    {{ Form::textarea('resumen', $objetosDigitale->resumen, ['class' => 'form-control' . ($errors->has('resumen') ? ' is-invalid' : ''), 'placeholder' => 'Resumen', 'rows' => '2']) }}
                    {!! $errors->first('resumen', '<div class="invalid-feedback">:message</p></div>') !!}
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    {{ Form::label('año') }}
                    {{ Form::number('año', $objetosDigitale->año, ['class' => 'form-control' . ($errors->has('año') ? ' is-invalid' : ''), 'placeholder' => 'Año']) }}
                    {!! $errors->first('año', '<div class="invalid-feedback">:message</p></div>') !!}
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    {{ Form::label('fecha') }}
                    {{-- {{ Form::text('fecha', $objetosDigitale->fecha, ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }} --}}
                    {{ Form::date('fecha', $objetosDigitale->fecha ? date('Y-m-d', strtotime($objetosDigitale->fecha)) : '', ['class' => 'form-control' . ($errors->has('fecha') ? ' is-invalid' : ''), 'placeholder' => 'Fecha']) }}
                    {!! $errors->first('fecha', '<div class="invalid-feedback">:message</p></div>') !!}
                </div>
            </div>
            <div class="col-4">
                <div class="form-group">
                    {{ Form::label('licencia_objeto_digital') }}
                    {{ Form::text('licencia_objeto_digital', $objetosDigitale->licencia_objeto_digital, ['class' => 'form-control' . ($errors->has('licencia_objeto_digital') ? ' is-invalid' : ''), 'placeholder' => 'Licencia Objeto Digital']) }}
                    {!! $errors->first('licencia_objeto_digital', '<div class="invalid-feedback">:message</p></div>') !!}
                </div>
            </div>
            {{-- <div class="form-group">
                {{ Form::label('atributos') }}
                {{ Form::text('atributos', $objetosDigitale->atributos, ['class' => 'form-control' . ($errors->has('atributos') ? ' is-invalid' : ''), 'placeholder' => 'Atributos']) }}
                {!! $errors->first('atributos', '<div class="invalid-feedback">:message</p></div>') !!}
            </div> --}}
            <div class="col-6">
                <div class="form-group">
                    {{ Form::label('culturas') }}
                    {{-- $objetosDigitale->dogs->lists('id') --}}
                    {{ Form::select('culturas[]', $culturas_options, old('culturas[]', $culturaObjetoSelecc), ['id' => 'culturas', 'multiple' => 'multiple', 'style' => 'width: 100%;', 'class' => 'select2'], $culturas_attributes) }}
                    {!! $errors->first('culturas', '<div class="invalid-feedback">:message</p></div>') !!}
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    {{ Form::label('publicos') }}
                    {{-- $objetosDigitale->dogs->lists('id') --}}
                    {{ Form::select('publicos[]', $publicos_options, old('publicos[]', $publicoObjetoSelecc), ['id' => 'publicos', 'multiple' => 'multiple', 'style' => 'width: 100%;', 'class' => 'select2'], $publicos_attributes) }}
                    {!! $errors->first('publicos', '<div class="invalid-feedback">:message</p></div>') !!}
                </div>
            </div>
            {{--  <div class="col-6">
                <div class="form-group">
                    {{ Form::label('colecciones') }}
                    {{ Form::select('colecciones[]', $colecciones_options, old('colecciones[]', $coleccionObjetoSelecc), ['id' => 'colecciones', 'multiple' => 'multiple', 'style' => 'width: 100%;', 'class' => 'select2'], $colecciones_attributes) }}
                    {!! $errors->first('colecciones', '<div class="invalid-feedback">:message</p></div>') !!}
                </div>
            </div>  --}}
            <div class="col-12">
                <div class="form-group">
                    {{ Form::label('idiomas') }}
                    {{-- $objetosDigitale->dogs->lists('id') --}}
                    {{ Form::select('idiomas[]', $idiomas_options, old('idiomas[]', $idiomaObjetoSelecc), ['id' => 'idiomas', 'multiple' => 'multiple', 'style' => 'width: 100%;', 'class' => 'select2'], $idiomas_attributes) }}
                    {!! $errors->first('idiomas', '<div class="invalid-feedback">:message</p></div>') !!}
                </div>
            </div>

            <div class="col-12 text-center">
                <button type="submit" class="btn btn-primary">Guardar</button>
            </div>
        </div>
    </form><br><br>

    @if ($objetosDigitale->id_objeto_digital)
        
        @include('objetos-digitale.atributos')
        
        @include('objetos-digitale.archivos')
        
    @endif
