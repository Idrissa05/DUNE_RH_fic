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
                                {!! form_row($form->ref_avancement) !!} </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                {!! form_row($form->date_decision_avancement) !!} </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {!! form_row($form->observation_avancement) !!} </div>
                        </div>
                        <div class="form-group offset-5">
                            <button class="btn btn-outline-primary" type="submit"><i class="mdi mdi-content-save mdi-18px"></i>  Enregistrer</button>
                            <a href="{{ $cancelRoute }}" class="btn btn-outline-secondary"><i class="mdi mdi-cancel mdi-18px"></i> Annuler</a>
                        </div>
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
            $('#date_decision_avancement').flatpickr({altInput: true, altFormat: 'd/m/Y', dateFormat: "Y-m-d", allowInput: true, locale: 'fr'});
            @include('dynamicDropDown')
            @if(isset($edit))
                $('#agent_id').attr('readonly', true);
            @endif
            @if(isset($data))
                $('#agent_id').val({{$data->ag}}).attr('readonly', true);
                $('#category_id').val({{$data->ca}}).attr('readonly', true);
                $('#classe_id').val({{$data->cl}}).attr('readonly', true);
                $('#echelon_id').val({{$data->ec}}).attr('readonly', true);
                $('#indice_id').val({{$data->in}});
            @endif
        })
    </script>
@stop

