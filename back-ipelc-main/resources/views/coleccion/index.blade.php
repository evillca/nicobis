@extends('adminlte::page')

@section('template_title')
    Coleccion
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Coleccion') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('colecciones.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
                                  {{ __('Create New') }}
                                </a>
                              </div>
                        </div>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success">
                            <p>{{ $message }}</p>
                        </div>
                    @endif

                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="thead">
                                    <tr>
                                        <th>No</th>
                                        
										<th>Slug Coleccion</th>
										<th>Nombre Coleccion</th>
										<th>Descripcion Coleccion</th>
										<th>Titulo Coleccion</th>
										<th>Subtitulo Coleccion</th>
										<th>Es Principal Coleccion</th>

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($colecciones as $coleccion)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            
											<td>{{ $coleccion->slug_coleccion }}</td>
											<td>{{ $coleccion->nombre_coleccion }}</td>
											<td>{{ $coleccion->descripcion_coleccion }}</td>
											<td>{{ $coleccion->titulo_coleccion }}</td>
											<td>{{ $coleccion->subtitulo_coleccion }}</td>
											<td>{{ ($coleccion->es_principal_coleccion==1?'Si':'No') }}</td>


                                            <td>
                                                <form action="{{ route('colecciones.destroy',$coleccion->id_coleccion) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('colecciones.show',$coleccion->id_coleccion) }}"><i class="fa fa-fw fa-eye"></i> </a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('colecciones.edit',$coleccion->id_coleccion) }}"><i class="fa fa-fw fa-edit"></i> </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $colecciones->links() !!}
            </div>
        </div>
    </div>
@endsection
