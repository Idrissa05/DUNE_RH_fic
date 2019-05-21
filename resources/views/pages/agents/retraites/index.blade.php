@extends('layouts.material')


@section('content')

<div class="card card-outline-info">
    <div class="card-body">
        <h3 class="text-center label-default">Les retraites</h3>

        <a href="{{ route('retraite.create') }}" class="btn btn-themecolor btn-sm"><i class="mdi font-weight-bold mdi-18px mdi-plus"> Ajouter</i></a>

        <table class="table table-bordered text-center" id="myTable">
            <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Ref décision</th> '
                <th>Date décision</th>
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
        { data: 'date', name: 'date' },
        { data: 'ref_decision', name: 'ref_decision' },
        { data: 'date_decision', name: 'date_decision' },
        { data: 'observation', name: 'observation' },
        { data: 'agent', name: 'agent' },
        { data: 'actions', name: 'Actions', searchable: false, orderable: false },
    ]", 'route' => route('retraite.index')], ['scroll' => '450px'])
    })
</script>
@endsection