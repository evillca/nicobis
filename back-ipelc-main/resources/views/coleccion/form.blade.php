@section('css')    
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet">
@stop
<div class="box box-info padding-1">
    <div class="box-body">

        {{-- <div class="form-group">
            {{ Form::label('id_coleccion') }}
            {{ Form::text('id_coleccion', $coleccione->id_coleccion, ['class' => 'form-control' . ($errors->has('id_coleccion') ? ' is-invalid' : ''), 'placeholder' => 'Id Coleccion']) }}
            {!! $errors->first('id_coleccion', '<div class="invalid-feedback">:message</p>') !!}
        </div> --}}
        <div class="form-group">
            {{ Form::label('slug_coleccion') }}
            {{ Form::text('slug_coleccion', $coleccion->slug_coleccion, ['class' => 'form-control' . ($errors->has('slug_coleccion') ? ' is-invalid' : ''), 'placeholder' => 'Slug Coleccion']) }}
            {!! $errors->first('slug_coleccion', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nombre_coleccion') }}
            {{ Form::text('nombre_coleccion', $coleccion->nombre_coleccion, ['class' => 'form-control' . ($errors->has('nombre_coleccion') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Coleccion']) }}
            {!! $errors->first('nombre_coleccion', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('descripcion_coleccion') }}
            {{ Form::text('descripcion_coleccion', $coleccion->descripcion_coleccion, ['class' => 'form-control' . ($errors->has('descripcion_coleccion') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion Coleccion']) }}
            {!! $errors->first('descripcion_coleccion', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('titulo_coleccion') }}
            {{ Form::text('titulo_coleccion', $coleccion->titulo_coleccion, ['class' => 'form-control' . ($errors->has('titulo_coleccion') ? ' is-invalid' : ''), 'placeholder' => 'Titulo Coleccion']) }}
            {!! $errors->first('titulo_coleccion', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('subtitulo_coleccion') }}
            {{ Form::text('subtitulo_coleccion', $coleccion->subtitulo_coleccion, ['class' => 'form-control' . ($errors->has('subtitulo_coleccion') ? ' is-invalid' : ''), 'placeholder' => 'Subtitulo Coleccion']) }}
            {!! $errors->first('subtitulo_coleccion', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        {{-- <div class="form-group">
            {{ Form::label('es_principal_coleccion') }}
            {{ Form::text('es_principal_coleccion', $coleccion->es_principal_coleccion, ['class' => 'form-control' . ($errors->has('es_principal_coleccion') ? ' is-invalid' : ''), 'placeholder' => 'Es Principal Coleccion']) }}
            {!! $errors->first('es_principal_coleccion', '<div class="invalid-feedback">:message</p>') !!}
        </div> --}}

        <div class="form-group">
            {{ Form::label('objetos') }}
            {{-- $objetosDigitale->dogs->lists('id') --}}
            {{ Form::select('objetos[]', $objetos_options, old('objetos[]', $objetosSelecc), ['id' => 'objetos', 'multiple' => 'multiple', 'style' => 'width: 100%;', 'class' => 'select2'], $objetos_attributes) }}
            {!! $errors->first('objetos', '<div class="invalid-feedback">:message</p></div>') !!}
        </div>


        <div class="form-group">
            {{ Form::label('Es principal la colección?') }}<br>
            <label class="radio inline">
                {!! Form::radio('es_principal_coleccion', 1, $coleccion->es_principal_coleccion == 1 ? 1 : 0) !!}
                Si
            </label>
            <label class="radio inline">
                {!! Form::radio('es_principal_coleccion', 0, $coleccion->es_principal_coleccion == 0 ? 1 : 0) !!}
                No
            </label>
            {!! $errors->first('es_principal_coleccion', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        {{-- <div class="form-group">
            {{ Form::label('usuario') }}
            {{ Form::text('usuario', $coleccione->usuario, ['class' => 'form-control' . ($errors->has('usuario') ? ' is-invalid' : ''), 'placeholder' => 'Usuario']) }}
            {!! $errors->first('usuario', '<div class="invalid-feedback">:message</p>') !!}
        </div> --}}

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>
@section('js')    
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script type="text/javascript"> 
            //Initialize Select2 Elements
            $('.select2').select2();            
    </script>

@stop
