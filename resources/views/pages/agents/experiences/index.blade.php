@extends('layouts.material')


@section('content')
    <h3 class="m-b-0 text-white text-center bg-primary">Les expériences</h3>

<div class="card card-outline-info">
    <div class="card-body">

        <a href="{{ route('experience.create') }}" class="btn btn-themecolor btn-sm"><i class="mdi font-weight-bold mdi-18px mdi-plus"> Ajouter</i></a>

        <table class="table table-bordered text-center" id="myTable">
            <thead>
            <tr>
                <th>#</th>
                <th>Organisation</th>
                <th>Date début</th> '
                <th>Date fin</th>
                <th>Fonction</th>
                <th>Tâche</th>
                <th>Observation</th>
                <th>Agent</th>
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
        { data: 'organisation', name: 'organisation' },
        { data: 'date_debut', name: 'date_debut' },
        { data: 'date_fin', name: 'date_fin' },
        { data: 'fonction', name: 'fonction' },
        { data: 'tache', name: 'tache' },
        { data: 'observation', name: 'observation' },
        { data: 'agent', name: 'agent' },
        { data: 'actions', name: 'Actions', searchable: false, orderable: false },
    ]", 'route' => route('experience.index')], ['scroll' => '450px'])
    })
</script>
@endsection