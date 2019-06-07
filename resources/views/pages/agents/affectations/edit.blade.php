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

@endsection
