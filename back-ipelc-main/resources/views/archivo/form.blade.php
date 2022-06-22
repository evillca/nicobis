
        
        {{--  <div class="form-group">
            {{ Form::label('id_archivo') }}
            {{ Form::text('id_archivo', $archivo->id_archivo, ['class' => 'form-control' . ($errors->has('id_archivo') ? ' is-invalid' : ''), 'placeholder' => 'Id Archivo']) }}
            {!! $errors->first('id_archivo', '<div class="invalid-feedback">:message</p>') !!}
        </div>  --}}
        {{-- <div class="form-group">
            {{ Form::label('ruta_archivo') }}
            {{ Form::text('ruta_archivo', $archivo->ruta_archivo, ['class' => 'form-control' . ($errors->has('ruta_archivo') ? ' is-invalid' : ''), 'placeholder' => 'Ruta Archivo']) }}
            {!! $errors->first('ruta_archivo', '<div class="invalid-feedback">:message</p>') !!}
        </div> --}}
        <div class="form-group">
            {{ Form::label('nombre_archivo') }}
            {{ Form::text('nombre_archivo', '', ['class' => 'form-control' . ($errors->has('nombre_archivo') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Archivo', 'required']) }}
            {!! $errors->first('nombre_archivo', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">            
            {{ Form::hidden('id_objeto_digital', $objetosDigitale->id_objeto_digital, ['class' => 'form-control' . ($errors->has('id_objeto_digital') ? ' is-invalid' : ''), 'placeholder' => 'Id Objeto Digital']) }}            
        </div>
        <div class="form-group">
            {{ Form::label('Forma') }}
            {{-- {{ Form::text('id_forma', $archivo->id_forma, ['class' => 'form-control' . ($errors->has('id_forma') ? ' is-invalid' : ''), 'placeholder' => 'Id Forma']) }} --}}
            {{ Form::select('id_forma', $formas_options, '', ['class'=>"form-control", 'id'=>"id_forma", 'required' => 'required'], $formas_attributes) }}
            {!! $errors->first('id_forma', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('Formato') }}
            {{-- {{ Form::text('id_formato', $archivo->id_formato, ['class' => 'form-control' . ($errors->has('id_formato') ? ' is-invalid' : ''), 'placeholder' => 'Id Formato']) }} --}}
            {{ Form::select('id_formato', $formatos_options, '', ['class'=>"form-control", 'id'=>"id_formato", 'required' => 'required'], $formatos_attributes) }}
            {!! $errors->first('id_formato', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        {{--  <div class="form-group">
            {{ Form::label('usuario') }}
            {{ Form::text('usuario', $archivo->usuario, ['class' => 'form-control' . ($errors->has('usuario') ? ' is-invalid' : ''), 'placeholder' => 'Usuario']) }}
            {!! $errors->first('usuario', '<div class="invalid-feedback">:message</p>') !!}
        </div>  --}}

