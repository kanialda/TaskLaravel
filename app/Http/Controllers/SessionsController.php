<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Validator;
use Auth;
use App\Session;

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
    
    

    if(Auth::attempt(array('name' => $request->name, 'password' => $request->password), ($request->remember ? true : false))) {
      Session::flash('notice', 'Login Success,' . $request->name);
      return Redirect::to('/');
      } else {
        Session::flash('error', 'Login Fails, User or Password is wrong.');
        return Redirect::to('sessions/create')
          ->withInput();
      }
    }
  public function create(){
        return view('sessions.create');
    }
  public function destroy($id)
  {
    Auth::logout();
    Session::flash('notice', 'Success Logout');
    return Redirect::to('/');
  }
  
 
}
