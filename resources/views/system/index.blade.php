@extends('layouts.material')


@section('content')

    <div class="card card-outline-info">
        <div class="card-body">
            <h3 class="text-center label-default">Système</h3>
            {!! form_start($form) !!}
            <div class="row">
                <div class="col-sm-6 offset-sm-3">
                    {!! form_row($form->name) !!}
                    {!! form_row($form->theme) !!}
                    <div class="form-group">
                        <button class="btn btn-primary" type="submit">Enregistrer</button>
                    </div>
                </div>
            </div>

            {!! form_end($form) !!}

        </div>
    </div>
@endsection