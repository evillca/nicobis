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
                       Test
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('testftp.store') }}"  role="form" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                {{ Form::label('archivo') }}<br>                
                                {{ Form::file('file', ['id' => 'file']) }}                                                                
                            </div>
                            <button type="submit" name="submit">Submit</button>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
