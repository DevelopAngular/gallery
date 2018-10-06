@extends('layouts.app')

@section('content')
    <div class="col-md-6 ">
            <h2>Форма добавления альбома</h2>
        <div class="panel-body">
            <form class="form-horizontal" role="form" method="POST" id="1"  action="{{ url('/admin') }}" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                    <label for="name" class="col-md-4 control-label">Имя альбома</label>
                    <div class="col-md-6">
                        <input id="name" type="text" class="form-control" name="name" value="{{ old('name') }}">

                        @if ($errors->has('name'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group{{ $errors->has('info') ? ' has-error' : '' }}">
                    <label for="info" class="col-md-4 control-label">Комментарий к альбому</label>
                    <div class="col-md-6">
                         <textarea name="info" id="info" class="form-control" value="{{ old('info') }}"></textarea>

                        @if ($errors->has('info'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('info') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-4">
                        <input type="submit" id="album" name="addAlbum" class="btn btn-primary" value=" Добавить альбом">
                            @if(session('message'))
                                <div class="alert alert-danger">
                                    {{ session('message') }}
                                </div>
                            @endif

                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel-body">
            @if(count($albums) < 1)
                <h1 style="color:greenyellow">Добавьте альбом чтоб можно было добавлять фотографии</h1>
            @else
            <h2>Форма добавления фотографий в альбом</h2>
            <form class="form-horizontal" action="{{ url('/admin') }}" id="2"  method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                <div class="form-group">
                    <lable class="control-label">Выберите альбом</lable>
                    <select name="albumid" class="sel">
                        @foreach($albums as $album)
                            <option value="{{ $album->id }}">{{ $album->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <div class="col-md-6">
                        <input type="file" name="image[]" multiple>
                        @if ($errors->has('image'))
                            <span class="help-block">
                                        <strong>{{ $errors->first('image') }}</strong>
                                    </span>
                        @endif
                    </div>
                </div>
                <div class="form-group">
                <input type="submit" name="addFoto" id="foto" class="btn btn-primary" value="Добавить фото">
                </div>
            </form>
                @endif
    </div>
    </div>
   <div class="col-md-6">
       <h1>Форма добавления музыки</h1>
       <form class="form-horizontal" action="{{ url('/admin') }}" id="3"  method="post" enctype="multipart/form-data">
           {{ csrf_field() }}
           <div class="form-group">
           <input type="file" name="music[]" multiple>
           <input type="submit" name="addmusic" value="Добавить" class="btn btn-primary">
           </div>
       </form>
   </div>


@endsection