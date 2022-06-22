<div class="box box-info padding-1">
    <div class="box-body">
        
        {{--  <div class="form-group">
            {{ Form::label('id_idioma') }}
            {{ Form::text('id_idioma', $idioma->id_idioma, ['class' => 'form-control' . ($errors->has('id_idioma') ? ' is-invalid' : ''), 'placeholder' => 'Id Idioma']) }}
            {!! $errors->first('id_idioma', '<div class="invalid-feedback">:message</p>') !!}
        </div>  --}}
        <div class="form-group">
            {{ Form::label('slug_idioma') }}
            {{ Form::text('slug_idioma', $idioma->slug_idioma, ['class' => 'form-control' . ($errors->has('slug_idioma') ? ' is-invalid' : ''), 'placeholder' => 'Slug Idioma']) }}
            {!! $errors->first('slug_idioma', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nombre_idioma') }}
            {{ Form::text('nombre_idioma', $idioma->nombre_idioma, ['class' => 'form-control' . ($errors->has('nombre_idioma') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Idioma']) }}
            {!! $errors->first('nombre_idioma', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        {{--  <div class="form-group">
            {{ Form::label('usuario') }}
            {{ Form::text('usuario', $idioma->usuario, ['class' => 'form-control' . ($errors->has('usuario') ? ' is-invalid' : ''), 'placeholder' => 'Usuario']) }}
            {!! $errors->first('usuario', '<div class="invalid-feedback">:message</p>') !!}
        </div>  --}}

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>