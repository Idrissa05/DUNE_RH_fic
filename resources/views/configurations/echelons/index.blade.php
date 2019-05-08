@extends('layouts.material')


@section('content')

    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Nouvelle echelon</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                {!! form_start($form) !!}
                <div class="modal-body">
                    {!! form_row($form->name) !!}
                    {!! form_row($form->classe_id) !!}
                    {!! form_row($form->description) !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
                {!! form_end($form) !!}
            </div>
        </div>
    </div>

    <div class="card card-outline-info">
        <div class="card-body">
            <h3 class="text-center label-default">Les échelons</h3>

            <button data-toggle="modal" data-target="#add" data-whatever="@getbootstrap" class="btn btn-themecolor btn-sm"><i class="mdi font-weight-bold mdi-18px mdi-plus"> Ajouter</i></button>
            <p>&nbsp;</p>
            <p>&nbsp;</p>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Libellé</th>
                    <th>Classe</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($echelons as $echelon)
                    <tr>
                        <td>{{ $echelon->id }}</td>
                        <td>{{ $echelon->name }}</td>
                        <td>{{ $echelon->classe->name }}</td>
                        <td>{{ $echelon->description }}</td>
                        <td>
                            <button id="echelon{{ $echelon->id }}"
                                    data-classe="{{ $echelon->classe_id }}" data-name="{{ $echelon->name }}"
                                    data-description="{{ $echelon->description }}"
                                    data-route="{{ route('echelon.update', $echelon) }}"
                                    onclick="updateEchelon({{ $echelon->id }})" class="btn btn-sm btn-outline-warning">
                                <i class="mdi mdi-pencil"></i>
                            </button>


                            <form action="{{ route('echelon.destroy', $echelon) }}" style="display: inline-block;" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-outline-danger btn-sm"><i class="mdi mdi-trash-can-outline"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script>
        let $modal = $('#add')
        let $name = $('#name')
        let $description = $('#description')
        let $classe = $('#classe_id')
        let $form = $('form')


        function updateEchelon(id) {
            let $el = $('#echelon'+id)
            $modal.modal('show')
            $name.val($el.attr('data-name'))
            $description.val($el.attr('data-description'))
            $classe.val($el.attr('data-classe'))
            $form.attr('action', $el.attr('data-route'))
            $form.append("<input type='hidden' name='_method' value='PUT'>")
        }

        $modal.on('hidden.bs.modal', function (e) {
            $name.val('')
            $description.val('')
            $classe.val(null)
            $form.attr('action', '')
            $('input[name="_method"]').remove()
        })
    </script>
@endsection