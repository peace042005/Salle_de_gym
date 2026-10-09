@extends('layouts.dash')

@section('title', 'Dashboad')
@section('headerTitle', 'MON COMPTE')

@section('content')
<div class="container-fluid">
    <div class="card-header bg-light mb-5">
        <div class="col-lg-3">
            <button href="" type="button" class="btn btn-primary mb-2" data-bs-toggle="modal" data-bs-target="#showBecomeManagerModal">Devenir menbre</button>
            @include('site.private.dashboad.user.modals.become-manager-modal')
        </div>
    </div>

    <div class="col-lg-12">
        <!-- <div class="d-flex gap-4"> -->
        <!-- show information about subscription -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Mon abonnement</h5>
            </div>
            <div class="card-body">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Inventore in nemo omnis accusamus deserunt minus eveniet maiores itaque a quasi officiis, optio blanditiis voluptate. Voluptatum veniam delectus non eum suscipit?</p>

                <div class="table">
                    <div class="table-responsive">
                        <table class="table table-striped table-responsive-sm">
                            <thead>
                                <tr>
                                    <th class="text-start">#</th>
                                    <th class="text-start">Nom</th>
                                    <th class="text-start">Validité</th>
                                    <th class="text-start">Salle</th>
                                    <th class="text-start">Créer le</th>
                                    <th class="text-end"></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($roomSubscriptionList as $subscription)
                                <tr>
                                    <td class="text-start"></td>
                                    <td class="text-start">{{ $subscription->pricing->name }}</td>
                                    <td class="text-start">{{ $subscription->pricing->duration }} jours</td>
                                    <td class="text-start">{{ $subscription->room->name }} jours</td>
                                    <td class="text-start">@include('shared.format.date', ['value' => $subscription->created_at])</td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showSubscriptionDetailsModal{{$subscription->id}}">Consulter</button>
                                    </td>
                                </tr>

                                <!-- showSubscriptionDetailsModal modal -->
                                @include('site.private.dashboad.user.modals.show-subscription-details-modal')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- show information about purchase -->
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Mes achats</h5>
            </div>
            <div class="card-body">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Inventore in nemo omnis accusamus deserunt minus eveniet maiores itaque a quasi officiis, optio blanditiis voluptate. Voluptatum veniam delectus non eum suscipit?</p>

                <div class="table">
                    <div class="table-responsive">
                        <table class="table table-striped table-responsive-sm">
                            <thead>
                                <tr>
                                    <th class="text-start">#</th>
                                    <th class="text-start">Equipement acheté</th>
                                    <th class="text-start">Prix</th>
                                    <th class="text-start">Status de l'achat</th>
                                    <th class="text-start">Créer le</th>
                                    <th class="text-end"></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($purchasesList as $purchase)
                                <tr>
                                    <td class="text-start"></td>
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
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showPurchaseDetailsModal{{$purchase->id}}">Consulter</button>
                                    </td>
                                </tr>

                                <!-- showSubscriptionDetailsModal modal -->
                                @include('site.private.dashboad.user.modals.show-purchase-details-modal')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <!-- </div> -->
    </div>
</div>
@endsection