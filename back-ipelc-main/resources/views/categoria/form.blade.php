<div class="box box-info padding-1">
    <div class="box-body">
        
        <div class="form-group">
            {{ Form::label('slug_categoria') }}
            {{ Form::text('slug_categoria', $categoria->slug_categoria, ['class' => 'form-control' . ($errors->has('slug_categoria') ? ' is-invalid' : ''), 'placeholder' => 'Slug Categoria']) }}
            {!! $errors->first('slug_categoria', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('nombre_categoria') }}
            {{ Form::text('nombre_categoria', $categoria->nombre_categoria, ['class' => 'form-control' . ($errors->has('nombre_categoria') ? ' is-invalid' : ''), 'placeholder' => 'Nombre Categoria']) }}
            {!! $errors->first('nombre_categoria', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('descripcion_categoria') }}
            {{ Form::text('descripcion_categoria', $categoria->descripcion_categoria, ['class' => 'form-control' . ($errors->has('descripcion_categoria') ? ' is-invalid' : ''), 'placeholder' => 'Descripcion Categoria']) }}
            {!! $errors->first('descripcion_categoria', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('icono_categoria') }}
            {{ Form::text('icono_categoria', $categoria->icono_categoria, ['class' => 'form-control' . ($errors->has('icono_categoria') ? ' is-invalid' : ''), 'placeholder' => 'Icono Categoria']) }}
            {!! $errors->first('icono_categoria', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        
        @if ($categoria->ruta_imagen_listado_categoria == '')
            <div class="form-group">
                {{ Form::label('ruta_imagen_listado_categoria') }}<br>                
                {{ Form::file('ruta_imagen_listado_categoria', ['id' => 'ruta_imagen_listado_categoria']) }}
                {!! $errors->first('ruta_imagen_listado_categoria', '<div class="invalid-feedback">:message</p></div>') !!}
                <div id="preview"> </div>
            </div>
        @else
            {{ Html::image($categoria->ruta_imagen_listado_categoria, 'Portada', ['height' => 150]) }}
            <a href="{{ route('deleteFileCategoria', $categoria->id_categoria) }}"
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
        function readURL(input) {
            if (input.files && input.files[0]) {
                var i;
                for (i = 0; i < input.files.length; ++i) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('#preview').append('<img src="' + e.target.result + '" width="150">');
                    }
                    reader.readAsDataURL(input.files[i]);
                }
            }
        }

        $("#ruta_imagen_listado_categoria").change(function() {
            readURL(this);
        });


    })
</script>

@stop