@extends('layouts.app')

@section('content')

    @foreach($images as $image)
        <div class="col-md-4">
             <img src="{{ asset('assets/images/'.$image->images) }}" class="img-circle" style="width: 300px;">
        </div>
    @endforeach


@endsection