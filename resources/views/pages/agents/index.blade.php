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

    <div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Modification Agent</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="card-body wizard-content">
                        {!! form_start($form) !!}
                            <!-- Step 1 -->
                            <h6>Identification Agent</h6>
                            <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! form_row($form->matricule) !!} </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! form_row($form->nom) !!} </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! form_row($form->prenom) !!} </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! form_row($form->sexe) !!} </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! form_row($form->date_naiss) !!} </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! form_row($form->lieu_naiss) !!} </div>
                                    </div>
                                    <div class="col-md-6 offset-3">
                                        <div class="form-group">
                                            {!! form_row($form->nationnalite) !!} </div>
                                    </div>
                                </div>
                            </section>
                            <!-- Step 2 -->
                            <h6>Situation Matrimoniale</h6>
                            <section>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! form_row($form->matrimoniale_id) !!} </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            {!! form_row($form->date) !!} </div>
                                    </div>
                                </div>
                            </section>
                            <!-- Step 3 -->
                            <h6>Situation Administrative</h6>
                            <section>
                                <div class="row">
                                    <div class="col-md-6 offset-3">
                                        <div class="form-group">
                                            <div class="offset-4">{!! form_label($form->type) !!}</div>
                                            {!! form_widget($form->type) !!}
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="titulaire" hidden>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! form_row($form->ref_engagement) !!} </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! form_row($form->date_engagement) !!} </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! form_row($form->date_titularisation) !!} </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4" id="category" hidden>
                                        <div class="form-group">
                                            {!! form_row($form->category_id) !!} </div>
                                    </div>
                                    <div class="col-md-6" id="contractuel" hidden>
                                        <div class="form-group">
                                            {!! form_row($form->date_prise_service) !!} </div>
                                    </div>
                                    <div class="col-md-4" id="classe" hidden>
                                        <div class="form-group">
                                            {!! form_row($form->classe_id) !!} </div>
                                    </div>
                                    <div class="col-md-4" id="echelon" hidden>
                                        <div class="form-group">
                                            {!! form_row($form->echelon_id) !!} </div>
                                    </div>
                                </div>
                            </section>
                            <!-- Step 4 -->
                            <h6>Niveau Etude</h6>
                            <section>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! form_row($form->ecole_formation_id) !!} </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! form_row($form->niveau_etude_id) !!} </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! form_row($form->diplome_id) !!} </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! form_row($form->equivalence_diplome_id) !!} </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! form_row($form->date_debut) !!} </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! form_row($form->date_fin) !!} </div>
                                    </div>
                                </div>
                            </section>
                            <!-- Step 5 -->
                            <h6>Autres informations</h6>
                            <section>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! form_row($form->maladie_id) !!} </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! form_row($form->observation) !!} </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            {!! form_row($form->date_observation) !!} </div>
                                    </div>
                                </div>
                            </section>
                        {!! form_end($form) !!}
                    </div>
                </div>
            </div>
        </div>
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

        function editData(id) {
            save_method = 'edit';
            $('input[name=_method]').val('PATCH');
            $('#modal-form form')[0].reset();
            $.ajax({
                url: "{{ url('admin/users') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#modal-form').modal('show');
                    $('#id').val(data.id);
                    $('#name').val(data.name);
                    $('#username').val(data.username);
                    $('#email').val(data.email);
                    $('#telephone').val(data.telephone);
                    if(data.role == 'User'){
                        $('#switcher').prop("checked",true);
                    }else{
                        $('#switcher').prop("checked",false);
                    }
                },
                error : function() {
                    swal({
                        type: 'error',
                        title: 'Accès refusé ... !',
                        text: 'Aucune donnée.',
                    })
                }
            });
        }

        function deleteData(id){
            var csrf_token = $('meta[name="csrf-token"]').attr('content');
            swal({
                title: 'Êtes-vous sûr?',
                text: "Vous ne pourrez pas revenir en arrière!",
                type: 'warning',
                showCancelButton: true,
                cancelButtonColor: '#d33',
                cancelButtonText:'Annuler',
                confirmButtonColor: '#3085d6',
                confirmButtonText: 'Oui, Supprimer cet Utilisateur!'
            }).then(function () {
                $.ajax({
                    url : "{{ url('admin/users') }}" + '/' + id,
                    type : "POST",
                    data : {'_method' : 'DELETE', '_token' : csrf_token},
                    success : function(data) {
                        table.ajax.reload();
                        swal({
                            title: 'Success!',
                            text: data.message,
                            type: 'success',
                            timer: '1500'
                        })
                    },
                    error : function () {
                        swal({
                            title: 'Oops...',
                            text: data.message,
                            type: 'error',
                            timer: '1500'
                        })
                    }
                });
            });
        }

        $(function(){
            $('#modal-form form').on('submit', function (e) {
                if (!e.isDefaultPrevented()){
                    let id = $('#id').val();
                    url = "{{ url('admin/users') . '/' }}" + id;
                    $.ajax({
                        url : url,
                        type : "POST",
                        data: new FormData($("#modal-form form")[0]),
                        contentType: false,
                        processData: false,
                        success : function(data) {
                            $('.invalid-feedback').html('');
                            $('.form-control').removeClass('is-invalid');
                            if(data.errors){
                                $.each(data.errors, function(key, value){
                                    $('.'+key).show();
                                    $('.'+key).append('<strong>'+ value +'</strong>');
                                    $('#'+key).addClass('is-invalid');
                                });
                            } else {
                                $('#modal-form').modal('hide');
                                table.ajax.reload();
                                swal({
                                    title: 'Success!',
                                    html: data.message,
                                    type: 'success',
                                    showConfirmButton: false,
                                    animation: false,
                                    customClass: 'animated tada',
                                    timer: '1700'
                                })
                            }
                        },
                        error : function(data){
                            swal({
                                title: 'Oops...',
                                text: "Une erreur s'est produite, veuillez réactualiser la page, ou contacter l'administrateur !",
                                type: 'error',
                                timer: '1500'
                            });
                        }
                    });
                    return false;
                }
            });
        });

    </script>
    <script src="{{asset('material/plugins/wizard/jquery.validate.min.js')}}"></script>
    <script src="{{asset('material/plugins/wizard/steps.js')}}"></script>
@stop
