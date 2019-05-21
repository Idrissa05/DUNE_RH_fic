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
        flatpickr($('#date'), {
            altInput: true,
            altFormat: 'd/m/Y',
            dateFormat: "Y-m-d",
            allowInput: false,
            locale: 'fr'
        })

        flatpickr($('#date_prise_effet'), {
            altInput: true,
            altFormat: 'd/m/Y',
            dateFormat: "Y-m-d",
            allowInput: false,
            locale: 'fr'
        })
    </script>

@endsection