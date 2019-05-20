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

                    {!! form_row($form->ref_decision) !!}
                    {!! form_row($form->date_debut) !!}
                    {!! form_row($form->date_fin) !!}
                    {!! form_row($form->observation) !!}
                    {!! form_row($form->agent_id) !!}

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
            <h3 class="text-center label-default">Les congés</h3>

            <button data-toggle="modal" data-target="#add" data-whatever="@getbootstrap" class="btn btn-themecolor btn-sm"><i class="mdi font-weight-bold mdi-18px mdi-plus"> Ajouter</i></button>

            <table class="table table-bordered text-center" id="myTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Ref décision</th>
                    <th>Date début</th>
                    <th>Date fin</th> '
                    <th>Observation</th>
                    <th>Agent</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($conges as $conge)
                    <tr>
                        <td>{{ $conge->id }}</td>
                        <td>{{ $conge->ref_decision }}</td>
                        <td>{{ $conge->date_debut }}</td>
                        <td>{{ $conge->date_fin }}</td>
                        <td>{{ $conge->observation }}</td>
                        <td>{{ $conge->agent->matricule }}</td>
                        <td>
                            <button id="conge{{ $conge->id }}"
                                    data-ref="{{ $conge->ref_decision }}"
                                    data-debut="{{ $conge->date_debut }}"
                                    data-fin="{{ $conge->date_fin }}"
                                    data-observation="{{ $conge->observation }}"
                                    data-agent="{{ $conge->agent->id }}"
                                    data-route="{{ route('conge.update', $conge) }}"
                                    onclick="updateConge({{ $conge->id }})" class="btn btn-sm btn-outline-warning">
                                <i class="mdi mdi-18px mdi-pencil"></i>
                            </button>


                            <form action="{{ route('conge.destroy', $conge) }}" id="del{{ $conge->id }}" style="display: inline-block;" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-outline-danger btn-sm" type="button"
                                        onclick="myHelpers.deleteConfirmation('{{ 'del'. $conge->id }}')">
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
    @include('dataTable')
    <script>
        let $modal = $('#add')
        let $ref = $('#ref_decision')
        let $debut = $('#date_debut')
        let $fin = $('#date_fin')
        let $observation = $('#observation')
        let $agent = $('#agent_id')
        let $form = $('form')

        $debut.flatpickr()
        $fin.flatpickr()

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