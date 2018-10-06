<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Request;
use App\User;
use Validator;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;


class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers, ThrottlesLogins;

    /**
     * Where to redirect users after login / registration.
     *
     * @var string
     */
    protected $redirectTo = '/';
    protected $username = 'login';

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware($this->guestMiddleware(), ['except' => 'logout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        //массив ошибок
        $messages=[
            'required'=>'Это поле обязательно для заполнения',
            'name.max' => 'Имя не может быть больше чем 100 символов!',
            'password.min' => 'Пароль должен состоять минимум из 4 символов',
            'email.between' => 'Ваш Email должен состоять минимум из 3 и максимум из 100 символов!',
            'login.between' => 'Ваш Login должен состоять минимум из 3 и максимум из 100 символов!',
            'email' => 'Неверный Email адрес',
            'confirmed' => 'Пароли должны совпадать!',
            'unique' => 'Такой Логин уже существует',
            'image' => 'Аватар должен быть изображением'
        ];
        return Validator::make($data, [
            'name' => 'required|max:100',
            'email' => 'required|email|between:3,100|unique:users',
            'password' => 'required|min:4|confirmed',
            'login' => 'required|between:3,100|unique:users',
            'avatar' => 'image'
        ],$messages);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */

    protected function create(array $data)
    {
        if (Input::hasFile('avatar')) {
            $name = Input::file('avatar')->getClientOriginalName();
            Input::file('avatar')->move(public_path('assets/avatars'), $name);
        }
        if(!isset($name)){
            $name = 'avatar-defoult.jpg';
        }

        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'login' => $data['login'],
            'avatar' => $name
        ]);
    }
}
