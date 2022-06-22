@extends('adminlte::page')

@section('template_title')
    Archivo
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Archivo') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('archivos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                    										
										<th>Ruta Archivo</th>
										<th>Nombre Archivo</th>
										<th>Id Objeto Digital</th>
										<th>Id Forma</th>
										<th>Id Formato</th>										

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($archivos as $archivo)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            											
											<td>{{ $archivo->ruta_archivo }}</td>
											<td>{{ $archivo->nombre_archivo }}</td>
											<td>{{ $archivo->id_objeto_digital }}</td>
											<td>{{ $archivo->id_forma }}</td>
											<td>{{ $archivo->id_formato }}</td>											

                                            <td>
                                                <form action="{{ route('archivos.destroy',$archivo->id_archivo) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('archivos.show',$archivo->id_archivo) }}"><i class="fa fa-fw fa-eye"></i> Show</a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('archivos.edit',$archivo->id_archivo) }}"><i class="fa fa-fw fa-edit"></i> Edit</a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $archivos->links() !!}
            </div>
        </div>
    </div>
@endsection
