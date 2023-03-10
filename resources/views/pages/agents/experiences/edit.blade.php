@extends('layouts.material')


@section('content')

    <div class="card card-outline-info">
        <div class="card-body">
            @if($experience->id)
                <h3 class="text-center label-default">Edition: {{ $experience->id }}</h3>
            @else
                <h3 class="text-center label-default">Enregistrement expérience</h3>
            @endif

            @include('pages.agents.experiences.form', ['form' => $form])

        </div>
    </div>
@endsection
@section('js')
    <script>
        @if($experience->id)
        $.ajax({
            type: 'GET',
            url: "{{route('agent.get',$experience->agent_id)}}"
        }).then(function (data) {
            let option = new Option(data.text, data.id, true, true);
            $(".agent").append(option).trigger('change')
        });
        @endif
    </script>
@endsection
