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
                            {!! form_row($form->date_debut) !!}
                            {!! form_row($form->date_fin) !!}
                            {!! form_row($form->agent_id) !!}
                            {!! form_row($form->ecole_formation_id) !!}
                        </div>
                        <div class="col-md-6">
                            {!! form_row($form->diplome_id) !!}
                            {!! form_row($form->niveau_etude_id) !!}
                            {!! form_row($form->equivalence_diplome_id) !!}
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

    <div class="card card-outline-info">
        <div class="card-body">
            <h3 class="text-center label-default">Les formations</h3>

            <button data-toggle="modal" data-target="#add" data-whatever="@getbootstrap" class="btn btn-themecolor btn-sm"><i class="mdi font-weight-bold mdi-18px mdi-plus"> Ajouter</i></button>

            <table class="table table-bordered text-center" id="myTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Date début</th>
                    <th>Date fin</th> '
                    <th>Écolde de formation</th>
                    <th>Diplôme</th>
                    <th>Niveau d'étude</th>
                    <th>Équivalence du diplôme</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($formations as $formation)
                    <tr>
                        <td>{{ $formation->id }}</td>
                        <td>{{ $formation->date_debut }}</td>
                        <td>{{ $formation->date_fin }}</td>
                        <td>{{ $formation->ecoleFormation->name }}</td>
                        <td>{{ $formation->diplome->name }}</td>
                        <td>{{ $formation->niveauEtude->name }}</td>
                        <td>{{ $formation->equivalenceDiplome->name }}</td>
                        <td>
                            <button id="formation{{ $formation->id }}"
                                    data-debut="{{ $formation->date_debut }}"
                                    data-fin="{{ $formation->date_fin }}"
                                    data-ecole="{{ $formation->ecole_formation_id }}"
                                    data-diplome="{{ $formation->diplome_id }}"
                                    data-niveau="{{ $formation->niveau_etude_id }}"
                                    data-equivalence="{{ $formation->equivalence_diplome_id }}"
                                    data-route="{{ route('formation.update', $formation) }}"
                                    onclick="updateFormation({{ $formation->id }})" class="btn btn-sm btn-outline-warning">
                                <i class="mdi mdi-18px mdi-pencil"></i>
                            </button>


                            <form action="{{ route('formation.destroy', $formation) }}" id="del{{ $formation->id }}" style="display: inline-block;" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-outline-danger btn-sm" type="button"
                                onclick="myHelpers.deleteConfirmation('{{ 'del'. $formation->id }}')">
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
        let $debut = $('#date_debut')
        let $fin = $('#date_fin')
        let $ecole = $('#ecole_formation_id')
        let $diplome = $('#diplome_id')
        let $niveau = $('#niveau_etude_id')
        let $equivalence = $('#equivalence_diplome_id')
        let $form = $('form')


        function updateFormation(id) {
            let $el = $('#formation'+id)
            $modal.modal('show')
            $debut.val($el.attr('data-debut'))
            $fin.val($el.attr('data-fin'))
            $ecole.val($el.attr('data-ecole'))
            $diplome.val($el.attr('data-diplome'))
            $niveau.val($el.attr('data-niveau'))
            $equivalence.val($el.attr('data-equivalence'))
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