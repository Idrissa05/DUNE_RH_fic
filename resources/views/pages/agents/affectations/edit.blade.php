@extends('layouts.material')


@section('content')

    <div class="card card-outline-info">
        <div class="card-body">
            @if($affectation->id)
                <h3 class="text-center label-default">Edition: {{ $affectation->id }}</h3>
            @else
                <h3 class="text-center label-default">Enregistrement affectation</h3>
            @endif

            @include('pages.agents.affectations.form', ['form' => $form])

        </div>
    </div>
@endsection
@section('js')
    <script>
        var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
        $(document).ready(function(){
            $(".etablissement").select2({
                ajax: {
                    url: "{{route('etablissement.search')}}",
                    type: "post",
                    dataType: 'json',
                    delay: 50,
                    data: function (params) {
                        return {
                            _token: CSRF_TOKEN,
                            search: params.term
                        };
                    },
                    processResults: function (response) {
                        return {
                            results: response
                        };
                    },
                    cache: true
                }
            });
        });

        @if($affectation->id)
            $.ajax({
                type: 'GET',
                url: "{{route('agent.get',$affectation->agent_id)}}"
            }).then(function (data) {
                let option = new Option(data.text, data.id, true, true);
                $(".agent").append(option).trigger('change')
            });

            $.ajax({
                type: 'GET',
                url: "{{route('etablissement.get',$affectation->etablissement_id)}}"
            }).then(function (data) {
                let option = new Option(data.text, data.id, true, true);
                $(".etablissement").append(option).trigger('change')
            });
        @endif
</script>
@endsection
