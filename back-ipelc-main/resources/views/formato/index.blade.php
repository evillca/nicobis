@extends('adminlte::page')

@section('template_title')
    Formato
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Formato') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('formatos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        										
										<th>Nombre Formato</th>
										<th>Descripcion Formato</th>
										<th>Extension Formato</th>										

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($formatos as $formato)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            											
											<td>{{ $formato->nombre_formato }}</td>
											<td>{{ $formato->descripcion_formato }}</td>
											<td>{{ $formato->extension_formato }}</td>											

                                            <td>
                                                <form action="{{ route('formatos.destroy',$formato->id_formato) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('formatos.show',$formato->id_formato) }}"><i class="fa fa-fw fa-eye"></i> </a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('formatos.edit',$formato->id_formato) }}"><i class="fa fa-fw fa-edit"></i> </a>
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm"><i class="fa fa-fw fa-trash"></i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                {!! $formatos->links() !!}
            </div>
        </div>
    </div>
@endsection
