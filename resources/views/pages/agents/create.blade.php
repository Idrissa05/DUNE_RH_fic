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
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        {!! form_row($form->sexe) !!} </div>
                                </div>
                                <div class="col-md-2">
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
                            </div>
                        </section>
                        <!-- Step 2 -->
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
                        <!-- Step 3 -->
                        <h6>Situation Administrative</h6>
                        <section>
                            <div class="row">
                                <div class="col-md-4 offset-4">
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
                            <div class="row" id="both">
                                <div class="col-md-4" id="category" hidden>
                                    <div class="form-group">
                                        {!! form_row($form->category_id) !!} </div>
                                </div>
                                <div class="col-md-4" id="contractuel" hidden>
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
@endsection

@section('js')
    <script>
    $(document).ready(function () {
        $('#date_naiss, #date, #date_engagement, #date_titularisation, #date_prise_service, #date_debut, #date_fin, #date_observation').flatpickr({'locale' : 'fr'});
        $('#type').on('change', function(e){
            if($("#type option:selected").val() == 'Contractuel'){
                $('#titulaire, #category, #classe, #echelon').hide();
                $('#ref_engagement, #date_engagement, #date_titularisation, #classe_id, #echelon_id').removeAttr('required').val('');
                $('#both').addClass('offset-3');
                $('#contractuel, #category').removeAttr('hidden').show();
                $('#date_prise_service').attr('required', true);
            }else if($("#type option:selected").val() == 'Titulaire'){
                $('#contractuel, #category').hide();
                $('#date_prise_service').removeAttr('required').val('');
                $('#both').removeClass('offset-3');
                $('#titulaire, #category, #classe, #echelon').removeAttr('hidden').show();
                $('#ref_engagement, #date_engagement, #date_titularisation, #classe_id, #echelon_id').attr('required', true);
            }else $('#titulaire, #contractuel, #category, #classe, #echelon').hide();

        });
    })
    </script>
    <script src="{{asset('material/plugins/wizard/jquery.validate.min.js')}}"></script>
    <script src="{{asset('material/plugins/wizard/steps.js')}}"></script>
@stop

