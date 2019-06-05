@extends('pdf.document')

@section('content')
    <h3 class="text-center text-monospace" style="border: #2f3d4a 1px solid;">Les agents</h3>

    <table class="table table-bordered table table-sm text-center table-striped" style="font-size: 10px;">
        <thead class="thead-dark">
        <tr>
            <th>#</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Matriucle</th>
        </tr>
        </thead>

        <tbody class="text-center">
        @php
            $i = 1;
        @endphp
        @foreach($agents as $agent)
            <tr>
                <td>{{ $i }}</td>
                <td>{{ $agent->nom }}</td>
                <td>{{ $agent->prenom }}</td>
                <td>{{ $agent->matricule }}</td>
            </tr>
            @php
                $i++;
            @endphp
        @endforeach
        </tbody>
    </table>
@endsection
