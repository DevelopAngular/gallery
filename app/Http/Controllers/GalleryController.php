<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Album;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;

class GalleryController extends Controller
{
    //
    public function execute()
    {
        $albums = Album::paginate(12);
        //dd(json_encode($albums));

        return view('gallery',['albums'=>$albums]);

    }
    public function show(Request $request)
    {
        if ($request->isMethod('post')) {

            if ($request->filter == 'date') {
                $albums = Album::orderBy('created_at', 'desc')->paginate(12);
                //dump($albums);
                return view('gallery', ['albums' => $albums]);
            }
            if ($request->filter == 'alphabet') {

                $albums = Album::orderBy('created_at', 'asc')->paginate(12);
                return view('gallery',['albums' => $albums]);
            }
//        }
        }
    }
}
