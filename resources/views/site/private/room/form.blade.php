@extends('layouts.dash')

@section('title', 'Gestion des salles')
@section('headerTitle',
$room->exists
? 'LES SALLES | Modification de la salle N°' . $room->id
: "LES SALLES | Ajout
d'une nouvelle salle")

@section('content')
<div class="container-fluid">

    <div class="card">
        <form method="POST" action="{{ route($room->exists ? 'management.room.update' : 'management.room.store', $room->id) }}" enctype="multipart/form-data" class="vstack gap-3">
            @csrf
            @method($room->exists ? 'PUT' : 'POST')

            <div class="card-body">
                <div class="col-lg-12">
                    <div class="form-group mb-3">
                        <input id="searchInput" type="text" class="position-relative form-control">
                    </div>

                    <div id="mapView" class="w-100 mb-4" style="height: 350px;"></div>

                    <!-- <div class="row mb-3">
                        <div class="col-6">
                            <div class="form-group">
                                <label for="longitude">Longitude</label>
                                <input id="longitude" type="text" name="longitude" value="{{ old('longitude', $room->longitude) }}" class="form-control @error('longitude') is-invalid @enderror">
                                @error('longitude')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="form-group">
                                <label for="latitude">Latitude</label>
                                <input id="latitude" type="text" name="latitude" value="{{ old('latitude', $room->latitude) }}" class="form-control @error('latitude') is-invalid @enderror">
                                @error('latitude')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div> -->

                    <div class="row">
                        <div class="col-lg-6 mb-3">
                            @include('shared.form.input', [
                            'label' => 'Coordonée en Latitude',
                            'name' => 'longitude',
                            'type' => 'text',
                            'value' => $room->longitude,
                            'placeholder' => 'Entrez, cliquez ou recherchez la longitude',
                            ])
                        </div>
                        <div class="col-lg-6 mb-3">
                            @include('shared.form.input', [
                            'label' => 'Coordonée en Latitude',
                            'name' => 'latitude',
                            'type' => 'text',
                            'value' => $room->latitude,
                            'placeholder' => 'Entrez, cliquez ou recherchez la latitude',
                            ])
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 mb-3">
                    @include('shared.form.input', [
                    'label' => 'Nom de salle',
                    'name' => 'name',
                    'type' => 'text',
                    'value' => $room->name,
                    'placeholder' => 'Entrer le nom de la salle',
                    ])
                </div>

                <div class="row">
                    <div class="col-lg-6 mb-3">
                        @include('shared.form.input', [
                        'label' => "L'url du site",
                        'name' => 'site_url',
                        'type' => 'text',
                        'value' => $room->site_url,
                        'placeholder' => "Entrer l'url du site de votre salle",
                        ])
                    </div>
                    <div class="col-lg-6 mb-3">
                        @include('shared.form.selectmultiple', [
                        'label' => 'Abonnement disponible pour la salle',
                        'name' => 'pricings',
                        'value' => $room->pricings()->pluck('id'),
                        'selectMultipleOptions' => $pricings,
                        ])
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-9 mb-3">
                        @include('shared.form.selectmultiple', [
                        'label' => 'Equipements',
                        'name' => 'outfits',
                        'value' => $room->outfits()->pluck('id'),
                        'selectMultipleOptions' => $outfits,
                        ])
                    </div>
                    <div class="col-lg-3 mb-3 form-check form-switch dflex justify-end">
                        <p></p><br>
                        @include('shared.form.checkswitch', [
                        'label' => 'Disponible?',
                        'name' => 'status',
                        'value' => $room->status,
                        ])
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 mb-3">
                        @include('shared.form.fileimage', [
                        'label' => 'Image de couverture de la salle',
                        'name' => 'cover_image',
                        'value' => $room->cover_image,
                        ])
                    </div>
                    <div class="col-lg-6 mb-3">
                        @include('shared.form.fileimage', [
                        'label' => 'Image de couverture',
                        'name' => 'overview_image',
                        'value' => $room->overview_image,
                        ])
                    </div>
                </div>

                {{-- seconde ligne --}}
                <div class="col-lg-12 mb-3">
                    @include('shared.form.textarea', [
                    'label' => 'Description',
                    'name' => 'description',
                    'value' => $room->description,
                    'placeholder' => 'Entrer une description de votre salle',
                    ])
                </div>
            </div>

            <div class="card-footer bg-light">
                <div class="d-flex justify-content-center">

                    <a href="{{ route('management.room.index') }}" type="button" class="btn btn-danger light me-2">
                        <i class="fas fa-times-circle"></i>
                        @if ($room->exists)
                        Annuller les modifications
                        @else
                        Annuller l'ajout
                        @endif
                    </a>

                    <button type="submit" class="btn btn-success">
                        <i class="fas fa-check-circle"></i>
                        @if ($room->exists)
                        Enrégister les modifications
                        @else
                        Ajouter une salle
                        @endif
                    </button>

                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@push('script')

    <script src="http://maps.google.com/maps/api/js?key=AIzaSyAUfKZZCI4r4AYrpRCTmovABlDBIK_9JQM&libraries=places&sensor=true"></script>
    <script src="{{ asset('template/map.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            var icon = {
                path: "M0-48c-9.8 0-17.7 7.8-17.7 17.4 0 15.5 17.7 30.6 17.7 30.6s17.7-15.4 17.7-30.6c0-9.6-7.9-17.4-17.7-17.4z",
                fillColor: "#69A033",
                fillOpacity: 0.8,
                strokeWeight: 0,
                rotation: 0,
                scale: 0.7,
                labelOrigin: new google.maps.Point(0, -25)
            }

            // map controller
            var map = new Circuit('latitude', 'longitude', 'mapView', 'searchInput', icon, 'point');

            map.addMarker(
                '<?php echo ($room->latitude); ?>', '<?php echo ($room->longitude); ?>', null, '<?php echo ($room->name); ?>'
                // {{ $room->latitude ?: 6.366667 }}, {{ $room->longitude ?: 2.433333 }}, null, {{$room->name }}
            );

            $('#latitude').keypress(function(event) {
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });

            $('#longitude').keypress(function(event) {
                if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
                    event.preventDefault();
                }
            });

            $('#latitude').change(function() {
                val = parseFloat($(this).val())
                if (val) {
                    let position = new google.maps.LatLng(val, map.markers[0].getPosition().lng());
                    map.moveMarker('', position);
                }
            })

            $('#longitude').change(function() {
                val = parseFloat($(this).val())
                if (val) {
                    let position = new google.maps.LatLng(map.markers[0].getPosition().lat(), val);
                    map.moveMarker('', position);
                }
            })
        });
    </script>
@endpush
