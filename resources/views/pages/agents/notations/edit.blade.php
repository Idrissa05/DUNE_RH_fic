@extends('layouts.material')


@section('content')

    <div class="card card-outline-info">
        <div class="card-body">
            @if($notation->id)
                <h3 class="text-center label-default">Edition: {{ $notation->id }}</h3>
            @else
                <h3 class="text-center label-default">Enregistrement notation</h3>
            @endif

            @include('pages.agents.notations.form', ['form' => $form])

        </div>
    </div>
@endsection
@section('js')
    <script>
        @if($notation->id)
        $.ajax({
            type: 'GET',
            url: "{{route('agent.get',$notation->agent_id)}}"
        }).then(function (data) {
            let option = new Option(data.text, data.id, true, true);
            $(".agent").append(option).trigger('change')
        });
        @endif
    </script>
@endsection
