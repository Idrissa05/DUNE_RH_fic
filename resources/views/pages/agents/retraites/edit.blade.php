@extends('layouts.material')


@section('content')

    <div class="card card-outline-info">
        <div class="card-body">
            @if($retraite->id)
                <h3 class="text-center label-default">Edition: {{ $retraite->id }}</h3>
            @else
                <h3 class="text-center label-default">Enregistrement retraite</h3>
            @endif

            @include('pages.agents.retraites.form', ['form' => $form])

        </div>
    </div>
@endsection
@section('js')

@endsection
