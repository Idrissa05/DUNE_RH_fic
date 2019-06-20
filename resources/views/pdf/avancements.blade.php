@extends('pdf.document')

@section('content')
    <h3 class="text-center text-monospace" style="border: #2f3d4a 1px solid; font-size: 18px;">Historique avancement</h3>

    @php
    $agent = \App\Models\Agent::find(Request::get('agent'));
    @endphp

    <table class="table table-sm table-borderless">
        <tr>
            <td>Matricule :</td>
            <td>{{ $agent->matricule }}</td>
        </tr>
        <tr>
            <td>Nom & prénom :</td>
            <td>{{ $agent->fullName }}</td>
        </tr>
    </table>
    <table class="table table-bordered table table-sm text-center table-striped" style="font-size: 10px;">
        <thead class="thead-dark">
        <tr>
            <th>No</th>
            <th>Catégorie</th>
            <th>Classe</th>
            <th>Echelon</th>
            <th>Réference</th>
            <th>Date décision</th>
            <th>Observation</th>
        </tr>
        </thead>

        <tbody class="text-center">
        @php
            $i = 1;
        @endphp
        @foreach($avancements as $avancement)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $avancement->category->name }}</td>
                <td>{{ $avancement->classe->name }}</td>
                <td>{{ $avancement->echelon->name }}</td>
                <td>{{ $avancement->ref_avancement }}</td>
                <td>{{ formaterDate($avancement->date_decision_avancement) }}</td>
                <td>{{ $avancement->observation_avancement }}</td>
            </tr>
            @php
                $i++;
            @endphp
        @endforeach
        </tbody>
    </table>
@endsection
