@extends('pdf.document')

@section('content')
    <h3 class="text-center text-monospace" style="border: #2f3d4a 1px solid; font-size: 18px;">Liste des agents par situation matrimoniale</h3>

    <table class="table table-bordered table table-sm text-center table-striped" style="font-size: 10px;">
        <thead class="thead-dark">
        <tr>
            <th>No</th>
            <th>Matriucle</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date Naissance</th>
            <th>Lieu Naissance</th>
            <th>Matrimoniale</th>
        </tr>
        </thead>

        <tbody class="text-center">
        @php
            $i = 1;
        @endphp
        @foreach($agents as $agent)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $agent->matricule }}</td>
                <td>{{ $agent->nom }}</td>
                <td>{{ $agent->prenom }}</td>
                <td>{{ formaterDate($agent->date_naiss) }}</td>
                <td>{{ $agent->lieu_naiss }}</td>
                <td>{{ $agent->matrimoniales->last()->name }}</td>
            </tr>
            @php
                $i++;
            @endphp
        @endforeach
        </tbody>
    </table>
@endsection
