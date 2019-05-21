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
        flatpickr($('#date_fin'), {
            altInput: true,
            altFormat: 'd/m/Y',
            dateFormat: "Y-m-d",
            allowInput: false,
            locale: 'fr'
        })

        flatpickr($('#date_debut'), {
            altInput: true,
            altFormat: 'd/m/Y',
            dateFormat: "Y-m-d",
            allowInput: false,
            locale: 'fr'
        })
    </script>

@endsection