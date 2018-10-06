<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Image;

class ImagesController extends Controller
{
    //
    public function show($album_id)
    {
        $images = Image::where('album_id',$album_id)->get();
    
        return view('images',['images'=>$images]);
    }
}
