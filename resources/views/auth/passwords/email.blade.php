<html>
    <head>
        <link rel="stylesheet" href="{{ asset('bootstrap.min.css') }}">
        <script src="{{ asset('jquery.min.js') }}"></script>
        <script src="{{ asset('popper.min.js') }}"></script>
        <script src="{{ asset('bootstrap.min.js') }}"></script>
        <style>
            .register{
                    background: -webkit-linear-gradient(left, #3931af, #00c6ff);
                    margin-top: 3%;
                    padding: 3%;
                }
                .register-left{
                    text-align: center;
                    color: #fff;
                    margin-top: 4%;
                }
                .register-left input{
                    border: none;
                    border-radius: 1.5rem;
                    padding: 2%;
                    width: 60%;
                    background: #f8f9fa;
                    font-weight: bold;
                    color: #383d41;
                    margin-top: 30%;
                    margin-bottom: 3%;
                    cursor: pointer;
                }
                .register-right{
                    background: #f8f9fa;
                    border-top-left-radius: 10% 50%;
                    border-bottom-left-radius: 10% 50%;
                }
                .register-left img{
                    margin-top: 15%;
                    margin-bottom: 5%;
                    width: 25%;
                    -webkit-animation: mover 2s infinite  alternate;
                    animation: mover 1s infinite  alternate;
                }
                @-webkit-keyframes mover {
                    0% { transform: translateY(0); }
                    100% { transform: translateY(-20px); }
                }
                @keyframes mover {
                    0% { transform: translateY(0); }
                    100% { transform: translateY(-20px); }
                }
                .register-left p{
                    font-weight: lighter;
                    padding: 12%;
                    margin-top: -9%;
                }
                .register .register-form{
                    padding: 10%;
                    margin-top: 10%;
                }
                .btnRegister{
                    float: right;
                    margin-top: 10%;
                    border: none;
                    border-radius: 1.5rem;
                    padding: 2%;
                    background: #0062cc;
                    color: #fff;
                    font-weight: 600;
                    width: 50%;
                    cursor: pointer;
                }
                .register .nav-tabs{
                    margin-top: 3%;
                    border: none;
                    background: #0062cc;
                    border-radius: 1.5rem;
                    width: 28%;
                    float: right;
                }
                .register .nav-tabs .nav-link{
                    padding: 2%;
                    height: 34px;
                    font-weight: 600;
                    color: #fff;
                    border-top-right-radius: 1.5rem;
                    border-bottom-right-radius: 1.5rem;
                }
                .register .nav-tabs .nav-link:hover{
                    border: none;
                }
                .register .nav-tabs .nav-link.active{
                    width: 100px;
                    color: #0062cc;
                    border: 2px solid #0062cc;
                    border-top-left-radius: 1.5rem;
                    border-bottom-left-radius: 1.5rem;
                }
                .register-heading{
                    text-align: center;
                    margin-top: 8%;
                    margin-bottom: -15%;
                    color: #495057;
                }
        </style>
    </head>
    <body>
        <div class="container register">
        <div class="row justify-content-center">
            <div class="col-md-3 register-left">
                <img src="{{ asset('logo.png') }}" width="100px" height="60px" alt="homepage" class="light-logo" />
                <h3>Bienvenue</h3>
                    <h4>DUNE RH</h4>
                    <h6 >Vous avez déja un compte?<a style="color: aqua;" href="{{ route('login')}}" class=""> Connectez vous</a></h6><br>
            </div>
            <div class="col-md-9 register-right">
                <div class="tab-content" id="myTabContent">
                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                        <h3 class="register-heading">Récuperation de mot de passe</h3>
                        <form action="{{ route('reinitialiser_password') }}" method="post">
                            @csrf
                            <div class="row register-form justify-content-center">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <input placeholder="Entrez votre matricule ou identifiant *" type="text" class="form-control{{ $errors->has('matricule') ? ' is-invalid' : '' }}" name="matricule" required autofocus>
                                        @if ($message = Session::get('error'))
                                            <div class="alert alert-danger alert-block">

                                                <button type="button" class="close" data-dismiss="alert">×</button>	

                                                    <strong>{{ $message }}</strong>

                                            </div>
                                        @endif
                                        @if ($errors->has('matricule'))
                                            <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('matricule') }}</strong>
                                            </span>
                                        @endif
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary">Réinitialiser</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            </div>
    </body>
</html>