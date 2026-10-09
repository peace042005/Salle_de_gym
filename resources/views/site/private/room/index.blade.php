@extends('layouts.dash')

@section('title', 'Salle')
@section('headerTitle', 'LES SALLES')

@section('content')
    <div class="container-fluid">
        <div class="card">
            <div class="card-header bg-light">
                <div class="col-lg-3">
                    <a href="{{ route('management.room.create') }}" type="button" class="btn btn-primary mb-2">Ajouter une
                        salle</a>
                </div>
                <div class="col-lg-9">
                    {{-- <div class="input-group">
                        <input type="text" class="form-control border-light" placeholder="Rechercher..."
                            aria-label="Recipient's username" aria-describedby="button-addon2">
                        <button class="btn btn-primary" type="button" id="button-addon2">Rechercher</button>
                    </div> --}}

                    @include('shared.search', ['action' => "management.room.index", 'inputClass' => "form-control border-light"])
                </div>
            </div>

            @if ($roomLists)
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
                                                <th class="text-start">Status</th>
                                                <th class="text-end">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($roomLists as $room)
                                                <tr>
                                                    <td class="text-start">
                                                        {{ ($roomLists->currentPage() - 1) * $roomLists->perPage() + $loop->iteration }}
                                                    </td>
                                                    <td class="text-start col-md-3">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <img src="@include('shared.format.imgpath', ['value' => $room->cover_image])" height="50"
                                                                    width="50" alt="">
                                                            </div>
                                                            <div class="col-md-9">
                                                                {{ Str::limit($room->name, 80) }}
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td class="text-start col-md-4">
                                                        {{ Str::limit($room->description, 135) }}</td>

                                                    <td class="text-start">
                                                        @if ($room->status == 0)
                                                            <span class="badge rounded-pill bg-danger">Indisponible</span>
                                                        @else
                                                            <span class="badge rounded-pill bg-success">Disponible</span>
                                                        @endif
                                                    </td>
                                                    <td class="text-end">
                                                        <div class="btn-toolbar justify-content-end">
                                                            <div class=" btn-group btn-group-sm">
                                                                <!-- show -->
                                                                <a href="{{ route('management.room.show', $room->id) }}"
                                                                    type="button" class="btn btn-outline-info">
                                                                    <i class="fas fa-eye"></i>
                                                                </a>
                                                                <!-- edite -->
                                                                <a href="{{ route('management.room.edit', $room->id) }}"
                                                                    type="button" class="btn btn-outline-primary mx-1">
                                                                    <i class="fas fa-edit"></i>
                                                                </a>
                                                                <!-- delete -->
                                                                <form method="POST"
                                                                    action="{{ route('management.room.destroy', $room->id) }}">
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
                    {{ $roomLists->withQueryString()->links() }}
                </div>
            @else
                <div class="d-flex justify-content-center">
                    <img src="{{ asset('template/empty_collection.jpeg') }}" alt="empty_collection" class="">
                </div>
            @endif
        </div>
    </div>

@endsection
