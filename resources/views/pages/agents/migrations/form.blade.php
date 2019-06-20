@extends('layouts.material')

@section('css')

@stop

@section('content')
    <div class="page-section">
        <section class="card card-fluid">
            <h3 class="m-b-0 text-white text-center bg-primary">Migration Contractuel ==> Titulaire</h3>
            <div class="card-body">
                {!! form_start($form) !!}
                <section>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! form_row($form->agent_id) !!}</div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! form_row($form->fullName) !!} </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! form_row($form->matricule) !!} </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! form_row($form->cadre_id) !!} </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! form_row($form->corp_id) !!} </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! form_row($form->fonction_id) !!} </div>
                        </div>
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
                                {!! form_row($form->ref_titularisation) !!} </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! form_row($form->date_titularisation) !!} </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! form_row($form->category_id) !!} </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! form_row($form->classe_id) !!} </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! form_row($form->echelon_id) !!} </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! form_row($form->indice) !!} </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! form_row($form->salary) !!} </div>
                        </div>
                        <div class="form-group offset-5">
                            <button class="btn btn-outline-primary" type="submit"><i class="mdi mdi-content-save mdi-18px"></i>  Enregistrer</button>
                            <a href="{{ route('migration.index') }}" class="btn btn-outline-secondary"><i class="mdi mdi-cancel mdi-18px"></i> Annuler</a>
                        </div>
                        {!! form_widget($form->indice_id) !!}
                        {!! form_widget($form->code) !!}
                        {!! form_widget($form->cadre) !!}
                        {!! form_widget($form->corps) !!}
                        {!! form_widget($form->fonction) !!}
                        {!! form_widget($form->type) !!}
                        {!! form_widget($form->last_type) !!}
                    </div>
                </section>
                {!! form_end($form, false) !!}
            </div>
        </section>
    </div>
@endsection

@section('js')
    <script type="text/javascript">
        $(document).ready(function () {
            @include('dynamicDropDown')
            $(function () {
                $('#agent_id').on('change', function(e){
                    let agent_id = $("#agent_id option:selected").val();
                    $.get('/api_agent?agent_id=' + agent_id,function(data) {
                        $('#fullName').val(data.nom + ' '+ data.prenom);
                        $('#classe_id, #echelon_id, #indice, #salary').val('');
                        $('#category_id').val(data.grades[0].category_id);
                        $('#cadre_id, #cadre').val(data.cadre_id);
                        $('#corp_id, #corps').val(data.corp_id);
                        $('#fonction_id, #fonction').val(data.fonction_id);
                        $('#code').val(data.matricule);
                        $('#last_type').val(data.type);
                    });
                });
            })
        })
    </script>
@stop

