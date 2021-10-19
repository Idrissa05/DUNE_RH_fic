@extends('layouts.material')


@section('content')

    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Nouvel utilisateur</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                {!! form_start($form) !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            {!! form_row($form->name) !!}
                            <div id="p">
                                {!! form_row($form->password) !!}
                                {!! form_row($form->password_confirmation) !!}
                            </div>
                        </div>
                        <div class="col-md-6">
                            {!! form_row($form->region_id) !!}
                           
                            {!! form_row($form->ministere_id) !!}
                            {!! form_row($form->role_id) !!}
                        </div>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-dismiss="modal">Fermer</button>
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                </div>
                {!! form_end($form) !!}
            </div>
        </div>
    </div>
    <h3 class="m-b-0 text-white text-center bg-primary">Les utilisateurs</h3>

    <div class="card card-outline-info">
        <div class="card-body">

            <button data-toggle="modal" data-target="#add" data-whatever="@getbootstrap" class="btn btn-themecolor btn-sm"><i class="mdi font-weight-bold mdi-18px mdi-plus"> Ajouter</i></button>

            <table class="table table-bordered text-center" id="myTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Nom d'utilisateur</th>
                    <th>Rôle</th>
                    <th>Region</th>
                    <th>Ministère</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->role }}</td>
                        <td>{{ $user->region->name ?? '' }}</td>
                        <td>{{ $user->ministere->abreviation ?? '' }}</td>
                        <td>
                            <button id="user{{ $user->id }}"
                                    data-name="{{ $user->name }}"
                                    data-role="{{ $user->role_id }}"
                                    data-region="{{ $user->region_id }}"
                                    data-ministere="{{ $user->ministere_id }}"
                                    data-route="{{ route('users.update', $user) }}"
                                    onclick="updateClasse({{ $user->id }})" class="btn btn-sm btn-outline-warning">
                                <i class="mdi mdi-18px mdi-pencil"></i>
                            </button>


                            <form action="{{ route('users.destroy', $user) }}" id="del{{ $user->id }}" style="display: inline-block;" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-outline-danger btn-sm" type="button"
                                        onclick="myHelpers.deleteConfirmation('{{ 'del'. $user->id }}')"
                                ><i class="mdi mdi-18px mdi-trash-can-outline"></i>
                                </button>
                            </form>
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
    <script>

        @if($errors->any())
        $('#add').modal('show')
                @endif

        let $modal = $('#add')
        let $name = $('#name')
        let $role = $('#role_id')
        let $region = $('#region_id')
        let $ministere = $('#ministere_id')
        let $form = $('form')


        function updateClasse(id) {
            let $el = $('#user'+id)
            $modal.modal('show')
            $name.val($el.attr('data-name'))
            $role.val($el.attr('data-role'))
            $region.val($el.attr('data-region'))
            $ministere.val($el.attr('data-ministere'))
            $form.attr('action', $el.attr('data-route'))
            $form.append("<input type='hidden' name='_method' value='PUT'>")
            $('#p').hide()
        }

        $modal.on('hidden.bs.modal', function (e) {
            $name.val('')
            $form.attr('action', '')
            $('input[name="_method"]').remove()
            $('#p').show()
        })
    </script>
@endsection
