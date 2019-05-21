@extends('layouts.material')


@section('content')

    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Nouveau secteur</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                {!! form_start($form) !!}
                <div class="modal-body">
                    {!! form_row($form->name) !!}
                    {!! form_row($form->inspection_id) !!}
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
            <h3 class="text-center label-default">Les secteurs pédagogiques</h3>

            <button data-toggle="modal" data-target="#add" data-whatever="@getbootstrap" class="btn btn-themecolor btn-sm"><i class="mdi font-weight-bold mdi-18px mdi-plus"> Ajouter</i></button>
            <table class="table table-bordered text-center" id="myTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Libellé</th>
                    <th>Inspection</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($secteurPedagogiques as $secteurPedagogique)
                    <tr>
                        <td>{{ $secteurPedagogique->id }}</td>
                        <td>{{ $secteurPedagogique->name }}</td>
                        <td>{{ $secteurPedagogique->departement->name }}</td>
                        <td>
                            <button id="secteurPedagogique{{ $secteurPedagogique->id }}"
                                    data-inspection="{{ $secteurPedagogique->inspection_id }}" data-name="{{ $secteurPedagogique->name }}"
                                    data-route="{{ route('secteurPedagogique.update', $secteurPedagogique) }}"
                                    onclick="updateSecteurPedagogique({{ $secteurPedagogique->id }})" class="btn btn-sm btn-outline-warning">
                                <i class="mdi mdi-pencil"></i>
                            </button>


                            <form action="{{ route('secteurPedagogique.destroy', $secteurPedagogique) }}" id="del{{ $secteurPedagogique->id }}" style="display: inline-block;" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-outline-danger btn-sm" type="button"
                                        onclick="myHelpers.deleteConfirmation('{{ 'del'. $secteurPedagogique->id }}')">
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
    @include('dataTable')
    <script>
        let $modal = $('#add')
        let $name = $('#name')
        let $inspection = $('#inspection_id')
        let $form = $('form')


        function updateSecteurPedagogique(id) {
            let $el = $('#secteurPedagogique'+id)
            $modal.modal('show')
            $name.val($el.attr('data-name'))
            $inspection.val($el.attr('data-departement'))
            $form.attr('action', $el.attr('data-route'))
            $form.append("<input type='hidden' name='_method' value='PUT'>")
        }

        $modal.on('hidden.bs.modal', function (e) {
            $name.val('')
            $inspection.val(null)
            $form.attr('action', '')
            $('input[name="_method"]').remove()
        })
    </script>
@endsection