@extends('layouts.material')


@section('content')

    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Nouvelle etablissement</h4>
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
            <h3 class="text-center label-default">Les établissements</h3>

            <button data-toggle="modal" data-target="#add" data-whatever="@getbootstrap" class="btn btn-themecolor btn-sm"><i class="mdi font-weight-bold mdi-18px mdi-plus"> Ajouter</i></button>
            <p>&nbsp;</p>
            <p>&nbsp;</p>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Libellé</th>
                    <th>Inspection</th> '
                    <th>Localité</th>
                    <th>Type</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($etablissements as $etablissement)
                    <tr>
                        <td>{{ $etablissement->id }}</td>
                        <td>{{ $etablissement->name }}</td>
                        <td>{{ $etablissement->inspection->name }}</td>
                        <td>{{ $etablissement->localite->name }}</td>
                        <td>
                            <button id="etablissement{{ $etablissement->id }}"
                                    data-classe="{{ $etablissement->classe_id }}" data-name="{{ $etablissement->name }}"
                                    data-description="{{ $etablissement->description }}"
                                    data-route="{{ route('etablissement.update', $etablissement) }}"
                                    onclick="updateEtablissement({{ $etablissement->id }})" class="btn btn-sm btn-outline-warning">
                                <i class="mdi mdi-pencil"></i>
                            </button>


                            <form action="{{ route('etablissement.destroy', $etablissement) }}" style="display: inline-block;" method="post">
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


        function updateEtablissement(id) {
            let $el = $('#etablissement'+id)
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