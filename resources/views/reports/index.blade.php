@extends('layouts.material')

@section('css')
    <link rel="stylesheet" href="{{asset('builder/query-builder.default.min.css')}}">
@stop

@section('content')
    <div class="page-section">
        <section class="card card-fluid">
            <h3 class="m-b-0 text-white text-center bg-primary">Générateur de Requêtes (Etats / Rapports)</h3>
            <div class="card-body">
                <div class="form-row">
                    <div class="col col-md-8 justify-content-center m-t-20">
                        <div id="builder"></div>
                    </div><br>
                    <div class="col col-lg-4 justify-content-center">
                        <div>
                            <h5 class="box-title col-md-8 offset-2">Liste des Champs à Afficher :</h5>
                            @include('.reports.fields')
                        </div>
                        <div class="col offset-md-1 justify-content-center button-box m-t-10">
                            <a id="select-all" class="btn btn-outline-warning" href="#">Sélectionner Tout</a>
                            <a id="deselect-all" class="btn btn-outline-primary" href="#">Désélectionner Tout</a>
                        </div>
                    </div>
                </div>
                <div class="col btn-group justify-content-center m-t-10">
                    <button class="btn btn-danger col-md-1" id="reset">Reset</button>
                    <button class="btn btn-info text-white col-md-2" id="save-sql">Sauvegarder</button>
                    <select class="col-md-6" id="list-sql" name="list-sql">
                        <option value="0">Sélectionner</option>
                        @foreach ($queries as $query)
                            <option value="{{$query->id}}">{{ $query->name }}</option>
                        @endforeach
                    </select>
                    <button class="btn btn-info text-white col-md-1" id="set-sql">Charger</button>
                    <button class="btn btn-primary col-md-2" id="query">Exécuter</button>
                </div>
                <div><h3 class="col-md-4 offset-4 m-b-0 m-t-30 text-dark text-center bg-light-extra">Tableau des Résultats</h3></div>
                <div class="table-responsive m-t-0">
                    <table id="myTable" class="table table-bordered table-striped"></table>
                </div>
            </div>
        </section>
    </div>

    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Sauvegarde Requête</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <form method="POST" accept-charset="UTF-8">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="name" class="control-label required">Requête</label>
                            <input class="form-control" required="required" name="name" type="text" id="name" placeholder="Nom de la Requête" autofocus>
                            <span class="invalid-feedback name" role="alert"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@stop

@section('js')
    <script src="{{asset('builder/query-builder.standalone.min.js')}}"></script>
    <script src="{{asset('builder/sql-parser.min.js')}}"></script>
    <script src="{{asset('builder/query-builder.fr.js')}}"></script>

    <script src="{{asset('builder/dataTables/jszip.min.js')}}"></script>
    <script src="{{asset('builder/dataTables/vfs_fonts.js')}}"></script>

    <script>
        $('#list-sql').select2();
        $('#fields').multiSelect({
            selectableOptgroup: true
        });
        $('#select-all').click(function() {
            $('#fields').multiSelect('select_all');
            return false;
        });
        $('#deselect-all').click(function() {
            $('#fields').multiSelect('deselect_all');
            return false;
        });

        let MyTableElement = $('#myTable');
        let MyTable = MyTableElement.DataTable({
            language: {emptyTable: "Aucune donnée disponible dans le tableau"},
            columns: [{data: '', name: '', title: ''}],
            paging: false,
            searching: false,
            info: false,
            sort: false
        });

        $(document).ready(function(){
            let query = null;
            $('#builder').queryBuilder({
                plugins: {
                    'filter-description': {mode: 'inline'},
                    'unique-filter': null,
                    'bt-selectpicker': null,
                    'bt-checkbox': null,
                    'invert': null
                },
                icons: {
                    add_group: 'fas fa-plus-circle',
                    add_rule: 'fas fa-plus',
                    remove_group: 'fas fa-minus-square',
                    remove_rule: 'fas fa-minus-circle',
                    error: 'fas fa-exclamation-triangle',
                },
                filters: [
                    { optgroup: 'Agents', id: 'matricule', label: 'Matricule', type: 'string' },
                    { optgroup: 'Agents', id: 'nom', label: 'Nom', type: 'string' },
                    { optgroup: 'Agents', id: 'prenom', label: 'Prénom', type: 'string' },
                    { optgroup: 'Agents', id: 'sexe', label: 'Sexe', type: 'string', input: 'radio', values: ['F', 'M'], operators: ['equal','not_equal'] },
                    { optgroup: 'Agents', id: 'date_naiss', label: 'Date Naissance', type: 'date' },
                    { optgroup: 'Agents', id: 'lieu_naiss', label: 'Lieu Naissance', type: 'string' },
                    { optgroup: 'Agents', id: 'ref_acte_naiss', label: 'Ref Acte Naissance', type: 'string' },
                    { optgroup: 'Agents', id: 'date_etablissement_acte_naiss', label: 'Date Etablissement Acte Naissance', type: 'string' },
                    { optgroup: 'Agents', id: 'lieu_etablissement_acte_naiss', label: 'Lieu Etablissement Acte Naissance', type: 'string' },
                    { optgroup: 'Agents', id: 'nationnalite', label: 'Nationnalité', type: 'string' },
                    { optgroup: 'Agents', id: 'agents_type', label: 'Type Agent', type: 'string', input: 'select', values: ['Auxiliaire', 'Contractuel', 'Titulaire', 'Civicard'], operators: ['equal', 'not_equal'] },
                    { optgroup: 'Agents', id: 'date_prise_service', label: 'Date Prise Service', type: 'date' },
                    { optgroup: 'Agents', id: 'ministere', label: 'Ministère', type: 'string' },
                    { optgroup: 'Agents', id: 'region', label: 'Région', type: 'string' },

                    { optgroup: 'Affectations', id: 'ref_affectation', label: 'Ref affectation', type: 'string' },
                    { optgroup: 'Affectations', id: 'date_affectation', label: 'Date', type: 'date' },
                    { optgroup: 'Affectations', id: 'date_prise_effet_affectation', label: 'Date prise effet', type: 'date' },
                    { optgroup: 'Affectations', id: 'observation_affectation', label: 'Observation', type: 'string' },
                    { optgroup: 'Affectations', id: 'type_etablissement', label: 'Type établissement', type: 'string' },
                    { optgroup: 'Affectations', id: 'etablissement', label: 'Etablissement', type: 'string' },
                    { optgroup: 'Affectations', id: 'secteur_pedagogique', label: 'Secteur pédagogique', type: 'string' },
                    { optgroup: 'Affectations', id: 'inpection', label: 'Inspection', type: 'string' },
                    { optgroup: 'Affectations', id: 'commune', label: 'Commune', type: 'string' },
                    { optgroup: 'Affectations', id: 'departement', label: 'Département', type: 'string' },

                    { optgroup: 'Congés', id: 'ref_decision_conge', label: 'Ref décision', type: 'string' },
                    { optgroup: 'Congés', id: 'date_debut_conge', label: 'Date début', type: 'date' },
                    { optgroup: 'Congés', id: 'date_fin_conge', label: 'Date fin', type: 'date' },
                    { optgroup: 'Congés', id: 'observation_conge', label: 'Observation', type: 'string' },

                    { optgroup: 'Conjoints', id: 'matricule_conjoint', label: 'Matricule/Code', type: 'string' },
                    { optgroup: 'Conjoints', id: 'nom_conjoint', label: 'Nom', type: 'string' },
                    { optgroup: 'Conjoints', id: 'prenom_conjoint', label: 'Prénom', type: 'string' },
                    { optgroup: 'Conjoints', id: 'date_naiss_conjoint', label: 'Date Naissance', type: 'date' },
                    { optgroup: 'Conjoints', id: 'lieu_naiss_conjoint', label: 'Lieu Naissance', type: 'string' },
                    { optgroup: 'Conjoints', id: 'ref_acte_naiss_conjoint', label: 'Ref Acte Naissance', type: 'string' },
                    { optgroup: 'Conjoints', id: 'sexe_conjoint', label: 'Sexe', type: 'string', input: 'radio', values: ['F', 'M'], operators: ['equal','not_equal'] },
                    { optgroup: 'Conjoints', id: 'nationnalite_conjoint', label: 'Nationnalité', type: 'string' },
                    { optgroup: 'Conjoints', id: 'tel_conjoint', label: 'Téléphone', type: 'string' },
                    { optgroup: 'Conjoints', id: 'employeur_conjoint', label: 'Employeur', type: 'string' },
                    { optgroup: 'Conjoints', id: 'profession_conjoint', label: 'Profession', type: 'string' },
                    { optgroup: 'Conjoints', id: 'ref_acte_mariage', label: 'Ref Acte maraige', type: 'string' },
                    { optgroup: 'Conjoints', id: 'date_mariage', label: 'Date Mariage', type: 'date' },

                    { optgroup: 'Décès', id: 'date_deces', label: 'Date', type: 'date' },
                    { optgroup: 'Décès', id: 'ref_document_deces', label: 'Ref document', type: 'string' },
                    { optgroup: 'Décès', id: 'observation_deces', label: 'Cause', type: 'string' },

                    { optgroup: 'Enfants', id: 'prenom_enfant', label: 'Prénom', type: 'string' },
                    { optgroup: 'Enfants', id: 'date_naiss_enfant', label: 'Date Naissance', type: 'date' },
                    { optgroup: 'Enfants', id: 'lieu_naiss_enfant', label: 'Lieu Naissance', type: 'string' },
                    { optgroup: 'Enfants', id: 'ref_acte_naiss_enfant', label: 'Ref Acte Naissance', type: 'string' },
                    { optgroup: 'Enfants', id: 'sexe_enfant', label: 'Sexe', type: 'string', input: 'radio', values: ['F', 'M'], operators: ['equal','not_equal'] },

                    { optgroup: 'Formations', id: 'date_debut_formation', label: 'Date début', type: 'date' },
                    { optgroup: 'Formations', id: 'date_fin_formation', label: 'Date fin', type: 'date' },
                    { optgroup: 'Formations', id: 'ecole_formation', label: 'Ecole Formation', type: 'string' },
                    { optgroup: 'Formations', id: 'diplome', label: 'Diplôme', type: 'string' },
                    { optgroup: 'Formations', id: 'niveau_etude', label: "Niveau d'études", type: 'string' },
                    { optgroup: 'Formations', id: 'equivalence_diplome', label: 'Equivalence diplôme', type: 'string' },

                    { optgroup: 'Expériences', id: 'organisation_experience', label: 'Organisation', type: 'string' },
                    { optgroup: 'Expériences', id: 'date_debut_experience', label: 'Date début', type: 'date' },
                    { optgroup: 'Expériences', id: 'date_fin_experience', label: 'Date fin', type: 'date' },
                    { optgroup: 'Expériences', id: 'fonction_experience', label: 'Fonction', type: 'string' },
                    { optgroup: 'Expériences', id: 'tache_experience', label: 'Tâches', type: 'string' },
                    { optgroup: 'Expériences', id: 'observation_experience', label: 'Observation', type: 'string' },

                    { optgroup: 'Grades', id: 'grades_type', label: 'Type Grade (titre)', type: 'string', input: 'select', values: ['Avancement', 'Auxiliairement', 'Contrat', 'Reclassement', 'Titularisation'], operators: ['equal', 'not_equal'] },
                    { optgroup: 'Grades', id: 'ref_avancement', label: 'Ref Avancement', type: 'string' },
                    { optgroup: 'Grades', id: 'date_decision_avancement', label: 'Date décision Avancement', type: 'date' },
                    { optgroup: 'Grades', id: 'observation_avancement', label: 'Observation Avancement', type: 'string' },
                    { optgroup: 'Grades', id: 'ref_reclassement', label: 'Ref Reclassement', type: 'string' },
                    { optgroup: 'Grades', id: 'date_reclassement', label: 'Date Reclassement', type: 'date' },
                    { optgroup: 'Grades', id: 'ref_titularisation', label: 'Ref Titularisation', type: 'string' },
                    { optgroup: 'Grades', id: 'date_titularisation', label: 'Date Titularisation', type: 'date' },
                    { optgroup: 'Grades', id: 'ref_engagement', label: 'Ref Engagement', type: 'string' },
                    { optgroup: 'Grades', id: 'date_engagement', label: 'Date Engagement', type: 'date' },
                    { optgroup: 'Grades', id: 'fonction', label: 'Fonction', type: 'string' },
                    { optgroup: 'Grades', id: 'corps', label: 'Corps', type: 'string' },
                    { optgroup: 'Grades', id: 'cadre', label: 'Cadre', type: 'string' },
                    { optgroup: 'Grades', id: 'category_auxiliaire', label: 'Catégorie Auxiliare', type: 'string' },
                    { optgroup: 'Grades', id: 'category', label: 'Catégorie', type: 'string' },
                    { optgroup: 'Grades', id: 'classe', label: 'Classe', type: 'string' },
                    { optgroup: 'Grades', id: 'echelon', label: 'Echelon', type: 'string' },
                    { optgroup: 'Grades', id: 'indice', label: 'Indice', type: 'string' },
                    { optgroup: 'Grades', id: 'salary', label: 'Salaire', type: 'string' },

                    { optgroup: 'Maladies', id: 'maladie', label: 'Maladie', type: 'string' },
                    { optgroup: 'Maladies', id: 'observation_maladie', label: 'Observation', type: 'string' },
                    { optgroup: 'Maladies', id: 'date_observation_maladie', label: 'Date Observation', type: 'date' },

                    { optgroup: 'Matrimoniales', id: 'matrimoniale', label: 'Situation matrimoniale', type: 'string', input: 'select', values: ['Célibataire', 'Marié(e)', 'Divorcé(e)', 'Veuf/Veuve'], operators: ['equal', 'not_equal'] },
                    { optgroup: 'Matrimoniales', id: 'date_matrimoiale', label: 'Date', type: 'date' },

                    { optgroup: 'Migrations', id: 'old_matricule', label: 'Ancien Code/Matricule Agent', type: 'string' },
                    { optgroup: 'Migrations', id: 'old_agents_type', label: 'Ancien Type Agent', type: 'string', input: 'select', values: ['Auxiliaire', 'Contractuel', 'Titulaire', 'Civicard'], operators: ['equal', 'not_equal'] },

                    { optgroup: 'Notations', id: 'date_debut_notation', label: 'Date début', type: 'date' },
                    { optgroup: 'Notations', id: 'date_fin_notation', label: 'Date fin', type: 'date' },
                    { optgroup: 'Notations', id: 'note', label: 'Note', type: 'double' },
                    { optgroup: 'Notations', id: 'responsable_notation', label: 'Responsable', type: 'string' },
                    { optgroup: 'Notations', id: 'observation_notation', label: 'Appréciations', type: 'string' },

                    { optgroup: 'Positions administratives', id: 'position', label: 'Position', type: 'string' },
                    { optgroup: 'Positions administratives', id: 'date_effet_position', label: 'Date effet', type: 'date' },
                    { optgroup: 'Positions administratives', id: 'ref_decision_position', label: 'Ref décision', type: 'string' },
                    { optgroup: 'Positions administratives', id: 'date_decision_position', label: 'Date décision', type: 'date' },
                    { optgroup: 'Positions administratives', id: 'date_fin_position', label: 'Date fin', type: 'date' },
                    { optgroup: 'Positions administratives', id: 'observation_position', label: 'Observation', type: 'string' },

                    { optgroup: 'Retraites', id: 'date_retraite', label: 'Date', type: 'date' },
                    { optgroup: 'Retraites', id: 'ref_decision_retraite', label: 'Ref décision', type: 'string' },
                    { optgroup: 'Retraites', id: 'date_decision_retraite', label: 'Date décision', type: 'date' },
                    { optgroup: 'Retraites', id: 'lieu_retraite', label: 'Lieu', type: 'string' },
                    { optgroup: 'Retraites', id: 'contact_retraite', label: 'Contact', type: 'string' },
                    { optgroup: 'Retraites', id: 'observation_retraite', label: 'Observation', type: 'string' },
                ],
            }).removeClass('form-inline');

            $('#reset').on('click', function() {
                $('#builder').queryBuilder('reset');
                MyTable.destroy();
                MyTableElement.empty();
                MyTable = MyTableElement.DataTable({
                    language: {emptyTable: "Aucune donnée disponible dans le tableau"},
                    columns: [{data: '', name: '', title: ''}],
                    paging: false,
                    searching: false,
                    info: false,
                    sort: false
                });
                $('#fields').multiSelect('deselect_all');
                return false;
            });

            $('#set-sql').on('click', function() {
                let id = $("#list-sql").val();
                if(id !== '0'){
                    $.get('/query_get?id=' + id,function(data) {
                        $('#builder').queryBuilder('setRulesFromSQL', data.sql);
                        $('#fields').multiSelect('deselect_all').multiSelect('select', data.fields);
                    });
                }
            });

            $('#query').on('click', function(e) {
                let _rules = $('#builder').queryBuilder('getRules');
                let rules = JSON.stringify(_rules);
                if ($.fn.dataTable.isDataTable('#myTable') && _rules != null) {
                    let columns = [];
                    $('#fields :selected').each(function(i, selected) {
                        columns.push({data: $(selected).val(), name: $(selected).val(), title: $(selected).text()})
                    });

                    if(columns.length){
                        MyTable.destroy();
                        MyTableElement.empty();
                        MyTable = MyTableElement.DataTable({
                            dom: 'Bfrtip',
                            buttons: [
                                'excel', 'pdf', 'print'
                            ],
                            language: {
                                info:           "<i>Total</i> = <b> _TOTAL_ </b>",
                                infoEmpty:      "<i>Total</i> = <b> _TOTAL_ </b>",
                                loadingRecords: "Chargement en cours...",
                                emptyTable:     "Aucune donnée disponible dans le tableau",
                                processing:     "<h4>Traitement en cours...</h4>",
                            },
                            searching: false,
                            serverSide: true,
                            processing: true,
                            pageLength: 100,
                            ajax:{
                                beforeSend: function(xhr) {
                                    xhr.setRequestHeader('X-CSRF-Token', $('meta[name="csrf-token"]').attr('content'))
                                },
                                url: "{{route('report.show')}}",
                                type: "POST",
                                data: {rules: rules}
                            },
                            columns: columns
                        });
                    }else {
                        swal({
                            title: 'Aucun Champs Sélectionné...',
                            text: "Veuillez choisir les champs à afficher dans le Tableau !",
                            icon: 'warning',
                            timer: '5000',
                            dangerMode :true
                        });
                    }
                }
            });

            $('#save-sql').on('click', function() {
               let result = $('#builder').queryBuilder('getSQL', false);
                if (result.sql.length) {
                    $('#add form')[0].reset();
                    query = result.sql;
                }
                $('#add').modal('show');
            });

            $(function(){
                $('#add form').on('submit', function (e) {
                    if (!e.isDefaultPrevented()){
                        $("<input />").attr("type", "hidden").attr("name", "sql").attr("value", query).appendTo(this);
                        $("<input />").attr("type", "hidden").attr("name", "fields").attr("value", $('#fields').val()).appendTo(this);
                        $.ajax({
                            url : "{{ route('query.store') }}",
                            type : "POST",
                            data: new FormData($("#add form")[0]),
                            contentType: false,
                            processData: false,
                            success : function(data) {
                                $('.invalid-feedback').html('');
                                $('.form-control').removeClass('is-invalid');
                                if(data.errors){
                                    if(data.errors['name']){
                                        $.each(data.errors['name'], function(key, value){
                                            $('.name').show().append('<br>'+'<strong>'+ value +'</strong>');
                                            $('#name').addClass('is-invalid');
                                        });
                                    }else {
                                        swal({
                                            title: 'Oops...',
                                            text: "Requête vide, veuillez définir d'abord une requête !",
                                            icon: 'error',
                                            timer: '3000',
                                            dangerMode :true
                                        });
                                    }
                                }else {
                                    $('#add').modal('hide');
                                    $('#list-sql').append('<option value="'+ data.id +'">'+ data.name +'</option>');
                                    swal({
                                        title: "Enregistré !",
                                        text: "La requête a été enregistrée avec succès.",
                                        icon: "success",
                                    });
                                }
                            },
                            error : function(){
                                swal({
                                    title: 'Oops...',
                                    text: "Une erreur s'est produite, veuillez réactualiser la page, ou contacter l'administrateur !",
                                    icon: 'error',
                                    timer: '3000',
                                    dangerMode :true
                                });
                            }
                        });
                        return false;
                    }
                });
            });
        });
    </script>
@stop
