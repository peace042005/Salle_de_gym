@extends('layouts.guest')

@section('content')


<section>
    <div class="container ">
        <div class="d-flex justify-content-center row">
            <div class="text-center mt-4">
                <h1>Bienvenu sur {{env('APP_NAME')}}</h1>
                <p>Notre platforme vous propose nos différentes salles de gym, ainsi que leur offres et services.</p>
            </div>
        </div>

        <div class="card">
            <div class="col-12">
                <div class="form-group">
                    <input id="search_input" type="text" class="position-relative form-control">
                </div>

                <div id="map_view" class="w-100" style="height: 350px;"></div>
                <div class="row mt-2">
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Longitude</label>
                            <input id="lng" type="text" name="longitude" class="form-control @error('longitude') is-invalid @enderror">
                            @error('longitude')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label for="">Latitude</label>
                            <input id="lat" type="text" name="latitude" class="form-control @error('latitude') is-invalid @enderror">
                            @error('latitude')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection