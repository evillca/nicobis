<div class="row">
    <div class="col-12">
        <div class="card card-default">
            <div class="card-header bg-light text-dark ">
                <span class="card-title"> Atributos</span>
                <div class="float-right">
                    <button type="button" class="btn btn-sm btn-outline-primary btn-block" data-toggle="modal"
                        data-target="#exampleModalCenter"><i class="fa fa-plus"></i> Agregar</button>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-sm">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Atributo</th>
                            <th scope="col">Detalle</th>
                            <th scope="col">Orden</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($arrayAtributos as $key => $atributo)
                            <tr>
                                <th scope="row">{{ $key + 1 }}</th>
                                <td>{{ $atributo->atributo }}</td>
                                <td>{{ $atributo->detalle }}</td>
                                <td>{{ $atributo->orden }}</td>
                                <td>
                                    <a class="btn btn-sm btn-danger"
                                        href="{{ route('deleteAtributos', [$key, $objetosDigitale->id_objeto_digital]) }}"><i
                                            class="fa fa-fw fa-trash"></i></a>
                                    <a class="btn btn-sm btn-warning"
                                        onclick="editarAtributo({{ $key }},'{{ $atributo->atributo }}','{{ $atributo->detalle }}','{{ $atributo->orden }}')"><i
                                            class="fa fa-fw fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form_atributos" method="POST"
                action="{{ route('addAtributo', $objetosDigitale->id_objeto_digital) }}" role="form">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar atributo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label class="field-label" for="atributo">Nombre Atributo</label>
                                <input id="atributo" type="text" name="atributo" class="gui-input form-control"
                                    placeholder="">
                            </div>
                            <div class="form-group">
                                <label class="field-label" for="detalle">Detalle</label>
                                <input id="detalle" type="text" name="detalle" class="gui-input form-control"
                                    placeholder="">
                            </div>
                            <div class="form-group">
                                <label class="field-label" for="orden">Orden</label>
                                <input id="orden" type="text" name="orden" class="gui-input form-control"
                                    placeholder="">
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button id="buttonSaveAtributo" type="button" class="btn btn-primary">Agregar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="updateModalTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <form id="form_atributos_update" method="POST"
                action="{{ route('updateAtributo', $objetosDigitale->id_objeto_digital) }}" role="form">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLongTitle">Agregar atributo</h5>
                    <button type="button" class="close" data-dismiss="modal" onclick="closeModal()"
                        aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <input id="key_update" name="key_update" type="text">
                            <div class="form-group">
                                <label class="field-label" for="atributo">Nombre Atributo</label>
                                <input id="atributo_update" type="text" name="atributo" class="gui-input form-control"
                                    placeholder="">
                            </div>
                            <div class="form-group">
                                <label class="field-label" for="detalle">Detalle</label>
                                <input id="detalle_update" type="text" name="detalle" class="gui-input form-control"
                                    placeholder="">
                            </div>
                            <div class="form-group">
                                <label class="field-label" for="orden">Orden</label>
                                <input id="orden_update" type="text" name="orden" class="gui-input form-control"
                                    placeholder="">
                            </div>
                        </div>

                    </div>

                </div>
                <div class="modal-footer">
                    <button onclick="closeModal()" type="button" class="btn btn-secondary"
                        data-dismiss="modal">Close</button>
                    <button id="buttonUpdateAtributo" type="button" class="btn btn-primary">Grabar</button>
                </div>
            </form>
        </div>
    </div>
</div>
