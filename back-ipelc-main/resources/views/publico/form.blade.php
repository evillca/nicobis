<div class="box box-info padding-1">
    <div class="box-body">
        
        {{--  <div class="form-group">
            {{ Form::label('id_publico') }}
            {{ Form::text('id_publico', $publico->id_publico, ['class' => 'form-control' . ($errors->has('id_publico') ? ' is-invalid' : ''), 'placeholder' => 'Id Publico']) }}
            {!! $errors->first('id_publico', '<div class="invalid-feedback">:message</p>') !!}
        </div>  --}}
        <div class="form-group">
            {{ Form::label('slug_publico') }}
            {{ Form::text('slug_publico', $publico->slug_publico, ['class' => 'form-control' . ($errors->has('slug_publico') ? ' is-invalid' : ''), 'placeholder' => 'Slug Publico']) }}
            {!! $errors->first('slug_publico', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nombre_publico') }}
            {{ Form::text('nombre_publico', $publico->nombre_publico, ['class' => 'form-control' . ($errors->has('nombre_publico') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Publico']) }}
            {!! $errors->first('nombre_publico', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('descripcion_publico') }}
            {{ Form::text('descripcion_publico', $publico->descripcion_publico, ['class' => 'form-control' . ($errors->has('descripcion_publico') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion Publico']) }}
            {!! $errors->first('descripcion_publico', '<div class="invalid-feedback">:message</p>') !!}
        </div>

        @if ($publico->ruta_imagen_listado_publico == '')
            <div class="form-group">
                {{ Form::label('ruta_imagen_listado_publico') }}<br>                
                {{ Form::file('ruta_imagen_listado_publico', ['id' => 'ruta_imagen_listado_publico']) }}
                {!! $errors->first('ruta_imagen_listado_publico', '<div class="invalid-feedback">:message</p></div>') !!}
                <div id="preview1"> </div>
            </div>
        @else
            {{ Html::image($publico->ruta_imagen_listado_publico, 'Portada', ['height' => 150]) }}
            <a href="{{ route('deleteFilePublicoListado', $publico->id_publico) }}"
                class="btn btn-danger">Eliminar</a>

        @endif


        @if ($publico->ruta_imagen_home_publico == '')
            <div class="form-group">
                {{ Form::label('ruta_imagen_home_publico') }}<br>                
                {{ Form::file('ruta_imagen_home_publico', ['id' => 'ruta_imagen_home_publico']) }}
                {!! $errors->first('ruta_imagen_home_publico', '<div class="invalid-feedback">:message</p></div>') !!}
                <div id="preview2"> </div>
            </div>
        @else
            {{ Html::image($publico->ruta_imagen_home_publico, 'Portada', ['height' => 150]) }}
            <a href="{{ route('deleteFilePublicoHome', $publico->id_publico) }}"
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

        $("#ruta_imagen_listado_publico").change(function() {
            readURL1(this);
        });

        $("#ruta_imagen_home_publico").change(function() {
            readURL2(this);
        });


    })
</script>

@stop