<div class="box box-info padding-1">
    <div class="box-body">
        
        {{--  <div class="form-group">
            {{ Form::label('id_cultura') }}
            {{ Form::text('id_cultura', $cultura->id_cultura, ['class' => 'form-control' . ($errors->has('id_cultura') ? ' is-invalid' : ''), 'placeholder' => 'Id Cultura']) }}
            {!! $errors->first('id_cultura', '<div class="invalid-feedback">:message</p>') !!}
        </div>  --}}
        <div class="form-group">
            {{ Form::label('slug_cultura') }}
            {{ Form::text('slug_cultura', $cultura->slug_cultura, ['class' => 'form-control' . ($errors->has('slug_cultura') ? ' is-invalid' : ''), 'placeholder' => 'Slug Cultura']) }}
            {!! $errors->first('slug_cultura', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nombre_cultura') }}
            {{ Form::text('nombre_cultura', $cultura->nombre_cultura, ['class' => 'form-control' . ($errors->has('nombre_cultura') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Cultura']) }}
            {!! $errors->first('nombre_cultura', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('descripcion_cultura') }}
            {{ Form::text('descripcion_cultura', $cultura->descripcion_cultura, ['class' => 'form-control' . ($errors->has('descripcion_cultura') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion Cultura']) }}
            {!! $errors->first('descripcion_cultura', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        @if ($cultura->ruta_imagen_listado_cultura == '')
            <div class="form-group">
                {{ Form::label('ruta_imagen_listado_cultura') }}<br>                
                {{ Form::file('ruta_imagen_listado_cultura', ['id' => 'ruta_imagen_listado_cultura']) }}
                {!! $errors->first('ruta_imagen_listado_cultura', '<div class="invalid-feedback">:message</p></div>') !!}
                <div id="preview1"> </div>
            </div>
        @else
            {{ Html::image($cultura->ruta_imagen_listado_cultura, 'Portada', ['height' => 150]) }}
            <a href="{{ route('deleteFileCulturaListado', $cultura->id_cultura) }}"
                class="btn btn-danger">Eliminar</a>

        @endif


        @if ($cultura->ruta_imagen_home_cultura == '')
            <div class="form-group">
                {{ Form::label('ruta_imagen_home_cultura') }}<br>                
                {{ Form::file('ruta_imagen_home_cultura', ['id' => 'ruta_imagen_home_cultura']) }}
                {!! $errors->first('ruta_imagen_home_cultura', '<div class="invalid-feedback">:message</p></div>') !!}
                <div id="preview2"> </div>
            </div>
        @else
            {{ Html::image($cultura->ruta_imagen_home_cultura, 'Portada', ['height' => 150]) }}
            <a href="{{ route('deleteFileCulturaHome', $cultura->id_cultura) }}"
                class="btn btn-danger">Eliminar</a>

        @endif

    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>

@section('js') 
<!-- JavaScript Bundle with Popper -->
<script type="text/javascript">
    $(function () {
        function readURL1(input) {
            if (input.files && input.files[0]) {
                var i;
                for (i = 0; i < input.files.length; ++i) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview1').append('<img src="' + e.target.result + '" width="150">');
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        }

        function readURL2(input) {
            if (input.files && input.files[0]) {
                var i;
                for (i = 0; i < input.files.length; ++i) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview2').append('<img src="' + e.target.result + '" width="150">');
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        }

        $("#ruta_imagen_listado_cultura").change(function() {
            readURL1(this);
        });

        $("#ruta_imagen_home_cultura").change(function() {
            readURL2(this);
        });


    })
</script>

@stop