<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */


    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $url='https://www.061.ua/news';
        $referer='https://www.google.com.ua/';
        $ch=curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:56.0) Gecko/20100101 Firefox/56.0');
        curl_setopt($ch,CURLOPT_REFERER,$referer);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        $data=curl_exec($ch);
        curl_close($ch);
        file_put_contents('1',$data);
        return view('home',['data' => $data]);
    }
}
