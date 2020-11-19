@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-6 mx-auto">
            <p class="h3 text-center">Orders</p>

            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Lat</th>
                        <th>Lng</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                @forelse($orders as $order)
                    <tr>
                        <td>{{ $order->name }}</td>
                        <td>{{ $order->address ?? __('Unknown Location') }}</td>
                        <td>{{ $order->lat }}</td>
                        <td>{{ $order->lng }}</td>
                        <td>
                            <a href="{{ route('orders.show', $order->id) }}" class="btn btn-info text-white">View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-danger">No data here...</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                </div>

                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" name="address" id="address" class="form-control" placeholder="Name">
                    <div id="map-canvas"></div>
                </div>

                <div class="form-group">
                    <label for="lat">Latitude</label>
                    <input type="text" name="lat" id="lat" class="form-control" placeholder="Name">
                </div>

                <div class="form-group">
                    <label for="lng">Longitude</label>
                    <input type="text" name="lng" id="lng" class="form-control" placeholder="Name">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>

    @push('css')@endpush
    @push('js')
        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>
        <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GMAPS_API_KEY') }}&callback=initMap&libraries=places&v=weekly" defer></script>
        <script defer>
            let map, marker, searchBox;
            function initMap() {
                map = new google.maps.Map(document.getElementById('map-canvas'), {
                    center: {
                        lat: -1.1371033,
                        lng: 36.96981268348891
                    },
                    zoom: 15
                });

                marker = new google.maps.Marker({
                    position: {
                        lat: -1.1371033,
                        lng: 36.96981268348891
                    },
                    map:map,
                    draggable: true
                });

                searchBox = new google.maps.places.SearchBox(document.getElementById('address'));
                google.maps.event.addListener(searchBox, 'places_changed', function () {
                    let places = searchBox.getPlaces();
                    let bounds = new google.maps.LatLngBounds();
                    let i, place;

                    for (i=0; place=places[i]; i++) {
                        bounds.extend(place.geometry.location);
                        marker.setPosition(place.geometry.location)
                    }

                    map.fitBounds(bounds);
                    map.setZoom(15);
                });

                google.maps.event.addListener(marker, 'position_changed', function () {
                    let lat = marker.getPosition().lat();
                    let lng = marker.getPosition().lng();

                    $('#lat').val(lat);
                    $('#lng').val(lng);
                });

            }
        </script>
    @endpush
@endsection
