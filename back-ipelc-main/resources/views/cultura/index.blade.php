@extends('adminlte::page')

@section('template_title')
    Cultura
@endsection



@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Cultura') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('culturas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>Slug Cultura</th>
										<th>Nombre Cultura</th>
										<th>Descripcion Cultura</th>									
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($culturas as $cultura)
                                        <tr>
                                            <td>{{ ++$i }}</td>
                                            											
											<td>{{ $cultura->slug_cultura }}</td>
											<td>{{ $cultura->nombre_cultura }}</td>
											<td>{{ $cultura->descripcion_cultura }}</td>											

                                            <td>
                                                <form action="{{ route('culturas.destroy',$cultura->id_cultura) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('culturas.show',$cultura->id_cultura) }}"><i class="fa fa-fw fa-eye"></i> </a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('culturas.edit',$cultura->id_cultura) }}"><i class="fa fa-fw fa-edit"></i> </a>
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
                {!! $culturas->links() !!}
            </div>
        </div>
    </div>
@endsection
