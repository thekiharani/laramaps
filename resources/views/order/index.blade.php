@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-8 mx-auto">
            <p class="h3 text-center">Add Restaurant</p>

            <form action="{{ route('orders.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                    <input type="text" name="name" id="name" class="form-control" placeholder="Name">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Save</button>
                </div>
            </form>
        </div>
    </div>
@endsection
