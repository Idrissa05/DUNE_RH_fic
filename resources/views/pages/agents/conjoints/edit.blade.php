@extends('layouts.material')


@section('content')

    <div class="card card-outline-info">
        <div class="card-body">
            @if($conjoint->id)
                <h3 class="text-center label-default">Edition: {{ $conjoint->matricule }}</h3>
            @else
                <h3 class="text-center label-default">Enregistrement conjoint</h3>
            @endif

            @include('pages.agents.conjoints.form', ['form' => $form])

        </div>
    </div>
@endsection
@section('js')
    <script>
        @if($conjoint->id)
        $.ajax({
            type: 'GET',
            url: "{{route('agent.get',$conjoint->agent_id)}}"
        }).then(function (data) {
            let option = new Option(data.text, data.id, true, true);
            $(".agent").append(option).trigger('change')
        });
        @endif
    </script>
@endsection
