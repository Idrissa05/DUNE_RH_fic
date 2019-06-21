@extends('layouts.material')

@section('content')
    <div class="page-section">
        <section class="card card-fluid">
            <h3 class="m-b-0 text-white text-center bg-primary">Liste des Agents</h3>
            <div class="card-body">
                <div class="row">
                    <a href="{{route('agent.create')}}" class="btn btn-primary"><i class="mdi mdi-plus"></i> Ajouter</a>
                    <a href="{{route('print.agents')}}" class="btn btn-dark offset-lg-10" target="_blank"><i class="mdi mdi-printer"></i> Imprimer</a>
                </div>
                <div class="table-responsive m-t-0">
                    <table id="myTable" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th width="30">No</th>
                            <th>Matricule/Code</th>
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

    <div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title offset-4" id="exampleModalLabel1">MODIFICATION AGENT</h2>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                <div class="modal-body">
                    <div class="wizard-content">
                    {!! form_start($form) !!}
                        <!-- Step 1 -->
                        <h6>Identification Agent</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! form_row($form->type) !!}</div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! form_row($form->matricule) !!} </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! form_row($form->nom) !!} </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! form_row($form->prenom) !!} </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! form_row($form->sexe) !!} </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! form_row($form->date_naiss) !!} </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! form_row($form->lieu_naiss) !!} </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! form_row($form->nationnalite) !!} </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! form_row($form->ref_acte_naiss) !!} </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! form_row($form->date_etablissement_acte_naiss) !!} </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! form_row($form->lieu_etablissement_acte_naiss) !!} </div>
                                </div>
                            </div>
                        </section>

                        <!-- Step 2 -->
                        <h6>Situation Administrative</h6>
                        <section>
                            <div class="row"> <!--id="titulaire" hidden-->
                                <div class="col-md-4 titulaire">
                                    <div class="form-group">
                                        {!! form_row($form->ref_engagement) !!} </div>
                                </div>
                                <div class="col-md-4 titulaire">
                                    <div class="form-group">
                                        {!! form_row($form->date_engagement) !!} </div>
                                </div>
                                <div class="col-md-4 titulaire">
                                    <div class="form-group">
                                        {!! form_row($form->ref_titularisation) !!} </div>
                                </div>
                                <div class="col-md-4 titulaire">
                                    <div class="form-group">
                                        {!! form_row($form->date_titularisation) !!} </div>
                                </div>
                            <!--</div>
                            <div class="row" id="both">-->
                                <div class="col-md-4" id="contractuel" hidden>
                                    <div class="form-group">
                                        {!! form_row($form->date_prise_service) !!} </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! form_row($form->fonction_id) !!} </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {!! form_row($form->cadre_id) !!} </div>
                                </div>
                                <div class="col-md-4" id="corp">
                                    <div class="form-group">
                                        {!! form_row($form->corp_id) !!} </div>
                                </div>
                                <div class="col-md-4" id="auxiliaire" hidden>
                                    <div class="form-group">
                                        {!! form_row($form->category_auxiliaire_id) !!} </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group" id="category">
                                        {!! form_row($form->category_id) !!} </div>
                                </div>
                                <div class="col-md-4" id="classe" hidden>
                                    <div class="form-group">
                                        {!! form_row($form->classe_id) !!} </div>
                                </div>
                                <div class="col-md-4" id="echelon" hidden>
                                    <div class="form-group">
                                        {!! form_row($form->echelon_id) !!} </div>
                                </div>
                                <div class="col-md-4" id="indices" hidden>
                                    <div class="form-group">
                                        {!! form_row($form->indice) !!} </div>
                                </div>
                                <div class="col-md-4" id="salaries" hidden>
                                    <div class="form-group">
                                        {!! form_row($form->salary) !!} </div>
                                </div>
                                {!! form_widget($form->indice_id) !!}
                            </div>
                        </section>

                    {!! form_end($form, false) !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        $(document).ready(function () {
            @include('dataTableAjax', ['columns' => "[
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
                ]", 'route' => route('agent.index')], ['scroll' => '450px'])
            @include('dependentTypeFieldsEdit')
        });

        function editData(id) {
            $('#edit form')[0].reset();
            $.ajax({
                url: "{{ url('agent') }}" + '/' + id + "/edit",
                type: "GET",
                dataType: "JSON",
                success: function(data) {
                    $('#edit').modal('show');
                    $('#type').val(data[0].type);
                    $('#matricule').val(data[0].matricule);
                    $('#nom').val(data[0].nom);
                    $('#prenom').val(data[0].prenom);
                    $('#sexe').val(data[0].sexe);
                    $('#date_naiss').val(data[0].date_naiss);
                    $('#lieu_naiss').val(data[0].lieu_naiss);
                    $('#nationnalite').val(data[0].nationnalite);
                    $('#ref_acte_naiss').val(data[0].ref_acte_naiss);
                    $('#date_etablissement_acte_naiss').val(data[0].date_etablissement_acte_naiss);
                    $('#lieu_etablissement_acte_naiss').val(data[0].lieu_etablissement_acte_naiss);
                    $('#fonction_id').val(data[0].fonction_id);
                    $('#cadre_id').val(data[0].cadre_id);
                    $('#corp_id').val(data[0].corp_id);
                    @include('dependentTypeFieldsEdit')
                },
                error : function() {
                    swal({
                        type: 'error',
                        title: 'Accès refusé ... !',
                        text: 'Aucune donnée.',
                    })
                }
            });
            $('form').attr('action', $('#agent'+id).attr('data-route'))
            $('form').append("<input type='hidden' name='_method' value='PUT'>")
        }

        $('#edit').on('hidden.bs.modal', function (e) {
            $('#edit form')[0].reset();
        });

        @if($errors->any())
            $('#edit').modal('show');
        @endif
        @include('dynamicDropDown')
    </script>
    <script src="{{asset('material/plugins/wizard/jquery.validate.min.js')}}"></script>
    <script src="{{asset('material/plugins/wizard/steps.js')}}"></script>
@stop
