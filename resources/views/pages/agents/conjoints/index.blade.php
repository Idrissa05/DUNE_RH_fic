@extends('layouts.material')


@section('content')

<div class="card card-outline-info">
    <div class="card-body">
        <h3 class="text-center label-default">Les conjoints</h3>

        <a href="{{ route('conjoint.create') }}" class="btn btn-themecolor btn-sm"><i class="mdi font-weight-bold mdi-18px mdi-plus"> Ajouter</i></a>

        <table class="table table-bordered text-center" id="myTable">
            <thead>
            <tr>
                <th>#</th>
                <th>Ref décision</th>
                <th>Agent</th>
                <th>Date début</th>
                <th>Date fin</th> '
                <th>Observation</th>
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
        { data: 'ref_decision', name: 'ref_decision' },
        { data: 'agent', name: 'agent' },
        { data: 'date_debut', name: 'date_debut' },
        { data: 'date_fin', name: 'date_fin' },
        { data: 'observation', name: 'observation' },
        { data: 'actions', name: 'Actions', searchable: false, orderable: false },
    ]", 'route' => route('conjoint.index')], ['scroll' => '450px'])
    })
</script>
@endsection