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