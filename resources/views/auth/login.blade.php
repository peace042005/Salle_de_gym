@extends('layouts.auth')
@section('content')

<section>
    <div class="container col-6">

        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <h5 class="card-title my-3">CONNEXION</h5>
                    @if (Session::has('loginErrorMessage'))
                    <div class="alert alert-danger">{{ Session::get('loginErrorMessage')}}</div>
                    @endif
                </div>

                <div class="d-flex justify-content-center">
                    <form method="POST" action="{{ route('doLogin') }}" class="row g-3">
                        @csrf
                        <input name="modal" value="false" type="text" hidden>
                        <div class="col-lg-12 mb-3">
                            <div class="mb-3">
                                <label for="email" class="form-label">Adresse mail :</label>
                                <input name="email" value="{{old('email')}}" type="email" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Veuillez entrer votre mail...">
                            </div>
                            <span class="text-danger">
                                @error('email')
                                <small class="text-tiny">{{$message}}</small>
                                @enderror
                            </span>
                        </div>

                        <div class="col-lg-12 mb-3">
                            <div class="mb-3">
                                <label for="password" class="form-label">Mot de passe :</label>
                                <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" placeholder="Veuillez entrer votre mot de passe...">
                            </div>
                            <span class="text-danger">
                                @error('password')
                                <small class="text-tiny">{{$message}}</small>
                                @enderror
                            </span>
                        </div>

                        <!-- other field -->
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-check">
                                    <input type="checkbox" id="staty-connect">
                                    <label for="staty-connect">
                                        Rester connecter
                                    </label>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <p class="text-end"><a href="{{ route('doRessetPassword') }}">Mot de passe oublié</a></p>
                            </div>
                        </div>

                        <!-- submit boutton -->
                        <div class="col-12">
                            <button class="btn btn-primary w-100 py-2" type="submit">Se connecter</button>
                        </div>

                        <span class="text-end">Pas inscrire? <a href="{{ route('register') }}">Inscrivez-vous</a></span>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection