@extends('layouts.dash')

@section('title', 'Achats')
@section('headerTitle', 'LES ACHATS')

@section('content')
<div class="container-fluid">
    <!-- first section -->
    @if($purchasersList)
    <section>
        <div class="card">
            <div class="card-body my-0 py-0">
                <div class="read-content">
                    <div class="media pt-3 d-sm-flex d-block justify-content-between">
                        <div class="clearfix mb-3">

                        </div>
                        <div class="clearfix mb-3 d-flex">
                            <h5 class="card-title mt-3">List des acheuters</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($purchasersList as $user)
            <div class="col-sm-3">
                <a href="javascript:void" data-bs-toggle="modal" data-bs-target="#showPurchaseDetailsModal{{$user->id}}">
                    <div class="card">
                        <div class="card-body my-0 py-0">
                            <div class="read-content">
                                <div class="media pt-3 d-sm-flex d-block justify-content-between">
                                    <div class="clearfix mb-0 d-flex">
                                        <img src="@include('shared.format.imgpath', ['value' => $user->photo])" class="me-3 rounded" width="70" height="70" alt="image">
                                        <div class="media-body me-2">
                                            <h5 class="fs-4 text-primary mb-0 mt-1">{{ $user->first_name }} {{ $user->last_name }}</h5>
                                            <p class="mb-0">{{ $user->email }}</p>
                                            <p class="mb-0">{{ $user->phone_number }}</p>

                                            @if ($user->is_subscribed)
                                            <p class="mb-0 text-success"><i class="fas fa-check-circle me-2"></i>Abonnement actif</p>
                                            @else
                                            <p class="mb-0 text-muted"><i class="fas fa-circle me-2"></i>Abonnement inactif</p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <hr class="mb-2 py-0">
                                <p class="mb-0">Nombre d'abonnement : {{ $user->roomSubscriptions()->count() }}</p>
                                <p class="mb-2">Nombre d'équipements achetés : {{ $user->purchases()->count() }}</p>
                            </div>
                        </div>
                    </div>
                </a>
                @include('site.private.purchase.show-modal')
            </div>
            @endforeach
        </div>
    </section>
    @else
    <div class="d-flex justify-content-center">
        <img src="{{ asset('template/empty_collection.jpeg') }}" alt="empty_collection" class="">
    </div>
    @endif


    <!-- second section -->
    @if ($purchasesList)
    <section>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">List des achats d'équipements</h5>
            </div>
            <div class="card-body">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Inventore in nemo omnis accusamus deserunt minus eveniet maiores itaque a quasi officiis, optio blanditiis voluptate. Voluptatum veniam delectus non eum suscipit?</p>

                <div class="table">
                    <div class="table-responsive">
                        <table class="table table-striped table-responsive-sm">
                            <thead>
                                <tr>
                                    <th class="text-start">#</th>
                                    <th class="text-start">Acheteur</th>
                                    <th class="text-start">Equipement acheté</th>
                                    <th class="text-start">Prix</th>
                                    <th class="text-start">Etat de livration</th>
                                    <th class="text-start">Date de l'achat</th>
                                    <th class="text-end"></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchasesList as $purchase)
                                <tr>
                                    <td class="text-start">{{ $loop->index + 1 }}</td>
                                    <td class="text-start">
                                        <div class="read-content">
                                            <div class="media pt-3 d-sm-flex d-block justify-content-between">
                                                <div class="clearfix mb-0 d-flex">
                                                    <img src="@include('shared.format.imgpath', ['value' => $purchase->user->photo])" class="me-3 rounded" width="70" height="70" alt="image">
                                                    <div class="media-body me-2">
                                                        <h5 class="fs-4 text-primary mb-0 mt-1">{{ $purchase->user->first_name }} {{ $purchase->user->last_name }}</h5>
                                                        <p class="mb-0">{{ $purchase->user->email }}</p>
                                                        <p class="mb-0">{{ $purchase->user->phone_number }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-start">{{ $purchase->outfit->name }}</td>
                                    <td class="text-start">@include('shared.format.price', ['value' => $purchase->amount])
                                    </td>
                                    <td class="text-start">
                                        @switch($purchase->status)
                                        @case('completed')
                                        <span class="badge rounded-pill bg-success">Déjà livré</span>
                                        @break
                                        @case('failed')
                                        <span class="badge rounded-pill bg-danger">Annuler</span>
                                        @break
                                        @default
                                        <span class="badge rounded-pill bg-warning text-dark">En attente</span>
                                        @endswitch
                                    </td>
                                    <td class="text-start">@include('shared.format.date', ['value' => $purchase->created_at])</td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showDetailsModal{{$purchase->user->id}}">Details</button>
                                    </td>
                                </tr>
                                @include('site.private.purchase.details-modal')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        @else
        <div class="d-flex justify-content-center">
            <img src="{{ asset('template/empty_collection.jpeg') }}" alt="empty_collection" class="">
        </div>
    </section>
    @endif
</div>

@endsection