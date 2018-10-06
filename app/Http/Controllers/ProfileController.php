<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

class ProfileController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }
    public function show()
    {

        $user= Auth::user();
        return view('profile',['user'=>$user]);
    }
    public function create(Request $request,$user_id){
        if($request->isMethod('post')) {
            $user = User::find($user_id);
            if(Input::has('uploadavatar')){
                $rules = [
                    'upavatar' => 'required|image',
                ];
                $messages = [
                    'image' => 'Загруженный файл должен быть картинкой',
                    'required' => 'Выберете картинку'
                ];
                $this->validate($request, $rules, $messages);
                if($request->hasFile('upavatar')){
                    $file = $request->file('upavatar');
                    $name = $file->getClientOriginalName();
                    $file->move(public_path('assets/avatars'),$name);
                    $user->avatar = $name;
                    $user->save();
                    return redirect()->back()->with('message','Ваш аватар изменен');
                }

            }
            if(Input::has('uploadname')){
                $rules = [
                    'upname' => 'required|max:100',
                ];
                $messages = [
                    'required'=>'Это поле обязательно для заполнения',
                    'max' => 'Имя не может быть больше чем 100 символов!',
                    'different' => 'У вас уже такое имя!'
                ];
                $this->validate($request, $rules, $messages);
                $user->name = $request->upname;
                $user->save();
                return redirect()->back()->with('message','Ваше имя изменено');
            }
            if(Input::has('uploademail')){
                $rules = [
                  'upemail' => 'required|email|between:3,100|unique:users,email'
                ];
                $messages = [
                    'between' => 'Ваш Email должен состоять минимум из 3 и максимум из 100 символов!',
                    'email' => 'Неверный Email адрес',
                    'required'=>'Это поле обязательно для заполнения',
                ];
                $this->validate($request,$rules,$messages);
                $user->email = $request->upemail;
                $user->save();
                return redirect()->back()->with('message','Ваш Email изменен');
            }
            if(Input::has('uploadlogin')){
                $rules = [
                    'uplogin' => 'required|unique:users,login|between:3,100'
                ];
                $messages = [
                    'required'=>'Это поле обязательно для заполнения',
                    'between' => 'Ваш Логин должен состоять минимум из 3 и максимум из 100 символов!',
                    'unique' => 'Такой Логин уже существует',
                ];
                $this->validate($request,$rules,$messages);
                $user->login = $request->uplogin;
                $user->save();
                return redirect()->back()->with('message','Ваш Логин изменен');

            }
        }
    }


}
