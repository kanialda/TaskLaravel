<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Article;
use Illuminate\Support\Facades\Validator;
use Session;
use \Input as Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Auth\Authenticatable;
class ArticlesController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request) {
    $articles = Article::paginate(4);//->toJson();

    if ($request::ajax()) {

     $view = (String)view('articles.list')

        ->with('articles', $articles)

        ->render();

     return response()->json(['view' => $view]);

    } else {

      return view('articles.index')

        ->with('articles', $articles);

    }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $file = array('image' => Input::file('image'));
        $rules = array('image' => 'required',);
        $validate = Validator::make($file, $rules, $request -> all(), Article::valid());
        if ($validate -> fails()) {
            return back() -> withErrors($validate) -> withInput();
        } else {
            if (Input::file('image')->isValid()) {
                $destinationPath = 'upload'; // upload path
                $extension = Input::file('image')->getClientOriginalExtension(); // getting image extension
                $fileName = rand(11111,99999).'.'.$extension; // renameing image
                Input::file('image')->move($destinationPath, $fileName); // uploading file to given path
                // sending back with message
                Session::flash('success', 'Upload successfully'); 
                return Redirect::to('upload');
            }
            else {
                // sending back with error message.
                Session::flash('error', 'uploaded file is not valid');
                return Redirect::to('upload');
                Article::create($request -> all());
                Session::flash('notice', 'Success add article');
                return Redirect::to('articles');
                }
        }
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        $article = Article::find($id);
        $comments = Article::find($id) -> comments -> sortBy('Comment.created_at');
        return view('articles.show') -> with('article', $article) -> with('comments', $comments);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $article = Article::find($id);
        return view('articles.edit') -> with('article', $article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        $validate = Validator::make($request -> all(), Article::valid($id));

        if ($validate -> fails()) {
            return back() -> withErrors($validate) -> withInput();
        } else {
            $article = Article::find($id);
            $article -> update($request -> all());
            Session::flash('notice', 'Success update article');
            return Redirect::to('articles');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        $article = Article::find($id);

        if ($article -> delete()) {
            Session::flash('notice', 'Article success delete');
            return Redirect::to('articles');
        } else {
            Session::flash('error', 'Article fails delete');
            return Redirect::to('articles');
        }
    }

    public function UpdatePic() {
        if (Form::hasFile('image')) {
            $file = Form::file('image');
            $file -> move('/public/upload', $file -> getClientOriginalName());
            echo '<img src="/public/upload/' . $file -> getClientOriginalName() . '" />';
        }
    }

}
