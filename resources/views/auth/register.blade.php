@extends('layouts.auth')
@section('content')
<section>
    <div class="container col-8">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center my-3">INSCRIPTION</h5>

                <div class="d-flex justify-content-center">
                    <form method="POST" action="{{ route( 'doRegister') }}">
                        @csrf
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 mb-3">
                                    <div class="mb-3">
                                        <label for="firstName" class="form-label">Prénom :</label>
                                        <input name="first_name" value="{{old('first_name')}}" type="text" class="form-control" id="firstName" placeholder="Entrez votre prénom">
                                    </div>
                                    <span class="text-danger">
                                        @error('first_name')
                                        <small class="text-tiny">{{$message}}</small>
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="mb-3">
                                        <label for="lastName" class="form-label">Nom :</label>
                                        <input name="last_name" value="{{old('last_name')}}" type="text" class="form-control" id="lastName" placeholder="Entrez votre nom">
                                    </div>
                                    <span class="text-danger">
                                        @error('last_name')
                                        <small class="text-tiny">{{$message}}</small>
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-lg-12 mb-3">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Adresse mail :</label>
                                        <input name="email" value="{{old('email')}}" type="email" class="form-control" id="email" placeholder="Votre adresse mail">
                                    </div>
                                    <span class="text-danger">
                                        @error('email')
                                        <small class="text-tiny">{{$message}}</small>
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="mb-3">
                                        <label for="phoneNumber" class="form-label">Télephone :</label>
                                        <input name="phone_number" value="{{old('phone_number')}}" type="text" class="form-control" id="phoneNumber" placeholder="Numéro de téléphone">
                                    </div>
                                    <span class="text-danger">
                                        @error('phone_number')
                                        <small class="text-tiny">{{$message}}</small>
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="mb-3">
                                        <label for="birthDate" class="form-label">Date de naissance :</label>
                                        <input name="birth_date" value="{{old('birth_date')}}" type="date" class="form-control" id="birthDate" placeholder="">
                                    </div>
                                    <span class="text-danger">
                                        @error('birth_date')
                                        <small class="text-tiny">{{$message}}</small>
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Mot de passe :</label>
                                        <input name="password" type="password" class="form-control" id="password" placeholder="Votre mot de passe">
                                    </div>
                                    <span class="text-danger">
                                        @error('password')
                                        <small class="text-tiny">{{$message}}</small>
                                        @enderror
                                    </span>
                                </div>
                                <div class="col-lg-6 mb-3">
                                    <div class="mb-3">
                                        <label for="passwordConfirmation" class="form-label">Confirmation :</label>
                                        <input name="password_confirmation" type="password" class="form-control" id="passwordConfirmation" placeholder="Confirmerz le mot de passe">
                                    </div>
                                    <span class="text-danger">
                                        @error('password_confirmation')
                                        <small class="text-tiny">{{$message}}</small>
                                        @enderror
                                    </span>
                                </div>

                                <!-- submit boutton -->
                                <div class="col-12 mb-3">
                                    <button class="btn btn-primary w-100 py-2" type="submit">S'inscrire</button>
                                </div>

                                <span class="text-end">Déjà un compte ? <a href="{{ route( 'login') }}">Me connecter</a></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection