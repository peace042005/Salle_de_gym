@extends('layouts.dash')

@section('title', 'Abonnements')
@section('headerTitle', 'LES ABONNEMENTS')

@section('content')
<div class="container-fluid">
    <!-- first section -->
    @if($subscribersList)
    <section>
        <div class="card">
            <div class="card-body my-0 py-0">
                <div class="read-content">
                    <div class="media pt-3 d-sm-flex d-block justify-content-between">
                        <div class="clearfix mb-3">

                        </div>
                        <div class="clearfix mb-3 d-flex">
                            <h5 class="card-title mt-3">List des abonnés</h5>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            @foreach($subscribersList as $user)
            <div class="col-sm-3">
                <a href="javascript:void" data-bs-toggle="modal" data-bs-target="#showSubscriptionDetailsModal{{$user->id}}">
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
                @include('site.private.subscription.show-modal')
            </div>
            @endforeach
        </div>
    </section>
    @endif


    <!-- second section -->
    @if($subscriptionsList)
    <section>
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">List des abonnements</h5>
            </div>
            <div class="card-body">
                <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Inventore in nemo omnis accusamus deserunt minus eveniet maiores itaque a quasi officiis, optio blanditiis voluptate. Voluptatum veniam delectus non eum suscipit?</p>

                <div class="table">
                    <div class="table-responsive">
                        <table class="table table-striped table-responsive-sm">
                            <thead>
                                <tr>
                                    <th class="text-start">#</th>
                                    <th class="text-start">Abonnés</th>
                                    <th class="text-start">Nom de l'abonnement</th>
                                    <th class="text-start">Validité</th>
                                    <th class="text-start">Nom de la Salle</th>
                                    <th class="text-start">Date d'abonnement</th>
                                    <th class="text-end"></th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($subscriptionsList as $subscription)
                                <tr>
                                    <td class="text-start">{{ $loop->index + 1 }}</td>
                                    <td class="text-start">
                                        <div class="read-content">
                                            <div class="media pt-3 d-sm-flex d-block justify-content-between">
                                                <div class="clearfix mb-0 d-flex">
                                                    <img src="@include('shared.format.imgpath', ['value' => $subscription->user->photo])" class="me-3 rounded" width="70" height="70" alt="image">
                                                    <div class="media-body me-2">
                                                        <h5 class="fs-4 text-primary mb-0 mt-1">{{ $subscription->user->first_name }} {{ $subscription->user->last_name }}</h5>
                                                        <p class="mb-0">{{ $subscription->user->email }}</p>
                                                        <p class="mb-0">{{ $subscription->user->phone_number }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-start">{{ $subscription->pricing->name }}</td>
                                    <td class="text-start">{{ $subscription->pricing->duration }} jours</td>
                                    <td class="text-start">{{ $subscription->room->name }} jours</td>
                                    <td class="text-start">@include('shared.format.date', ['value' => $subscription->created_at])</td>
                                    <td class="text-end">
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#showDetailsModal{{$subscription->user->id}}">Détails</button>
                                    </td>
                                </tr>
                                @include('site.private.subscription.details-modal')
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @endif
</div>

@endsection