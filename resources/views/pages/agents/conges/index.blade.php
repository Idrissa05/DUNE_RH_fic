@extends('layouts.material')


@section('content')

    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Prise de congé</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                {!! form_start($form) !!}
                <div class="modal-body">

                    {!! form_row($form->agent_id) !!}
                    {!! form_row($form->ref_decision) !!}
                    {!! form_row($form->date_debut) !!}
                    {!! form_row($form->date_fin) !!}
                    {!! form_row($form->observation) !!}

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
                {!! form_end($form) !!}
            </div>
        </div>
    </div>

    <h3 class="m-b-0 text-white text-center bg-primary">Les congés</h3>

    <div class="card card-outline-info">
        <div class="card-body">

            <button data-toggle="modal" data-target="#add" data-whatever="@getbootstrap" class="btn btn-themecolor btn-sm"><i class="mdi font-weight-bold mdi-18px mdi-plus"> Ajouter</i></button>

            <table class="table table-bordered text-center" id="myTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Ref décision</th>
                    <th>Agent</th>
                    <th>Date début</th>
                    <th>Date fin</th> '
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
                { data: 'ref_decision', name: 'ref_decision' },
                { data: 'agent', name: 'agent' },
                { data: 'date_debut', name: 'date_debut' },
                { data: 'date_fin', name: 'date_fin' },
                { data: 'observation', name: 'observation' },
                { data: 'actions', name: 'Actions', searchable: false, orderable: false },
            ]", 'route' => route('conge.index')], ['scroll' => '450px'])
        })

        @if($errors->any())
            $('#add').modal('show')
        @endif

        let $modal = $('#add')
        let $ref = $('#ref_decision')
        let $debut = $('#date_debut')
        let $fin = $('#date_fin')
        let $observation = $('#observation')
        let $agent = $('#agent_id')
        let $form = $('form')


        function updateConge(id) {
            let $el = $('#conge'+id)
            $modal.modal('show')
            $ref.val($el.attr('data-ref'))
            $debut.val($el.attr('data-debut'))
            $fin.val($el.attr('data-fin'))
            $observation.val($el.attr('data-observation'))
            $agent.val($el.attr('data-agent'))
            $form.attr('action', $el.attr('data-route'))
            $form.append("<input type='hidden' name='_method' value='PUT'>")
        }

        $modal.on('hidden.bs.modal', function (e) {
            $ref.val(null)
            $debut.val(null)
            $fin.val(null)
            $observation.val(null)
            $agent.val(null)
            $form.attr('action', '')
            $('input[name="_method"]').remove()
        })
    </script>
@endsection