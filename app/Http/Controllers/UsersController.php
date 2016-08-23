<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class UsersController extends Controller {
    public function create() {
        return view('users.create');
    }

    public function store() {
        $data = Input::all();
        $validate = Validator::make($data, User::valid());
        if ($validate -> fails()) {
            return Redirect::to('users/create') -> withErrors($validate) -> withInput();
        } else {
            $user = new User;
            $user -> email = Input::get('email');
            $user -> username = Input::get('username');
            $user -> password = Hash::make(Input::get('password'));
            $user -> save();
            Session::flash('notice', 'Signup Success');
            return Redirect::to('users/create');
        }
    }
}
