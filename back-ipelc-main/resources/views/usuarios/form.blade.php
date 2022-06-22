@section('css')    
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet">
@stop
<div class="box box-info padding-1">
    <div class="box-body">

        <div class="form-group">
            {{ Form::label('name') }}
            {{ Form::text('name', $usuario->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : ''), 'placeholder' => 'Nombre completo']) }}
            {!! $errors->first('name', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        <div class="form-group">
            {{ Form::label('email') }}
            {{ Form::text('email', $usuario->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : ''), 'placeholder' => 'Email']) }}
            {!! $errors->first('email', '<div class="invalid-feedback">:message</p>') !!}
        </div>
        @if ($usuario->id)

            <div class="form-group">
                {{ Form::label('Cambiar contraseña?') }}<br>
                <label class="radio inline">
                    {!! Form::radio('cambiar', 1) !!}
                    Si
                </label>
                <label class="radio inline">
                    {!! Form::radio('cambiar', 0, true) !!}
                    No
                </label>
            </div>
            <div id="password_update" class="form-group" style="display:none;">
                {{ Form::label('password') }}
                {{ Form::text('password_update','',['class' => 'form-control' . ($errors->has('password_update') ? ' is-invalid' : ''), 'placeholder' => 'Password']) }}
                {!! $errors->first('password_update', '<div class="invalid-feedback">:message</p>') !!}
            </div>


        @else
            <div class="form-group">
                {{ Form::label('password') }}
                {{ Form::text('password', $usuario->password, ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : ''), 'placeholder' => 'Password']) }}
                {!! $errors->first('password', '<div class="invalid-feedback">:message</p>') !!}
            </div>
        @endif

        <div class="col-6">
            <div class="form-group">
                {{ Form::label('menus_permitidos') }}
                {{ Form::select('menus[]', $menus_options, old('menus[]', $menusSelecc), ['id' => 'menus', 'multiple' => 'multiple', 'style' => 'width: 100%;', 'class' => 'select2'], $menus_attributes) }}
                {!! $errors->first('menus', '<div class="invalid-feedback">:message</p></div>') !!}
            </div>
        </div>


    </div>
    <div class="box-footer mt20">
        <button type="submit" class="btn btn-primary">Submit</button>
    </div>
</div>

@section('js')    
    <script src="{{ asset('assets/js/select2.min.js') }}"></script>
    <script type="text/javascript">
        $('.select2').select2();
        $(function() {
            //Initialize Select2 Elements
            $("input[type=radio]").click(function(event) {
                var valor = $(event.target).val();
                if (valor == "1") {
                    $("#password_update").show();

                } else if (valor == "0") {
                    $("#password_update").hide();
                } else {
                    // Otra cosa
                    console.log("hola");
                }
            });

        })
    </script>

@stop
