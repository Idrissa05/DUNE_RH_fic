@extends('layouts.material')


@section('content')

    <div class="modal fade" id="add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="exampleModalLabel1">Nouvelle indice</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                </div>
                {!! form_start($form) !!}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            {!! form_row($form->name) !!}
                            {!! form_row($form->value) !!}
                            {!! form_row($form->salary) !!}
                        </div>
                        <div class="col-md-6">
                            {!! form_row($form->category_id) !!}
                            {!! form_row($form->classe_id) !!}
                            {!! form_row($form->echelon_id) !!}
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
    <h3 class="m-b-0 text-white text-center bg-primary">Les indices</h3>

    <div class="card card-outline-info">
        <div class="card-body">


            <table class="table table-bordered text-center" id="myTable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>Libellé</th>
                    <th>Valeur</th> '
                    <th>Salaire</th>
                    <th>Catégorie</th>
                    <th>Classe</th>
                    <th>Echelon</th>
                    <th>Actions</th>
                </tr>
                </thead>
                <tbody>
                @foreach($indices as $indice)
                    <tr>
                        <td>{{ $indice->id }}</td>
                        <td>{{ $indice->name }}</td>
                        <td>{{ $indice->value }}</td>
                        <td>{{ number_format($indice->salary, 0, ',', ' ') }}</td>
                        <td>{{ $indice->category->name }}</td>
                        <td>{{ $indice->classe->name }}</td>
                        <td>{{ $indice->echelon->name }}</td>
                        <td>
                            <button id="indice{{ $indice->id }}"
                                    data-name="{{ $indice->name }}"
                                    data-value="{{ $indice->value }}"
                                    data-salary="{{ $indice->salary }}"
                                    data-category="{{ $indice->category_id }}"
                                    data-classe="{{ $indice->classe_id }}"
                                    data-echelon="{{ $indice->echelon_id }}"
                                    data-route="{{ route('indice.update', $indice) }}"
                                    onclick="updateIndice({{ $indice->id }})" class="btn btn-sm btn-outline-warning">
                                <i class="mdi mdi-18px mdi-pencil"></i>
                            </button>


                           {{-- <form action="{{ route('indice.destroy', $indice) }}" id="del{{ $indice->id }}" style="display: inline-block;" method="post">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-outline-danger btn-sm" type="button"
                                        onclick="myHelpers.deleteConfirmation('{{ 'del'. $indice->id }}')">
                                    <i class="mdi mdi-18px mdi-trash-can-outline"></i>
                                </button>
                            </form>--}}
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
        let $value = $('#value')
        let $salary = $('#salary')
        let $classe = $('#classe_id')
        let $category = $('#category_id')
        let $echelon = $('#echelon_id')
        let $form = $('form')


        function updateIndice(id) {
            let $el = $('#indice'+id)
            $modal.modal('show')
            $name.val($el.attr('data-name'))
            $value.val($el.attr('data-value'))
            $salary.val($el.attr('data-salary'))
            $category.val($el.attr('data-category'))
            $classe.val($el.attr('data-classe'))
            $echelon.val($el.attr('data-echelon'))
            $form.attr('action', $el.attr('data-route'))
            $form.append("<input type='hidden' name='_method' value='PUT'>")
        }

        $modal.on('hidden.bs.modal', function (e) {
            $value.val(null)
            $name.val(null)
            $category.val(null)
            $salary.val(null)
            $classe.val(null)
            $echelon.val(null)
            $form.attr('action', '')
            $('input[name="_method"]').remove()
        })
    </script>
@endsection