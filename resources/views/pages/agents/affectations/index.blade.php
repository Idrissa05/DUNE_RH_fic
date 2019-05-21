@extends('layouts.material')


@section('content')

<div class="card card-outline-info">
    <div class="card-body">
        <h3 class="text-center label-default">Les affectations</h3>

        <a href="{{ route('affectation.create') }}" class="btn btn-themecolor btn-sm"><i class="mdi font-weight-bold mdi-18px mdi-plus"> Ajouter</i></a>

        <table class="table table-bordered text-center" id="myTable">
            <thead>
            <tr>
                <th>#</th>
                <th>Référence</th>
                <th>Date</th> '
                <th>Date prise effet</th>
                <th>Observation</th>
                <th>Agent</th>
                <th>Etablissement</th>
                <th>Actions</th>
            </tr>
            </thead>
        </table>
    </div>
</div>
@endsection

@section('js')
<script>
    $(function () {
    @include('dataTableAjax', ['columns' => "[
        { data: 'id', name: 'id' },
        { data: 'ref', name: 'ref' },
        { data: 'date', name: 'date_debut' },
        { data: 'date_prise_effet', name: 'date_prise_effet' },
        { data: 'observation', name: 'observation' },
        { data: 'agent', name: 'agent' },
        { data: 'etablissement', name: 'etablissement' },
        { data: 'actions', name: 'Actions', searchable: false, orderable: false },
    ]", 'route' => route('affectation.index')], ['scroll' => '450px'])
    })
</script>
@endsection