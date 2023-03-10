@extends('layouts.material')


@section('content')

    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Ajout/Modification établissement</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                {!! form_start($form) !!}
                <div class="modal-body">
                    {!! form_row($form->name) !!}
                    {!! form_row($form->secteur_pedagogique_id) !!}
                    {!! form_row($form->type_etablissement_id) !!}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
                {!! form_end($form) !!}
            </div>
        </div>
    </div>
    <h3 class="m-b-0 text-white text-center bg-primary">Les établissements</h3>

    <div class="card card-outline-info">
        <div class="card-body">
            @can('ACTIONS_CONFIGURATION')
            <button data-toggle="modal" data-target="#add" data-whatever="@getbootstrap" class="btn btn-themecolor btn-sm"><i class="mdi font-weight-bold mdi-18px mdi-plus"> Ajouter</i></button>
            @endcan
            <table class="table table-bordered text-center" id="myTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Libellé</th>
                    <th>Secteur pédagogique</th>
                    <th>Type</th>
                    @can('ACTIONS_CONFIGURATION')
                        <th>Actions</th>
                    @endcan
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            @include('dataTableAjax', ['columns' => "[
                { data: 'id', name: 'id' },
                { data: 'name', name: 'name' },
                { data: 'secteurPedagogique', name: 'secteurPedagogique' },
                { data: 'typeEtablissement', name: 'typeEtablissement' },
                { data: 'actions', name: 'Actions', searchable: false, orderable: false },
            ]", 'route' => route('etablissement.index')], ['scroll' => '450px'])
        });

        @if($errors->any())
            $('#add').modal('show')
        @endif

        let $modal = $('#add')
        let $name = $('#name')
        let $secteur = $('#secteur_pedagogique_id')
        let $type = $('#type_etablissement_id')
        let $form = $('form')


        function updateEtablissement(id) {
            let $el = $('#etablissement'+id)
            $modal.modal('show')
            $name.val($el.attr('data-name'))
            $secteur.val($el.attr('data-secteur'))
            $type.val($el.attr('data-type'))
            $form.attr('action', $el.attr('data-route'))
            $form.append("<input type='hidden' name='_method' value='PUT'>")
        }

        $modal.on('hidden.bs.modal', function (e) {
            $name.val('')
            $secteur.val(null)
            $type.val(null)
            $form.attr('action', '')
            $('input[name="_method"]').remove()
        })
    </script>
@endsection
