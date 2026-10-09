@extends('layouts.dash')

@section('title', "Outfit Details")
@section('headerTitle', "DETAILS DE L'Equipement")

@section('content')
<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <div class="">
                <p><h4><span class="mb-3"><strong>Titre de l'équipement :</strong> {{ $outfit->name }}</span></h4></p>

                <div class="">
                    <h4><span class="mb-3"><strong>Description de l'équipement :</strong></span></h4>
                    <p> {{ $outfit->description }}</p>
                </div>

                <p><h4><span class="mb-3"><strong>Prix de vente de l'équipement :</strong> {{ $outfit->sale_price }} {{ $outfit->currency }}</span></h4></p>
                <p><h4><span class="mb-3"><strong>Créer le :</strong> @include('shared.format.date', ['value' => $outfit->created_at])</span></h4> <!-- diffForHumans() | format('l jS \\of F Y h:i:s A') --></p>
            </div>
        </div>
    </div>
</div>
@endsection