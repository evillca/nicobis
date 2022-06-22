@extends('adminlte::page')

@section('template_title')
    Create Objetos Digitales
@endsection

@section('css')
<link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet">
@stop

@section('content')
    <section class="content container-fluid">
        <div class="row">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header">
                        <span class="card-title">Create Objetos Digitales</span>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('objetos-digitales.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf
                            {{--  {{ Form::open(array('files'=>'true')) }}   --}}
                            @include('objetos-digitale.form')

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')

<!-- JavaScript Bundle with Popper -->

<script src="{{ asset('assets/js/select2.min.js') }}"></script>

<script type="text/javascript">
    $('.select2').select2();
    $(function () {
    //Initialize Select2 Elements
        
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

        $("#ruta_portada_objeto_digital").change(function() {
            readURL(this);
        });

        $('#buttonSaveAtributo').click(function(){        
            $("#form_atributos").submit();  
        });

        $('#buttonUpdateAtributo').click(function(){        
            $("#form_atributos_update").submit();  
        });

    })


    function editarAtributo(key,atributo,detalle,orden){
        $('#key_update').val(key);
        $('#atributo_update').val(atributo);
        $('#detalle_update').val(detalle);
        $('#orden_update').val(orden);

        $('#updateModal').modal('show');
            //alert("asdasd")
    }

    function closeModal(){
        $('#updateModal').modal('hide');  
    }

    

    
    


</script>

@stop