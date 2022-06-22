<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('slug_forma') }}
            {{ Form::text('slug_forma', $forma->slug_forma, ['class' => 'form-control' . ($errors->has('slug_forma') ? ' is-invalid' : ''), 'placeholder' => 'Slug Forma']) }}
            {!! $errors->first('slug_forma', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nombre_forma') }}
            {{ Form::text('nombre_forma', $forma->nombre_forma, ['class' => 'form-control' . ($errors->has('nombre_forma') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Forma']) }}
            {!! $errors->first('nombre_forma', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('descripcion_forma') }}
            {{ Form::text('descripcion_forma', $forma->descripcion_forma, ['class' => 'form-control' . ($errors->has('descripcion_forma') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion Forma']) }}
            {!! $errors->first('descripcion_forma', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        {{-- <div class="form-group">
            {{ Form::label('id_categoria') }}
            {{ Form::text('id_categoria', $forma->id_categoria, ['class' => 'form-control' . ($errors->has('id_categoria') ? ' is-invalid' : ''), 'placeholder' => 'Id Categoria']) }}
            {!! $errors->first('id_categoria', '<div class="invalid-feedback">:message</p>') !!}
        </div> --}}

        <div class="form-group">
            {{ Form::label('categorias') }}
            {{-- {{ Form::select('id_categoria', $categorias ,$forma->id_categoria, ['class' => 'form-control' . ($errors->has('id_categoria') ? ' is-invalid' : ''), 'placeholder' => 'Seleccionar']) }} --}}
            {{ Form::select('id_categoria', $categoria_options, old('id_categoria', $forma->id_categoria), ['class'=>"form-control", 'id'=>"id_categoria", 'required' => 'required'], $categoria_attributes) }}
            {!! $errors->first('id_categoria', '<div class="invalid-feedback">:message</p>') !!}

                
        </div>
        

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>