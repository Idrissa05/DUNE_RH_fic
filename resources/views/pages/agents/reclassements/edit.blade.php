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
        flatpickr($('#date_reclassement'), {
            altInput: true,
            altFormat: 'd/m/Y',
            dateFormat: "Y-m-d",
            allowInput: false,
            locale: 'fr'
        })
    </script>

@endsection