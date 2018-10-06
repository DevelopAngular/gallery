@extends('layouts.app')

@section('content')

<div class="filter">
    <form action="{{ route('gallery') }}" method="post">
        {{ csrf_field() }}
        <select name="filter" id="filter">
            <option value="date">Самые новые впереди</option>
            <option value="alphabet">По алфавиту</option>
        </select>
        <input type="submit" value="Ok" id="filtervar" onclick ="onOn()">
    </form>
</div>
    @if(count($albums) > 0)
        @foreach($albums as $album)
            <a href="{{ route('images').'/'.$album->id }}">

                    <div class="col-md-3 albums">
                        <div class="col-md-3 album-name">{{ $album->name }}</div>

                </div>
            </a>
        @endforeach
        {!! $albums->render() !!}
        @endif

@endsection