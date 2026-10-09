@extends('layouts.dash')

@section('title', "Tarifs détails")
@section('headerTitle', "DETAILS DE L'OFFRE D'ABONNEMENT")

@section('content')
<div class="container-fluid">
    <div class="card col-6">
        <div class="card-body">
            <div class="">
            <h4><span class="mb-3"><strong>Titre de l'abonnement :</strong> {{ $pricing->name }}</span></h4>
            <h4><span class="mb-3"><strong>Durée de l'abonnement :</strong> {{ $pricing->name }}</span></h4>
            <h4><span class="mb-3"><strong>Montant de l'abonnement :</strong> {{ $pricing->name }} {{ $pricing->currency }}</span></h4>
            <h4><span class="mb-3"><strong>Auteur de l'abonnement :</strong> {{ $pricing->user->first_name }} {{ $pricing->user->last_name }}</span></h4>
            <h4><span class="mb-3"><strong>Créer le :</strong> {{ $pricing->created_at->format('d-m-Y à h:i') }}</span></h4> <!-- diffForHumans() | format('l jS \\of F Y h:i:s A') -->
            </div>
        </div>
    </div>
</div>
@endsection