@extends('layouts.dash')

@section('title', 'Accueil')
@section('headerTitle', 'ACCEUIL')

@section('content')
<div class="container-fluid">
    <div class="mb-5">
        <div class="row">
            <div class="col-lg-6">
                <div class="card border border-dark">
                    <div class="px-4">
                        <div class="pt-4 d-flex justify-content-between">
                            <h4 class=" font-w600 text-nowrap">Total équipements ajoutés</h4>
                            <div class="col-lg-6 text-end"><i class="fas fa-user-check"></i></div>
                        </div>

                        <h2 class="">{{$outfitsCount}}</h2>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card border border-dark">
                    <div class="px-4">
                        <div class="pt-4 d-flex justify-content-between">
                            <h4 class=" font-w600 text-nowrap">Total salles de gym ajoutés</h4>
                            <div class="col-lg-6 text-end"><i class="fas fa-user-check"></i></div>
                        </div>

                        <h2 class="">{{$roomsCount}}</h2>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-3">
            <div class="card border border-dark">
                <div class="px-4">
                    <div class="pt-4 d-flex justify-content-between">
                        <h4 class=" font-w600 text-nowrap">Total abonnés</h4>
                        <div class="col-lg-1 text-end"><i class="fas fa-user-check"></i></div>
                    </div>

                    <h2 class="">{{$subscribersCount}}</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card border border-dark">
                <div class="px-4">
                    <div class="pt-4 d-flex justify-content-between">
                        <h4 class=" font-w600 text-nowrap">Total abonnements</h4>
                        <div class="col-lg-1 text-end"><i class="fas fa-user-check"></i></div>
                    </div>

                    <h2 class="">{{$subscriptionsCount}}</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card border border-dark">
                <div class="px-4">
                    <div class="pt-4 d-flex justify-content-between">
                        <h4 class=" font-w600 text-nowrap">Total acheteurs</h4>
                        <div class="col-lg-1 text-end"><i class="fas fa-user-check"></i></div>
                    </div>

                    <h2 class="">{{$purchasersCount}}</h2>
                </div>
            </div>
        </div>

        <div class="col-lg-3">
            <div class="card border border-dark">
                <div class="px-4">
                    <div class="pt-4 d-flex justify-content-between">
                        <h4 class=" font-w600 text-nowrap">Total achats</h4>
                        <div class="col-lg-1 text-end"><i class="fas fa-user-check"></i></div>
                    </div>

                    <h2 class="">{{$purchasesCount}}</h2>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection