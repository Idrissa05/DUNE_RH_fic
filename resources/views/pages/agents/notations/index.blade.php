@extends('layouts.material')


@section('content')
    <h3 class="m-b-0 text-white text-center bg-primary">Les notations</h3>

<div class="card card-outline-info">
    <div class="card-body">
        @can('EDITER_NOTATION')
        <a href="{{ route('notation.create') }}" class="btn btn-themecolor btn-sm"><i class="mdi font-weight-bold mdi-18px mdi-plus"> Ajouter</i></a>
        @endcan
        <table class="table table-bordered text-center" id="myTable">
            <thead>
            <tr>
                <th>#</th>
                <th>Date début</th> '
                <th>Date fin</th>
                <th>Note pédagogique</th>
                <th>Note adminitratif</th>
                <th>Responsable</th>
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
        { data: 'date_debut', name: 'date_debut' },
        { data: 'date_fin', name: 'date_fin' },
        { data: 'note_pedagogique', name: 'note_pedagogique' },
        { data: 'note_adminitratif', name: 'note_adminitratif' },
        { data: 'responsable', name: 'responsable' },
        { data: 'observation', name: 'observation' },
        { data: 'agent', name: 'agent' },
        { data: 'actions', name: 'Actions', searchable: false, orderable: false },
    ]", 'route' => route('notation.index')], ['scroll' => '450px'])
    })
</script>
@endsection