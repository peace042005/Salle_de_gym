@extends('layouts.auth')
@section('content')
<section>
    <div class="container col-6">

        <div class="card">
            <div class="card-body">
                <h5 class="card-title text-center my-3">Mot de passe oublier</h5>

                <form method="POST" action="{{ route( doRessetPassword') }}">
                    @csrf
                    <div class="col-12 mb-3">
                        <label for="ressetPassword" class="form-label">Adresse mail</label>
                        <input name="ressetPassword" type="email" class="form-control" id="ressetPassword" placeholder="Entrez votre mail de connexion ">
                    </div>

                    <!-- submit boutton -->
                    <div class="col-12 mb-3">
                        <button class="btn btn-primary w-100 py-2" type="submit">Se connecter</button>
                    </div>

                    <span class="text-end">Pas inscrire? <a href="{{ route( register') }}">Inscrivez-vous</a></span>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection