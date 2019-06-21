@extends('pdf.document')

@section('content')
    <h3 class="text-center text-monospace" style="border: #2f3d4a 1px solid; font-size: 18px;">Liste ou tableau des agents par sexe et catégorie</h3>

    <table class="table table-bordered table table-sm text-center table-striped" style="font-size: 10px;">
        <thead class="thead-dark">
        <tr>
            <th>No</th>
            <th>Matriucle</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Sexe</th>
            <th>Région</th>
            <th>Département</th>
            <th>Inspection</th>
            <th>S. Pédagogique</th>
        </tr>
        </thead>

        <tbody class="text-center">
        @php
            $i = 1;
        @endphp
        @foreach($affectations as $affectation)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $affectation->matricule }}</td>
                <td>{{ $affectation->nom }}</td>
                <td>{{ $affectation->prenom }}</td>
                <td>{{ $affectation->sexe }}</td>
                <td>{{ $affectation->region }}</td>
                <td>{{ $affectation->departement }}</td>
                <td>{{ $affectation->inspection }}</td>
                <td>{{ $affectation->secteur }}</td>
            </tr>
            @php
                $i++;
            @endphp
        @endforeach
        </tbody>
    </table>
@endsection
