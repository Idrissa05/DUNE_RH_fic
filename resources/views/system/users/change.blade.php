@extends('layouts.material')

@section('content')
    <h3 class="m-b-0 text-white text-center bg-primary">Changement de mot de passe</h3>

    <div class="card card-outline-info">
        <div class="card-body">

            @if($errors->any())
                <ul>
                    @foreach($errors as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>

            @endif

            <form action="" method="post">
                @csrf
            <div class="row">
                <div class="col-sm-4 offset-sm-4">
                    <div class="form-group">
                        <label for="old_password">Ancien mot de passe</label>
                        <input type="password" id="old_password" name="old_password" class="form-control {{ $errors->has('old_password') ? 'is-invalid' : '' }}">
                        <div class="invalid-feedback">
                            {!! $errors->first('old_password') !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password">Nouveau mot de passe</label>
                        <input type="password" id="password" name="password" class="form-control {{ $errors->has('password') ? 'is-invalid' : '' }}">
                        <div class="invalid-feedback">
                            {!! $errors->first('password') !!}
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="password_confirmation">Confirmation de mot de passe</label>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control {{ $errors->has('password_confirmation') ? 'is-invalid' : '' }}">
                        <div class="invalid-feedback">
                            {!! $errors->first('password_confirmation') !!}
                        </div>
                    </div>
                    <button class="col-md-12 btn btn-outline-primary">Changer</button>
                </div>
            </div>
            </form>
        </div>
    </div>
@endsection
