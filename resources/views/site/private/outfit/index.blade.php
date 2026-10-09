@extends('layouts.dash')

@section('title', 'Equipements')
@section('headerTitle', 'EQUIPEMENTS')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-light">
                <div class="col-lg-3">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#createModal">
                        Ajouter un équipement
                    </button>
                </div>
                <div class="col-lg-9">
                    {{-- <div class="input-group">
                        <input type="text" class="form-control border-light" placeholder="Rechercher..."
                            aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-primary" type="button" id="button-addon2">Rechercher</button>
                    </div> --}}

                    @include('shared.search', ['action' => "management.outfit.index", 'inputClass' => "form-control border-light"])
                </div>
            </div>

            @if ($outfitList)
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
                                                <th class="text-start">Nom</th>
                                                <th class="text-start">Description </th>
                                                <th class="text-start">Prix</th>
                                                <th class="text-start">Status</th>
                                                <th class="text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($outfitList as $outfit)
                                            
                                                <tr>
                                                    <!-- <td class="text-start">{{ $loop->index + 1 }}</td> -->
                                                    <td class="text-start">
                                                        {{ ($outfitList->currentPage() - 1) * $outfitList->perPage() + $loop->iteration }}
                                                    </td>
                                                    <td class="text-start col-md-3">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <img src="@include('shared.format.imgpath', ['value' => $outfit->cover_image])" height="50"
                                                                    width="50" alt="">
                                                            </div>
                                                            <div class="col-md-9">
                                                                {{ Str::limit($outfit->name, 80) }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-start col-md-4">
                                                        {{ Str::limit($outfit->description, 135) }}</td>
                                                    <td class="text-start">
                                                        @include('shared.format.price', ['value' => $outfit->sale_price])
                                                    </td>
                                                    <td class="text-start">
                                                        @if ($outfit->status == 0)
                                                            <span class="badge rounded-pill bg-danger">Indisponible</span>
                                                        @else
                                                            <span class="badge rounded-pill bg-success">Disponible</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-end">
                                                        <div class="btn-toolbar justify-content-end">
                                                            <div class=" btn-group btn-group-sm">
                                                                <!-- show -->
                                                                <a href="{{ route('management.outfit.show', $outfit->id) }}"
                                                                    type="button" class="btn btn-outline-info mx-1">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                                <!-- edit -->
                                                                <a href="{{ route('management.outfit.update', $outfit->id) }}"
                                                                    type="button" class="btn btn-outline-success mx-1"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#updateModal{{ $outfit->id }}">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <!-- delete -->
                                                                <form method="POST"
                                                                    action="{{ route('management.outfit.destroy', $outfit->id) }}">
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
                                                @include('site.private.outfit.modals.editmodal')
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
                    {{ $outfitList->withQueryString()->links() }}
                </div>
            @else
                <div class="d-flex justify-content-center">
                    <img src="{{ asset('template/empty_collection.jpeg') }}" alt="empty_collection" class="">
                </div>
            @endif
        </div>
    </div>

    <!-- create modal -->
    @include('site.private.outfit.modals.createmodal')

@endsection
