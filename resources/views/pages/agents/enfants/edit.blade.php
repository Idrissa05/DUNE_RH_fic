@extends('layouts.material')


@section('content')

    <div class="card card-outline-info">
        <div class="card-body">
            @if($enfant->id)
                <h3 class="text-center label-default">Edition: {{ $enfant->prenom }}</h3>
            @else
                <h3 class="text-center label-default">Enregistrement enfant</h3>
            @endif

            @include('pages.agents.enfants.form', ['form' => $form])

        </div>
    </div>
@endsection
@section('js')
    <script>
        flatpickr($('#date_naiss'), {
            altInput: true,
            altFormat: 'd/m/Y',
            dateFormat: "Y-m-d",
            allowInput: false,
            locale: 'fr'
        })

    </script>

@endsection