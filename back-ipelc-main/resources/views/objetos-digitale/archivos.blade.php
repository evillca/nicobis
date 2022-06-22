<div class="row">
    <div class="col-12">
        <div class="card card-default">
            <div class="card-header bg-light text-dark">
                <span class="card-title">Archivos</span>
                <div class="float-right">
                    <button id="buttonAddArchivo" type="button" class="btn btn-sm btn-outline-primary btn-block"><i
                            class="fa fa-plus"></i> Agregar</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Nombre archivo</th>
                            <th scope="col">Forma</th>
                            <th scope="col">Formato</th>
                            <th scope="col">file</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($arrayArchivos as $key => $archivo)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $archivo->nombre_archivo }}</td>
                                <td>{{ $archivo->slug_forma }}</td>
                                <td>{{ $archivo->nombre_formato }}</td>
                                <td>
                                    @if ($archivo->ruta_archivo != '-')
                                        <a href="/{{ $archivo->ruta_archivo }}" target="_blank">
                                            <i class="fa fa-archive fa-2x" aria-hidden="true"></i>
                                        </a>
                                    @else
                                        <i class="fa fa-question-circle fa-2x" aria-hidden="true"></i>
                                    @endif

                                </td>
                                <td>
                                    <a class="btn btn-sm btn-danger"
                                        href="{{ route('deleteArchivos', [$archivo->id_archivo, $objetosDigitale->id_objeto_digital]) }}"><i
                                            class="fa fa-fw fa-trash"></i></a>
                                    <a class="btn btn-sm btn-success"
                                        onclick="uploadArchivo({{ $archivo->id_archivo }}, {{ $objetosDigitale->id_objeto_digital }},'{{ $archivo->extension_formato }}')"><i
                                            class="fa fa-fw fa-upload"></i> </a>

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="archivoUpdate" tabindex="-1" role="dialog" aria-labelledby="archivoUpdateTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="archivos" method="POST" action="{{ route('archivos.store') }}" role="form"
                enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar atributo</h5>
                    <button type="button" class="close" onclick="closeModal()" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            @include('archivo.form')
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
                        <button type="submit" class="btn btn-primary">Agregar</button>                        
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>


<div class="modal fade " id="uploadArchivo" data-keyboard="false" data-backdrop="static" tabindex="-1" role="dialog"
    aria-labelledby="uploadArchivoTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLongTitle">Subir Archivo</h5>
                <button type="button" class="close" onclick="closeModal()" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="container pt-4">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-body">
                                    <input type="hidden" name="id_archivo" id="id_archivo">                                    
                                    <div id="upload-container" class="text-center">
                                        <button id="browseFile" class="btn btn-sm btn-primary">Seleccionar archivo</button>
                                    </div>
                                    <div class="progress mt-3" style="height: 25px">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                                            role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"
                                            style="width: 75%; height: 100%">75%</div>                                        
                                    </div>
                                    
                                </div>

                                <button id="cancelButton" type="button" class="btn btn-sm btn-danger" style="display: none;">Cancelar</button>

                                <div class="card-footer p-4">
                                    <span style="color:#61D52C; "> Carga completa.</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
</div>
