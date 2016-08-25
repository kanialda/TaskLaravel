<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use Illuminate\Support\Facades\Redirect;
use Input;
use App\User;
use App\Article;
use Auth;

class UsersController extends Controller {
    public function create() {

        return view('users.create');

    }

    public function store(Request $request) {

        $data = $request -> all();

        $validate = Validator::make($data, User::valid());

        if ($validate -> fails()) {

            return Redirect::to('users/create') -> withErrors($validate) -> withInput();

        } else {

            $user = new User;

            $user -> email = $request -> email;

            $user -> username = $request -> username;

            $user -> password = Hash::make($request -> password);

            $user -> save();

            Session::flash('notice', 'Signup Success');

            return Redirect::to('users/create');

        }

    }

}
