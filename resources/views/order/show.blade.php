@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <p class="h3 text-center">{{ $order->name }} - {{ $order->address ?? __('Unknown Location') }}</p>

            <div id="map-canvas"></div>
        </div>
    </div>

    @push('js')
{{--        <script src="https://polyfill.io/v3/polyfill.min.js?features=default"></script>--}}
        <script src="https://maps.googleapis.com/maps/api/js?key={{ env('GMAPS_API_KEY') }}&callback=initMap&libraries=places&v=weekly" defer></script>
        <script defer>
            let map, marker;
            const lat = {{ $order->lat }};
            const lng = {{ $order->lng }};

            function initMap() {
                map = new google.maps.Map(document.getElementById('map-canvas'), {
                    center: {
                        lat: lat,
                        lng: lng
                    },
                    zoom: 15
                });

                marker = new google.maps.Marker({
                    position: {
                        lat: lat,
                        lng: lng
                    },
                    map:map,
                    draggable: false
                });

            }
        </script>
    @endpush
@endsection
