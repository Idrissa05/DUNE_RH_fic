@extends('layouts.material')


@section('content')

    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Nouvelle position</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                {!! form_start($form) !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            {!! form_row($form->agent_id) !!}
                            {!! form_row($form->position_id) !!}
                            {!! form_row($form->ref_decision) !!}
                        </div>
                        <div class="col-md-6">
                            {!! form_row($form->date_decision) !!}
                            {!! form_row($form->date_effet) !!}
                            {!! form_row($form->date_fin) !!}
                            {!! form_row($form->observation) !!}
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

    <h3 class="m-b-0 text-white text-center bg-primary">Agent position</h3>

    <div class="card card-outline-info">
        <div class="card-body">

            <button data-toggle="modal" data-target="#add" data-whatever="@getbootstrap" class="btn btn-themecolor btn-sm"><i class="mdi font-weight-bold mdi-18px mdi-plus"> Ajouter</i></button>

            <table class="table table-bordered text-center" id="myTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Matricule</th> '
                    <th>Agent</th>
                    <th>Position</th>
                    <th>Réf. décision</th>
                    <th>Date décision</th>
                    <th>Date effet</th>
                    <th>Date fin</th>
                    <th>Observation</th>
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
            @include('dataTableAjax', ['columns' => "[
                { data: 'id', name: 'id' },
                { data: 'matricule', name: 'matricule' },
                { data: 'agent', name: 'agent' },
                { data: 'position', name: 'position' },
                { data: 'ref_decision', name: 'ref_decision' },
                { data: 'date_decision', name: 'date_decision' },
                { data: 'date_effet', name: 'date_effet' },
                { data: 'date_fin', name: 'date_fin' },
                { data: 'observation', name: 'observation' },
                { data: 'actions', name: 'Actions', searchable: false, orderable: false },
            ]", 'route' => route('agent-position.index')], ['scroll' => '450px'])
        })
    </script>
@endsection
