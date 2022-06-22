@extends('adminlte::page')

@section('template_title')
    Objetos Digitales
@endsection
@section('css')
    <style>
        #myInput {
            background-position: 10px 12px;
            background-repeat: no-repeat;
            width: 80%;
            font-size: 16px;
            padding: 12px 20px 12px 40px;
            border: 1px solid #ddd;
            margin-bottom: 12px;
        }

    </style>
@stop
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Objetos Digitales') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('objetos-digitales.create') }}"
                                    class="btn btn-primary btn-sm float-right" data-placement="left">
                                    {{ __('Create New') }}
                                </a>
                            </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    @if ($message = Session::get('errors'))
                        <div class="alert alert-danger">
                            <p>{{ $message }}</p>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <div class="card-body">
                        {{ Form::open(['route' => 'search', 'method' => 'GET'])}}
                            <input id="searchText" type="text" id="search" name="search" placeholder="Buscar..." value="{{ $search }}">
                            <button type="submit" class="btn btn-sm btn-primary">Buscar</button>                        
                            <button class="btn btn-sm" onclick="document.getElementById('searchText').value ='';">Limpiar</button>   
                        {{ Form::close() }}
                        

                        <div class="table-responsive">
                            <table id="myTable" class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>

                                        <th>Slug Objeto Digital</th>
                                        <th>Titulo</th>
                                        <th>Resumen</th>
                                        <th>Portada Objeto Digital</th>
                                        <th>Año</th>
                                        <th>Fecha</th>
                                        <th>Licencia Objeto Digital</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($objetosDigitales as $objetosDigitale)
                                        <tr>
                                            <td>{{ ++$i }}</td>

                                            <td>{{ $objetosDigitale->slug_objeto_digital }}</td>
                                            <td>{{ $objetosDigitale->titulo }}</td>
                                            <td>{{ Str::limit($objetosDigitale->resumen, 60) }}</td>
                                            <td>
                                                @if ($objetosDigitale->ruta_portada_objeto_digital)
                                                    {{ Html::image($objetosDigitale->ruta_portada_objeto_digital, 'Portada', ['width' => 70, 'height' => 70]) }}
                                                @endif

                                            </td>
                                            <td>{{ $objetosDigitale->año }}</td>
                                            <td>{{ $objetosDigitale->fecha }}</td>
                                            <td>{{ $objetosDigitale->licencia_objeto_digital }}</td>

                                            <td>
                                                <form
                                                    action="{{ route('objetos-digitales.destroy', $objetosDigitale->id_objeto_digital) }}"
                                                    method="POST">
                                                    <a class="btn btn-sm btn-primary "
                                                        href="{{ route('objetos-digitales.show', $objetosDigitale->id_objeto_digital) }}"><i
                                                            class="fa fa-fw fa-eye"></i> </a>
                                                    <a class="btn btn-sm btn-success"
                                                        href="{{ route('objetos-digitales.edit', $objetosDigitale->id_objeto_digital) }}"><i
                                                            class="fa fa-fw fa-edit"></i> </a>
                                                    {{-- <a class="btn btn-sm btn-warning" href="{{ route('uploadMultimediaObjetos',$objetosDigitale->id_objeto_digital) }}"><i class="fa fa-fw fa-edit"></i> File</a> --}}
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i
                                                            class="fa fa-fw fa-trash"></i> </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Objetos Digitales') }}
                            </span>

                            <div class="float-right">
                                <a href="{{ route('objetos-digitales.create') }}"
                                    class="btn btn-primary btn-sm float-right" data-placement="left">
                                    {{ __('Create New') }}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                {!! $objetosDigitales->appends(['search' => $search ])->links() !!}
            </div>
        </div>
    </div>
@endsection
@section('js')    
    <script type="text/javascript">
        function buscar(){
            alert("sasdasd");
        }        
    </script>

@stop
