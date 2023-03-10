@extends('layouts.material')


@section('content')

    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Nouvelle formation</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                {!! form_start($form) !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            {!! form_row($form->agent_id) !!}
                            {!! form_row($form->ecole_formation_id) !!}
                            {!! form_row($form->date_debut) !!}
                            {!! form_row($form->equivalence_diplome_id) !!}

                        </div>
                        <div class="col-md-6">
                            {!! form_row($form->diplome_id) !!}
                            {!! form_row($form->niveau_etude_id) !!}
                            {!! form_row($form->date_fin) !!}
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
                {!! form_end($form) !!}
            </div>
        </div>
    </div>
    <h3 class="m-b-0 text-white text-center bg-primary">Les formations</h3>

    <div class="card card-outline-info">
        <div class="card-body">
            @can('EDITER_FORMATION')
            <button data-toggle="modal" data-target="#add" data-whatever="@getbootstrap" class="btn btn-themecolor btn-sm"><i class="mdi font-weight-bold mdi-18px mdi-plus"> Ajouter</i></button>
            @endcan
            <table class="table table-bordered text-center" id="myTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Agent</th>
                    <th>Date d??but</th>
                    <th>Date fin</th> '
                    <th>??colde de formation</th>
                    <th>Dipl??me</th>
                    <th>Niveau d'??tude</th>
                    <th>??quivalence du dipl??me</th>
                    <th>Actions</th>
                </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(function () {
            @include('dynamicDropDown');
            @include('dataTableAjax', ['columns' => "[
                { data: 'id', name: 'id' },
                { data: 'agent', name: 'agent' },
                { data: 'date_debut', name: 'date_debut' },
                { data: 'date_fin', name: 'date_fin' },
                { data: 'ecoleFormation', name: 'ecoleFormation' },
                { data: 'diplome', name: 'diplome' },
                { data: 'niveauEtude', name: 'niveauEtude' },
                { data: 'equivalenceDiplome', name: 'equivalenceDiplome' },
                { data: 'actions', name: 'Actions', searchable: false, orderable: false },
            ]", 'route' => route('formation.index')], ['scroll' => '450px'])
        })

        @if($errors->any())
            $('#add').modal('show')
        @endif

        let $modal = $('#add')
        let $debut = $('#date_debut')
        let $fin = $('#date_fin')
        let $ecole = $('#ecole_formation_id')
        let $diplome = $('#diplome_id')
        let $niveau = $('#niveau_etude_id')
        let $equivalence = $('#equivalence_diplome_id')
        let $agent = $('#agent_id')
        let $form = $('form')

        function updateFormation(id) {
            let $el = $('#formation'+id)
            let $agent_id = $el.attr('data-agent');
            $.ajax({
                type: 'GET',
                url: "/get_agent/" + $agent_id
            }).then(function (data) {
                let option = new Option(data.text, data.id, true, true);
                $(".agent").append(option).trigger('change')
            });
            $modal.modal('show')
            $debut.val($el.attr('data-debut'))
            $fin.val($el.attr('data-fin'))
            $ecole.val($el.attr('data-ecole'))
            $diplome.val($el.attr('data-diplome'))
            $niveau.val($el.attr('data-niveau'))
            $equivalence.val($el.attr('data-equivalence'))
            $agent.val($el.attr('data-agent'))
            $form.attr('action', $el.attr('data-route'))
            $form.append("<input type='hidden' name='_method' value='PUT'>")
        }

        $modal.on('hidden.bs.modal', function (e) {
            $debut.val(null)
            $fin.val(null)
            $ecole.val(null)
            $diplome.val(null)
            $niveau.val(null)
            $equivalence.val(null)
            $form.attr('action', '')
            $('input[name="_method"]').remove()
        })
    </script>
@endsection
