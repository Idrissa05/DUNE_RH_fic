@extends('layouts.material')


@section('content')

    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Nouveau Type</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                {!! form_start($form) !!}
                <div class="modal-body">
                    {!! form_row($form->name) !!}
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
            <h3 class="text-center label-default">Les types d'établissement</h3>

            <button data-toggle="modal" data-target="#add" data-whatever="@getbootstrap" class="btn btn-themecolor btn-sm"><i class="mdi font-weight-bold mdi-18px mdi-plus"> Ajouter</i></button>
            <p>&nbsp;</p>
            <p>&nbsp;</p>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Libellé</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($typeEtablissements as $typeEtablissement)
                    <tr>
                        <td>{{ $typeEtablissement->id }}</td>
                        <td>{{ $typeEtablissement->name }}</td>
                        <td>
                            <button id="typeEtablissement{{ $typeEtablissement->id }}" data-name="{{ $typeEtablissement->name }}" data-route="{{ route('typeetablissement.update', $typeEtablissement) }}"
                                    onclick="updateType({{ $typeEtablissement->id }})" class="btn btn-sm btn-outline-warning">
                                <i class="mdi mdi-18px mdi-pencil"></i>
                            </button>

                            <form action="{{ route('typeetablissement.destroy', ['id' => $typeEtablissement]) }}" id="del{{ $typeEtablissement->id }}" style="display: inline-block;" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-outline-danger btn-sm" type="button"
                                onclick="myHelpers.deleteConfirmation('{{ 'del'. $typeEtablissement->id }}')">
                                    <i class="mdi mdi-18px mdi-trash-can-outline"></i>
                                </button>
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
        let $form = $('form')


        function updateType(id) {
            let $el = $('#typeEtablissement'+id)
            $modal.modal('show')
            $name.val($el.attr('data-name'))
            $form.attr('action', $el.attr('data-route'))
            $form.append("<input type='hidden' name='_method' value='PUT'>")
        }

        $modal.on('hidden.bs.modal', function (e) {
            $name.val('')
            $form.attr('action', '')
            $('input[name="_method"]').remove()
        })
    </script>
@endsection