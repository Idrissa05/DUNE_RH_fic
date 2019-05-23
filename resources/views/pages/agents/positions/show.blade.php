@extends('layouts.material')


@section('content')


    <div class="card card-outline-info">
        <div class="card-body">
            <h3 class="text-center label-default">Maladies: {{ $agent->fullName }}</h3>


            <table class="table table-bordered text-center" id="myTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Maladie</th>
                    <th>Observation</th>
                    <th>Date Observation</th>
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
                { data: 'name', name: 'name' },
                { data: 'observation', name: 'observation' },
                { data: 'date_observation', name: 'date_observation' },
                { data: 'actions', name: 'Actions', searchable: false, orderable: false },
            ]", 'route' => route('agent-maladie.show', ['id' => $agent->id])], ['scroll' => '450px'])
        })
    </script>
@endsection