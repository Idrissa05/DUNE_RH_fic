@extends('layouts.material')

@section('css')

@stop

@section('content')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body wizard-content">
                    <h2 class="card-title offset-5">SAISIE DES AGENTS</h2>
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
                                <div class="col-md-4" id="both" hidden>
                                    <div class="form-group">
                                        {!! form_row($form->date_prise_service) !!} </div>
                                </div>
                            </div>
                        </section>
                        <!-- Step 2 -->
                        <h6>Situation Administrative</h6>
                        <section>
                            <div class="row" id="titulaire" hidden>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! form_row($form->ref_engagement) !!} </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! form_row($form->date_engagement) !!} </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! form_row($form->ref_titularisation) !!} </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! form_row($form->date_titularisation) !!} </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! form_row($form->fonction_id) !!} </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! form_row($form->cadre_id) !!} </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! form_row($form->corp_id) !!} </div>
                                </div>
                                <div class="col-md-3" id="auxiliaire" hidden>
                                    <div class="form-group">
                                        {!! form_row($form->category_auxiliaire_id) !!} </div>
                                </div>
                                <div class="col-md-3" id="category">
                                    <div class="form-group">
                                        {!! form_row($form->category_id) !!} </div>
                                </div>
                                <div class="col-md-3" id="classe" hidden>
                                    <div class="form-group">
                                        {!! form_row($form->classe_id) !!} </div>
                                </div>
                                <div class="col-md-3" id="echelon" hidden>
                                    <div class="form-group">
                                        {!! form_row($form->echelon_id) !!} </div>
                                </div>
                                <div class="col-md-3" id="indices" hidden>
                                    <div class="form-group">
                                        {!! form_row($form->indice) !!} </div>
                                </div>
                                <div class="col-md-3" id="salaries" hidden>
                                    <div class="form-group">
                                        {!! form_row($form->salary) !!} </div>
                                </div>
                                {!! form_widget($form->indice_id) !!}
                            </div>
                        </section>
                        <!-- Step 3 -->
                        <h6>Affectations</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! form_row($form->etablissement_id) !!} </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! form_row($form->ref) !!} </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! form_row($form->date_affectation) !!} </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        {!! form_row($form->date_prise_effet) !!} </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        {!! form_row($form->observation_affectation) !!} </div>
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
                        <h6>Situation Matrimoniale</h6>
                        <section>
                            <div class="row offset-2">
                                <div class="col-md-5">
                                    <div class="form-group">
                                        {!! form_row($form->matrimoniale_id) !!} </div>
                                </div>
                                <div class="col-md-5">
                                    <div class="form-group">
                                        {!! form_row($form->date) !!} </div>
                                </div>
                            </div>
                        </section>
                        <!-- Step 6 -->
                        <h6>Enfants</h6>
                        <section>
                            <div style="height:300px; overflow:auto;" class="table-responsive">
                                <div class="col-md-3 offset-5">
                                    <div class="form-row">
                                        <h4>Nombre d'Enfant <span class="badge badge-primary" id="ne"> 0</span></h4>
                                    </div>
                                </div>
                                <table class="table color-bordered-table purple-bordered-table table-bordered" id="enfant">
                                    <thead>
                                    <tr>
                                        <th>Prénom*</th>
                                        <th>Date Naissance*</th>
                                        <th>Lieu Naissance*</th>
                                        <th>Ref Acte Naissance*</th>
                                        <th>Sexe*</th>
                                        <th><a style="font-size:18px;" id="addMoreEnfant" class="btn btn-sm btn-outline-light"><span class="mdi mdi-plus"></span></a></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    </tbody>
                                </table>
                            </div>
                        </section>
                        <!-- Step 7 -->
                        <h6>Conjoints</h6>
                        <section>
                            <div style="height:300px; overflow:auto;" class="table-responsive">
                                <div class="col-md-3 offset-5">
                                    <div class="form-row">
                                        <h4>Nombre de Conjoint <span class="badge badge-primary" id="nc"> 0</span></h4>
                                    </div>
                                </div>
                                <table class="table color-bordered-table purple-bordered-table table-bordered" id="conjoint">
                                    <thead>
                                    <tr>
                                        <th>Matricule</th>
                                        <th>Nom*</th>
                                        <th>Prénom*</th>
                                        <th>Date Naissance*</th>
                                        <th>Lieu Naissance*</th>
                                        <th>Réf Acte Naissance*</th>
                                        <th>Sexe*</th>
                                        <th>Date Mariage*</th>
                                        <th>Réf Acte Mariage*</th>
                                        <th>Nationnalité*</th>
                                        <th>Téléphone*</th>
                                        <th>Employeur</th>
                                        <th>Profession*</th>
                                        <th><a style="font-size:18px;" id="addMoreConjoint" class="btn btn-sm btn-outline-light"><span class="mdi mdi-plus"></span></a></th>
                                    </tr>
                                    </thead>
                                    <tbody></tbody>
                                </table>
                            </div>
                        </section>
                        <!-- Step 8 -->
                        <h6>Autres informations</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! form_row($form->maladie_id) !!} </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! form_row($form->date_observation) !!} </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! form_row($form->observation) !!} </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        {!! form_row($form->programme_id) !!} </div>
                                </div>
                            </div>
                        </section>
                    {!! form_end($form, false) !!}
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            $('#type').on('change', function(e){
                @include('dependentTypeFieldsCreate')
            });

            @include('dependentTypeFieldsCreate')
            @include('dynamicDropDown')

            let num_child_rows=0;
            $('#addMoreEnfant').on('click', function() {
                let row = "<tr><td><input class='table_field_required form-control' id='prenom_enfant' name=prenom_enfant["+num_child_rows+"] type='text'></td><td><input class='table_field_required child_date form-control' id='date_naiss_enfant' name=date_naiss_enfant["+num_child_rows+"] type='date'></td> <td><input class='table_field_required form-control' id='lieu_naiss_enfant' name=lieu_naiss_enfant["+num_child_rows+"] type='text'></td> <td><input class='table_field_required form-control' id='ref_acte_naiss_enfant' name=ref_acte_naiss_enfant["+num_child_rows+"] type='text'></td> <td> <select class='table_field_required form-control' id='sexe_enfant' name=sexe_enfant["+num_child_rows+"]> <option value='' selected='selected'>Sélectionner</option> <option value='F'>Féminin</option><option value='M'>Masculin</option> </select> </td> <td><a class='removeEnfant btn btn-outline-danger btn-sm'><i class='mdi mdi-18px mdi-trash-can-outline'></i></a></td> </tr>";
                $("#enfant").append(row);
                num_child_rows++;
                $('#ne').text(num_child_rows);
            });
            $("#enfant").on("click", ".removeEnfant", function() {
                $(this).closest("tr").remove();
                num_child_rows--;
                $('#ne').text(num_child_rows);
            });

            let num_partner_rows=0;
            $('#addMoreConjoint').on('click', function() {
                let row = "<tr><td><input class='form-control' id='matricule_conjoint' name='matricule_conjoint["+num_partner_rows+"]' type='text'></td><td><input class='table_field_required form-control' id='nom_conjoint' name='nom_conjoint["+num_partner_rows+"]' type='text'></td><td><input class='table_field_required form-control' id='prenom_conjoint' name='prenom_conjoint["+num_partner_rows+"]' type='text'></td><td><input class='table_field_required form-control' id='date_naiss_conjoint' name='date_naiss_conjoint["+num_partner_rows+"]' type='date'></td><td><input class='table_field_required form-control' id='lieu_naiss_conjoint' name='lieu_naiss_conjoint["+num_partner_rows+"]' type='text'></td><td><input class='table_field_required form-control' id='ref_acte_naiss_conjoint' name='ref_acte_naiss_conjoint["+num_partner_rows+"]' type='text'></td><td><select class='table_field_required form-control' id='sexe_conjoint' name='sexe_conjoint["+num_partner_rows+"]'><option value=' selected='selected'>Sélectionner</option><option value='F'>Féminin</option><option value='M'>Masculin</option></select></td><td><input class='table_field_required form-control' id='date_mariage' name='date_mariage["+num_partner_rows+"]' type='date'></td><td><input class='table_field_required form-control' id='ref_acte_mariage' name='ref_acte_mariage["+num_partner_rows+"]' type='text'></td><td><input class='table_field_required form-control' id='nationnalite_conjoint' name='nationnalite_conjoint["+num_partner_rows+"]' type='text'></td><td><input class='table_field_required form-control' id='tel' name='tel["+num_partner_rows+"]' type='text'></td><td><input class='form-control' id='employeur' name='employeur["+num_partner_rows+"]' type='text'></td><td><input class='table_field_required form-control' id='profession' name='profession["+num_partner_rows+"]' type='text'></td><td><a class='removeConjoint btn btn-outline-danger btn-sm'><i class='mdi mdi-18px mdi-trash-can-outline'></i></a></td></tr>";
                $("#conjoint").append(row);
                num_partner_rows++;
                $('#nc').text(num_partner_rows);
            });
            $("#conjoint").on("click", ".removeConjoint", function() {
                $(this).closest("tr").remove();
                num_partner_rows--;
                $('#nc').text(num_partner_rows);
            });

            $.validator.addMethod("greaterThan",
                function() {
                    return $('#date_naiss').val() < $('#date_naiss_enfant').val()
                },'La date de naissance de l\'enfant doit être supérieure à celle du Père'
            );

            $.validator.addClassRules({
                table_field_required:{
                    required: true,
                },
                child_date:{
                    greaterThan: ""
                }
            });
        });
    </script>
    <script src="{{asset('material/plugins/wizard/jquery.validate.min.js')}}"></script>
    <script src="{{asset('material/plugins/wizard/steps.js')}}"></script>
@stop

