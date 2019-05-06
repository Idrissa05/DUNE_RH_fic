@extends('layouts.app')

@section('content')
    <div class="login-register">
        <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal" action="{{ route('password.update') }}" method="post">
                    @csrf

                    <div class="form-group ">
                        <div class="col-xs-12">
                            <h3>Récuperation de mot de passe</h3>
                            <p class="text-muted">Entrer votre email! </p>
                        </div>
                    </div>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input placeholder="Votre email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg btn-block text-uppercase waves-effect waves-light" type="submit">Réinitialiser</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
