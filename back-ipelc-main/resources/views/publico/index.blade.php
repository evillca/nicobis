@extends('adminlte::page')

@section('template_title')
    Publico
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Publico') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('publicos.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
                                        										
										<th>Slug Publico</th>
										<th>Nombre Publico</th>
										<th>Descripcion Publico</th>									

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($publicos as $publico)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            											
											<td>{{ $publico->slug_publico }}</td>
											<td>{{ $publico->nombre_publico }}</td>
											<td>{{ $publico->descripcion_publico }}</td>											

                                            <td>
                                                <form action="{{ route('publicos.destroy',$publico->id_publico) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('publicos.show',$publico->id_publico) }}"><i class="fa fa-fw fa-eye"></i> </a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('publicos.edit',$publico->id_publico) }}"><i class="fa fa-fw fa-edit"></i> </a>
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
                {!! $publicos->links() !!}
            </div>
        </div>
    </div>
@endsection
