@extends('adminlte::page')

@section('template_title')
    Update Objetos Digitale
@endsection

@section('css')
    <link href="{{ asset('assets/css/select2.min.css') }}" rel="stylesheet">
    <style>
        .card-footer, .progress {
            display: none;
        }
    </style>
@stop


@section('content')
    <section class="content container-fluid">
        <div class="">
            <div class="col-md-12">

                @includeif('partials.errors')

                <div class="card card-default">
                    <div class="card-header bg-info text-white">
                        <span class="card-title">Update Objetos Digitale</span>
                    </div>
                    <div class="card-body">


                        @include('objetos-digitale.form')


                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('js')

    <script src="{{ asset('assets/js/select2.min.js') }}"></script>    
    <script src="{{ asset('assets/js/resumable.min.js') }}"></script>

    <script type="text/javascript">
        $('.select2').select2();
 
        let progress = $('.progress');

        function showProgress() {
            progress.find('.progress-bar').css('width', '0%');
            progress.find('.progress-bar').html('0%');
            progress.find('.progress-bar').removeClass('bg-success');
            progress.show();
            $("#cancelButton").show();
        }

        function updateProgress(value) {
            progress.find('.progress-bar').css('width', `${value}%`)
            progress.find('.progress-bar').html(`${value}%`)
        }

        function hideProgress() {
            progress.hide();            
        }

        $(function() {
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

            $('#buttonSaveAtributo').click(function() {
                $("#form_atributos").submit();
            });

            $('#buttonUpdateAtributo').click(function() {
                $("#form_atributos_update").submit();
            });

            

        })


        function editarAtributo(key, atributo, detalle, orden) {
            $('#key_update').val(key);
            $('#atributo_update').val(atributo);
            $('#detalle_update').val(detalle);
            $('#orden_update').val(orden);

            $('#updateModal').modal('show');
            //alert("asdasd")
        }

        function closeModal() {
            $('#updateModal').modal('hide');
            $("#archivoUpdate").modal('hide');
            $("#uploadArchivo").modal('hide');
            $("#archivos")[0].reset();
        }

        $('#buttonAddArchivo').click(function() {
            $("#archivoUpdate").modal('show');
        });

        function uploadArchivo(archivo, objeto,formato) {
            $("#uploadArchivo").modal('show');
            $("#id_archivo").val(archivo);            

            let browseFile = $('#browseFile');

            let resumable = new Resumable({
                target: '{{ route('files.upload.large') }}',
                query: function () {                
                    return{
                        _token: '{{ csrf_token() }}',
                        archivo: document.getElementById('id_archivo').value,
                    }
                },
                fileType:  [formato],
                headers: {
                    'Accept': 'application/json'
                },
                testChunks: false,
                chunkSize: 1 * 1024 * 1024,
                throttleProgressCallbacks: 1,
            });

            resumable.assignBrowse(browseFile[0]);
            resumable.on('fileAdded', function(file) { // trigger when file picked
                showProgress();
                resumable.upload() // to actually start uploading.
            });

            resumable.on('fileProgress', function(file) { // trigger when file progress update
                updateProgress(Math.floor(file.progress() * 100));
            });

            resumable.on('fileSuccess', function(file, response) { // trigger when file upload complete
                response = JSON.parse(response)
                //$('#videoPreview').attr('src', response.path);
                $('.card-footer').show();
                window.location.href = "/objetos-digitales/" + response.id_objeto + "/edit";
            });

            resumable.on('fileError', function(file, response) { // trigger when there is any error
                alert('file uploading error.')
            });

            $("#cancelButton").on("click", function() {
                resumable.cancel();
                progress.hide();
                $("#cancelButton").hide();
            });
        }

        function save() {
            $.ajax({
                type: "POST",
                url: "{{ route('archivos.store') }}",
                dataType: 'json',
                data: $("#archivos").serialize(),
                success: function(data) {
                    if (data.status == 'success') {
                        $("#archivos")[0].reset();
                        closeModal();
                        console.log("entro");

                    } else {
                        console.log("error");
                    }
                },
                error: function(data) {
                    if (data.status != 401) {
                        console.log("401");
                    } else {
                        window.location = '/';
                    }
                }
            });

        }


        
    </script>

@stop
