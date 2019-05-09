@extends('layouts.material')


@section('content')

    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Nouvelle inspection</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                {!! form_start($form) !!}
                <div class="modal-body">
                    {!! form_row($form->name) !!}
                    {!! form_row($form->departement_id) !!}
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
            <h3 class="text-center label-default">Les inspections</h3>

            <button data-toggle="modal" data-target="#add" data-whatever="@getbootstrap" class="btn btn-themecolor btn-sm"><i class="mdi font-weight-bold mdi-18px mdi-plus"> Ajouter</i></button>
            <p>&nbsp;</p>
            <p>&nbsp;</p>

            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Libellé</th>
                    <th>Département</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($inspections as $inspection)
                    <tr>
                        <td>{{ $inspection->id }}</td>
                        <td>{{ $inspection->name }}</td>
                        <td>{{ $inspection->departement->name }}</td>
                        <td>
                            <button id="inspection{{ $inspection->id }}"
                                    data-departement="{{ $inspection->departement_id }}" data-name="{{ $inspection->name }}"
                                    data-route="{{ route('inspection.update', $inspection) }}"
                                    onclick="updateInspection({{ $inspection->id }})" class="btn btn-sm btn-outline-warning">
                                <i class="mdi mdi-pencil"></i>
                            </button>


                            <form action="{{ route('inspection.destroy', $inspection) }}" id="del{{ $inspection->id }}" style="display: inline-block;" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-outline-danger btn-sm" type="button"
                                onclick="myHelpers.deleteConfirmation('{{ 'del'. $inspection->id }}')">
                                    <i class="mdi mdi-trash-can-outline"></i>
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
        let $departement = $('#departement_id')
        let $form = $('form')


        function updateInspection(id) {
            let $el = $('#inspection'+id)
            $modal.modal('show')
            $name.val($el.attr('data-name'))
            $departement.val($el.attr('data-departement'))
            $form.attr('action', $el.attr('data-route'))
            $form.append("<input type='hidden' name='_method' value='PUT'>")
        }

        $modal.on('hidden.bs.modal', function (e) {
            $name.val('')
            $departement.val(null)
            $form.attr('action', '')
            $('input[name="_method"]').remove()
        })
    </script>
@endsection