@extends('layouts.material')


@section('content')

    <div class="card card-outline-info">
        <div class="card-body">
            @if($dece->id)
                <h3 class="text-center label-default">Edition: {{ $dece->id }}</h3>
            @else
                <h3 class="text-center label-default">Enregistrement decès</h3>
            @endif

            @include('pages.agents.deces.form', ['form' => $form])

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

    </script>

@endsection