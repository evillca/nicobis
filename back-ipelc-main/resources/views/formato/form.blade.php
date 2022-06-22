<div class="box box-info padding-1">
    <div class="box-body">
        
        {{-- <div class="form-group">
            {{ Form::label('id_formato') }}
            {{ Form::text('id_formato', $formato->id_formato, ['class' => 'form-control' . ($errors->has('id_formato') ? ' is-invalid' : ''), 'placeholder' => 'Id Formato']) }}
            {!! $errors->first('id_formato', '<div class="invalid-feedback">:message</p>') !!}
        </div> --}}
        <div class="form-group">
            {{ Form::label('nombre_formato') }}
            {{ Form::text('nombre_formato', $formato->nombre_formato, ['class' => 'form-control' . ($errors->has('nombre_formato') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Formato']) }}
            {!! $errors->first('nombre_formato', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('descripcion_formato') }}
            {{ Form::text('descripcion_formato', $formato->descripcion_formato, ['class' => 'form-control' . ($errors->has('descripcion_formato') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion Formato']) }}
            {!! $errors->first('descripcion_formato', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('extension_formato') }}
            {{ Form::text('extension_formato', $formato->extension_formato, ['class' => 'form-control' . ($errors->has('extension_formato') ? ' is-invalid' : ''), 'placeholder' => 'Extension Formato']) }}
            {!! $errors->first('extension_formato', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        {{-- <div class="form-group">
            {{ Form::label('usuario') }}
            {{ Form::text('usuario', $formato->usuario, ['class' => 'form-control' . ($errors->has('usuario') ? ' is-invalid' : ''), 'placeholder' => 'Usuario']) }}
            {!! $errors->first('usuario', '<div class="invalid-feedback">:message</p>') !!}
        </div> --}}

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>