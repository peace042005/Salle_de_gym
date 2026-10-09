@extends('layouts.dash')

@section('title', 'Outfit Details')
@section('headerTitle', 'DETAILS DE LA SALLE')

@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-body my-0 py-0">
                <div class="read-content">
                    <div class="media pt-3 d-sm-flex d-block justify-content-between">
                        <div class="clearfix mb-3">
                            <a href="{{ route('management.room.index') }}" class="btn btn-primary px-3 my-1 light me-2"><i
                                    class="fa fa-reply me-2"></i> Revenir vers la liste</a>
                        </div>
                        <div class="clearfix mb-3 d-flex">
                            <img src="@include('shared.format.imgpath', ['value' => $room->user->photo])" class="me-3 rounded" width="70" height="70"
                                alt="image">
                            <div class="media-body me-2">
                                <h5 class="text-primary mb-0 mt-1">{{ $room->user->first_name }}
                                    {{ $room->user->last_name }}
                                </h5>
                                <p class="mb-0">{{ $room->user->email }}</p>
                                <p class="mb-0">{{ $room->user->phone_number }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body">
                <div class="post-details">
                    <div class="read-content">
                        <div class="media pt-3 d-sm-flex d-block justify-content-between">
                            <div class="clearfix mb-3 d-flex">
                                <div class="media-body me-2">
                                    <a href="{{ $room->site_url }}" target="_blank" rel="noopener noreferrer">
                                        <h5 class="text-primary mb-0 mt-1">Cliquer pour visiter notre site web !</h5>
                                    </a>
                                    <p class="mb-0">
                                        <i class="fas fa-calendar-plus me-2"></i>
                                        @include('shared.format.date', ['value' => $room->created_at])
                                    </p>
                                    <p class="mb-0">
                                        @if ($room->status == 0)
                                            <i class="fas fa-times-circle me-2"></i>Salle actuellement indisponible
                                        @else
                                            <i class="fas fa-check-circle me-2"></i>Salle actuellement disponible
                                        @endif
                                    </p>
                                </div>
                            </div>
                            <div class="clearfix mb-3">
                                <h3 class="mb-2 text-primary">Salle N°{{ $room->id }} | {{ $room->name }}</h3>
                            </div>
                        </div>
                    </div>

                    <img src="@include('shared.format.imgpath', ['value' => $room->overview_image])" alt="" class="img-fluid mb-3 w-100 rounded">
                    <div class="mt-3">{{ $room->description }}</div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-body my-0 pt-3 pb-0">
                <h4 class="text-black mb-2">Equipements disponible dans la salle</h4>
                <div class="profile-skills mt-3 mb-3">
                    @foreach ($room->pricings as $pricing)
                        <span class="btn btn-primary light btn-xs mb-1">{{ $pricing->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body my-0 pt-3 pb-0">
                <h4 class="text-black mb-2">Equipements disponible dans la salle</h4>
                <div class="profile-skills mt-3 mb-3">
                    @foreach ($room->outfits as $outfit)
                        <span class="btn btn-primary light btn-xs mb-1">{{ $outfit->name }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

@endsection
