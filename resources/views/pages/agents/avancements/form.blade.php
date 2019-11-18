@extends('layouts.material')

@section('css')

@stop

@section('content')
    <div class="page-section">
        <section class="card card-fluid">
            <h3 class="m-b-0 text-white text-center bg-primary">{{$titre}}</h3>
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
                                {!! form_row($form->ref_avancement) !!} </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! form_row($form->date_decision_avancement) !!} </div>
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
                                {!!  form_row($form->indice) !!} </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!!  form_row($form->salary) !!} </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! form_row($form->observation_avancement) !!} </div>
                        </div>
                        <div class="form-group offset-5">
                            <button class="btn btn-outline-primary" type="submit"><i class="mdi mdi-content-save mdi-18px"></i>  Enregistrer</button>
                            <a href="{{ $cancelRoute }}" class="btn btn-outline-secondary"><i class="mdi mdi-cancel mdi-18px"></i> Annuler</a>
                        </div>
                        {!! form_widget($form->agent) !!}
                        {!! form_widget($form->indice_id) !!}
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
                        $('#category_id, #classe_id, #echelon_id, #cadre_id, #corp_id, #fonction_id, #indice, #salary').val('');
                        $('#category_id').val(data.grades[0].category_id);
                        $('#classe_id').val(data.grades[0].classe_id);
                        $('#echelon_id').val(data.grades[0].echelon_id);
                        $('#cadre_id').val(data.grades[0].cadre_id);
                        $('#corp_id').val(data.grades[0].corp_id);
                        $('#fonction_id').val(data.grades[0].fonction_id);
                        $('#indice').val(data.grades[0].indice.value);
                        $('#salary').val(data.grades[0].indice.salary);
                        $('#indice_id').val(data.grades[0].indice.id);
                        $('#agent').val(agent_id);
                    });
                });
            })
            @if(isset($edit))
                $.ajax({
                    type: 'GET',
                    url: "{{route('agent.get', $avancement->agent_id)}}"
                }).then(function (data) {
                    let option = new Option(data.text, data.id, true, true);
                    $(".agent").append(option).trigger('change')
                });
                $('#agent_id').attr('disabled', true);
                $('#agent').val($('#agent_id').val());
            @endif
            @if(isset($data))
                $.ajax({
                    type: 'GET',
                    url: "{{route('agent.get', $data->ag)}}"
                }).then(function (data) {
                    let option = new Option(data.text, data.id, true, true);
                    $(".agent").append(option).trigger('change')
                });
                $('#agent_id').val({{$data->ag}}).attr('disabled', true);
                $('#agent').val($('#agent_id').val());
                $('#category_id').val({{$data->ca}}).attr('readonly', true);
                $('#classe_id').val({{$data->cl}}).attr('readonly', true);
                $('#echelon_id').val({{$data->ec}}).attr('readonly', true);
                $('#indice_id').val({{$data->in}});
                $('#cadre_id').val({{$data->cd}}).attr('readonly', true);
                $('#corp_id').val({{$data->co}}).attr('readonly', true);
                $('#fonction_id').val({{$data->fo}}).attr('readonly', true);
            @endif
        })
    </script>
@stop

