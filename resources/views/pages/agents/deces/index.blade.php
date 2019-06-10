@extends('layouts.material')


@section('content')

    <h3 class="m-b-0 text-white text-center bg-primary">Les decès</h3>

    <div class="card card-outline-info">
    <div class="card-body">

        <a href="{{ route('deces.create') }}" class="btn btn-themecolor btn-sm"><i class="mdi font-weight-bold mdi-18px mdi-plus"> Ajouter</i></a>

        <table class="table table-bordered text-center" id="myTable">
            <thead>
            <tr>
                <th>#</th>
                <th>Date</th>
                <th>Ref document</th> '
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
        { data: 'ref_document', name: 'ref_document' },
        { data: 'observation', name: 'observation' },
        { data: 'agent', name: 'agent' },
        { data: 'actions', name: 'Actions', searchable: false, orderable: false },
    ]", 'route' => route('deces.index')], ['scroll' => '450px'])
    })
</script>
@endsection