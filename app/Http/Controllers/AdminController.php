<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use App\Album;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Image;




class AdminController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function show($user_id){

        $albums=Album::where('user_id',$user_id)->get();
        return view('admin',['albums'=>$albums]);
    }



    public function create(Request $request){

        if($request->isMethod('post')){
            if(Input::has('addAlbum')) {
                $rules = [
                    'name' => 'required|max:100|unique:albums',
                ];
                $massages = [
                    'required' => 'Это поле обязательно для заполнения',
                    'name.max' => 'Имя не может быть больше чем 100 символов!',
                    'unique' => 'Альбом с таким именем уже существует',

                ];
                $this->validate($request, $rules, $massages);
                $album =new Album;
                $album->name = $request->name;
                $album->info = $request->info;
                $album->user_id = Auth::user()->id;
                $album->save();
                return redirect()->back()->with('message','Новый альбом добавлен');//добавляем в сессию переменную message!!!!!
            }
            if(Input::has('addFoto')){
                $massages = [
                    'image' => 'Загруженный файл должен быть изображением в формате jpeg, png, bmp, gif или svg'
                ];
                $rules = [
                    'image' => 'mimes:jpeg,png,bmp,gif,svg,jpg'
                ];
                //$this->validate($request,$rules,$massages);
                if($request->hasFile('image')) {
                   $files = $request->file('image');
                   foreach($files as $file) {
                       $name = $file->getClientOriginalName();
                       $file->move(public_path('assets/images'),$name);
                       $image = new Image;
                       $image->images = $name;
                       $image->album_id = $request->albumid;
                       $image->save();
                   }
                    $album = Album::find($request->albumid);
                    $albumname = $album->name;
                    return redirect()->back()->with('message','Фотография добавлена в альбом '.$albumname);
                }
            }
            if(Input::has('addmusic')){
//                if($request->hasFile('music')){
//                    $music=$request->file('music');
//                    $music_name=$music->getClientOriginalName();
//                    $music->move(public_path('music'),$music_name);
                    phpinfo();
              //  }
            }


            }



    }



}
