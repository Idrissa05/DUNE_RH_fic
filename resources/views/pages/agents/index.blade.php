@extends('layouts.material')

@section('content')
    <div class="page-section">
        <section class="card card-fluid">
            <h3 class="m-b-0 text-white text-center bg-primary">Liste des Agents</h3>
            <div class="card-body">
                <div class="table-responsive m-t-0">
                    <a href="{{route('agent.create')}}" class="btn btn-primary"><i class="mdi mdi-plus"></i> Ajouter</a>
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="30">No</th>
                            <th>Matricule</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Date Naissance</th>
                            <th>Sexe</th>
                            <th>Nationnalité</th>
                            <th>Type Agent</th>
                            <th>Lieu Naissance</th>
                            <th>Actions</th>
                        </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </section>
    </div>

@endsection

@section('js')
    <script>
        $(document).ready(function () {
            $('#myTable').DataTable({
                language: {
                    processing:     "Traitement en cours...",
                    search:         "Rechercher&nbsp;:",
                    lengthMenu:    "Afficher _MENU_ &eacute;l&eacute;ments",
                    info:           "Affichage de l'&eacute;lement _START_ &agrave; _END_ sur _TOTAL_ &eacute;l&eacute;ments",
                    infoEmpty:      "Affichage de l'&eacute;lement 0 &agrave; 0 sur 0 &eacute;l&eacute;ments",
                    infoFiltered:   "(filtr&eacute; de _MAX_ &eacute;l&eacute;ments au total)",
                    infoPostFix:    "",
                    loadingRecords: "Chargement en cours...",
                    zeroRecords:    "Aucun &eacute;l&eacute;ment &agrave; afficher",
                    emptyTable:     "Aucune donnée disponible dans le tableau",
                    paginate: {
                        first:      "Premier",
                        previous:   "Pr&eacute;c&eacute;dent",
                        next:       "Suivant",
                        last:       "Dernier"
                    },
                    aria: {
                        sortAscending:  ": activer pour trier la colonne par ordre croissant",
                        sortDescending: ": activer pour trier la colonne par ordre décroissant"
                    }
                },
                processing: true,
                serverSide: true,
                ajax: "{{route('agent.index')}}",
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'matricule', name: 'matricule'},
                    {data: 'nom', name: 'nom'},
                    {data: 'prenom', name: 'prenom'},
                    {data: 'date_naiss', name: 'date_naiss'},
                    {data: 'sexe', name: 'sexe'},
                    {data: 'nationnalite', name: 'nationnalite'},
                    {data: 'type', name: 'type'},
                    {data: 'lieu_naiss', name: 'lieu_naiss'},
                    {data: 'action', name: 'action', orderable: false, searchable: false}
                ],
            });

            $('#date_naiss, #date, #date_engagement, #date_titularisation, #date_prise_service, #date_debut, #date_fin, #date_observation').flatpickr({'locale' : 'fr'});
            $('#type').on('change', function(e){
                if($("#type option:selected").val() == 'Contractuel'){
                    $('#titulaire, #category, #classe, #echelon').hide();
                    $('#ref_engagement, #date_engagement, #date_titularisation, #classe_id, #echelon_id').removeAttr('required').val('');
                    $('#category').removeClass('col-md-4').addClass('col-md-6');
                    $('#contractuel, #category').removeAttr('hidden').show();
                    $('#date_prise_service').attr('required', true);
                }else if($("#type option:selected").val() == 'Titulaire'){
                    $('#contractuel, #category').hide();
                    $('#date_prise_service').removeAttr('required').val('');
                    $('#category').removeClass('col-md-6').addClass('col-md-4');
                    $('#titulaire, #category, #classe, #echelon').removeAttr('hidden').show();
                    $('#ref_engagement, #date_engagement, #date_titularisation, #classe_id, #echelon_id').attr('required', true);
                }else $('#titulaire, #contractuel, #category, #classe, #echelon').hide();

            });
        });

    </script>
    <script src="{{asset('material/plugins/wizard/jquery.validate.min.js')}}"></script>
    <script src="{{asset('material/plugins/wizard/steps.js')}}"></script>
@stop
