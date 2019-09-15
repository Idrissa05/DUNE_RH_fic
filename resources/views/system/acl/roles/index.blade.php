@extends('layouts.material')


@section('content')
    <h3 class="m-b-0 text-white text-center bg-primary">Les rôles</h3>

    <div class="card card-outline-info">
        <div class="card-body">

            <a href="{{ route('role.create') }}"  class="btn btn-themecolor btn-sm"><i class="mdi font-weight-bold mdi-18px mdi-plus"> Ajouter</i></a>

            <table class="table table-bordered text-center" id="myTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Rôle</th>
                    <th>Permissions</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($roles as $role)
                    <tr>
                        <td>{{ $role->id }}</td>
                        <td>{{ $role->name }}</td>
                        <td>
                            @foreach($role->permissions as $permission)
                                <span class="label label-light-primary">{{ $permission->name }}</span><br>
                            @endforeach
                        </td>
                        <td>
                            <a href="{{ route('role.edit', $role) }}" class="btn btn-sm btn-outline-warning">
                                <i class="mdi mdi-18px mdi-pencil"></i>
                            </a>

                            <!--
                            <form action="{{ route('role.destroy', $role) }}" id="del{{ $role->id }}" style="display: inline-block;" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-outline-danger btn-sm" type="button"
                                        onclick="myHelpers.deleteConfirmation('{{ 'del'. $role->id }}')"
                                ><i class="mdi mdi-18px mdi-trash-can-outline"></i>
                                </button>
                            </form>
                            -->
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('js')
    @include('dataTable')
@endsection
