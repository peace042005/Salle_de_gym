@extends('layouts.dash')

@section('title', 'Tarifs')
@section('headerTitle', "TYPE D'ABONNEMENTS")

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-light">
                <div class="col-lg-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                        Ajouter un tarif
                    </button>
                </div>
                <div class="col-lg-9">
                    {{-- <div class="input-group">
                        <input type="text" class="form-control border-light" placeholder="Rechercher..."
                            aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-primary" type="button" id="button-addon2">Rechercher</button>
                    </div> --}}

                    @include('shared.search', ['action' => "management.pricing.index", 'inputClass' => "form-control border-light"])
                </div>
            </div>

            @if ($pricingList)
                <div class="card-body">
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab" tabindex="0">
                            <div class="table">
                                <div class="table-responsive">
                                    <table class="table table-striped table-responsive-sm">
                                        <thead>
                                            <tr>
                                                <th class="text-start">#</th>
                                                <th class="text-start">Nom du forfait </th>
                                                <th class="text-start">Validité (en jours)</th>
                                                <th class="text-start">Montant</th>
                                                <th class="text-end">Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pricingList as $pricing)
                                                <tr>
                                                    <td class="text-start">{{ ($pricingList->currentPage() - 1) * $pricingList->perPage() + $loop->iteration }}</td>
                                                    <td class="text-start">{{ $pricing->name }}</td>
                                                    <td class="text-start">{{ $pricing->duration }} jours</td>
                                                    <td class="text-start">@include('shared.format.price', ['value' => $pricing->price])</td>
                                                    <td class="text-end">
                                                        <div class="btn-toolbar justify-content-end">
                                                            <div class=" btn-group btn-group-sm">
                                                                <!-- show -->
                                                                <a href="{{ route('management.pricing.show', $pricing->id) }}"
                                                                    type="button" class="btn btn-outline-info">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                                <!-- edit -->
                                                                <a href="{{ route('management.pricing.update', $pricing->id) }}"
                                                                    type="button" class="btn btn-outline-success mx-1"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#updateModal{{ $pricing->id }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <!-- delete -->
                                                                <form method="POST"
                                                                    action="{{ route('management.pricing.destroy', $pricing->id) }}">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button class="btn btn-outline-danger">
                                                                        <i class="fas fa-trash"></i>
                                                                    </button>
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                                <!-- edit modal -->
                                                @include('site.private.pricing.modals.editmodal')
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light">
                    <!-- pagination -->
                    {{ $pricingList->withQueryString()->links() }}
                </div>
            @else
                <div class="d-flex justify-content-center">
                    <img src="{{ asset('template/empty_collection.jpeg') }}" alt="empty_collection" class="">
                </div>
            @endif
        </div>
    </div>


    <!-- create modal -->
    @include('site.private.pricing.modals.createmodal')

@endsection
