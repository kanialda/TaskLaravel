<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class SessionsController extends Controller
{
    public function store(Request $request)
  {
    $valid = array(
      'username' => 'required',
      'password' => 'required'
    );

    $validate = Validator::make($request->all(), $valid);
    if($validate->fails()) {
      return Redirect::to('sessions/create')
        ->withErrors($validate)
        ->withInput();
    }

    if(Auth::attempt(array('username' => $request->username, 'password' => $request->password), ($request->remember ? true : false))) {
      Session::flash('notice', 'Login Success,' . $request->username);
      return Redirect::to('/');
      } else {
        Session::flash('error', 'Login Fails, User or Password is wrong.');
        return Redirect::to('sessions/create')
          ->withInput();
      }
    }

  public function destroy($id)
  {
    Auth::logout();
    Session::flash('notice', 'Success Logout');
    return Redirect::to('/');
  }
}
