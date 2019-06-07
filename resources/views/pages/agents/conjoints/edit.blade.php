@extends('layouts.material')


@section('content')

    <div class="card card-outline-info">
        <div class="card-body">
            @if($conjoint->id)
                <h3 class="text-center label-default">Edition: {{ $conjoint->matricule }}</h3>
            @else
                <h3 class="text-center label-default">Enregistrement conjoint</h3>
            @endif

            @include('pages.agents.conjoints.form', ['form' => $form])

        </div>
    </div>
@endsection
@section('js')

@endsection
