@extends('layouts.material')

@section('content')
    <div class="card card-outline-info">
        <div class="card-body">
            @if($reclassement->id)
                <h3 class="text-center label-default">Edition: {{ $reclassement->id }}</h3>
            @else
                <h3 class="text-center label-default">Enregistrement reclassement</h3>
            @endif

            @include('pages.agents.reclassements.form', ['form' => $form])
        </div>
    </div>
@endsection

@section('js')
    <script>
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
                });
            });
        });
        @if($reclassement->id)
            $('#agent_id').attr('disabled', true);
        @else
            $('#agent_id').attr('required', true);
        @endif
    </script>
@endsection
