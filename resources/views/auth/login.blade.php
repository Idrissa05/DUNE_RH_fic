@extends('layouts.app')

@section('content')

    <div class="login-register">
        <div class="login-box card">
            <div class="card-body">
                <form class="form-horizontal form-material" id="loginform" action="{{ route('login') }}" method="post">
                    @csrf
                    <h3 class="box-title m-b-20 text-center">Authentification</h3>
                    <div class="form-group ">
                        <div class="col-xs-12">
                            <input id="name" placeholder="Nom d'utilisateur" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>

                            @if ($errors->has('name'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input id="password" placeholder="Mot de passe" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                            @endif
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="d-flex no-block align-items-center">
                            <div class="checkbox checkbox-primary p-t-0">
                                <input id="checkbox-signup" id="remember" name="remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                <label for="checkbox-signup"> Se souvenir de moi </label>
                            </div>
                            <div class="ml-auto">
                                <a href="{{ route('password.request')}}" id="to-recover" class="text-muted"><i class="mdi mdi-set"></i> Mot de passe oublié ?</a>
                            </div>
                        </div>
                    </div>
                    <div class="form-group text-center m-t-20">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-block text-uppercase waves-effect waves-light" type="submit">Se connecter</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
