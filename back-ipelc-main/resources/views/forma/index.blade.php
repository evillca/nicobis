@extends('adminlte::page')

@section('template_title')
    Forma
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <div style="display: flex; justify-content: space-between; align-items: center;">

                            <span id="card_title">
                                {{ __('Forma') }}
                            </span>

                             <div class="float-right">
                                <a href="{{ route('formas.create') }}" class="btn btn-primary btn-sm float-right"  data-placement="left">
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
										<th>Slug Forma</th>
										<th>Nombre Forma</th>
										<th>Descripcion Forma</th>
										<th>Categoria</th>										

                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($formas as $forma)
                                        <tr>
                                            <td>{{ ++$i }}</td>
											<td>{{ $forma->slug_forma }}</td>
											<td>{{ $forma->nombre_forma }}</td>
											<td>{{ $forma->descripcion_forma }}</td>
											<td>{{ $forma->nombre_categoria }}</td>
                                            <td>
                                                <form action="{{ route('formas.destroy',$forma->id_forma) }}" method="POST">
                                                    <a class="btn btn-sm btn-primary " href="{{ route('formas.show',$forma->id_forma) }}"><i class="fa fa-fw fa-eye"></i> </a>
                                                    <a class="btn btn-sm btn-success" href="{{ route('formas.edit',$forma->id_forma) }}"><i class="fa fa-fw fa-edit"></i> </a>
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
                {!! $formas->links() !!}
            </div>
        </div>
    </div>
@endsection
