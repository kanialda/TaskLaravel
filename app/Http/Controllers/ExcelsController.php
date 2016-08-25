<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use Input;
use DB;
use Excel;
use App\Article;
use App\Comment;

class ExcelsController extends Controller {
    public function getImport() {
        return view('excels.import');
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function postImport(Request $request) {
        $getSheetName = Excel::load($request -> file('article')) -> getSheetNames();

        foreach ($getSheetName as $sheetName) {
            if ($sheetName === 'Article') {
                DB::table('articles') -> truncate();
                
                Excel::selectSheets($sheetName) -> load($request -> file('article'), function($reader) {
                    foreach ($reader->toArray() as $sheet) {
                        $reader -> ignoreEmpty();
                        Article::create($sheet);
                    }
                });

            }

            if ($sheetName === 'Comment') {

                // dd('loading meta');

                DB::table('comments') -> truncate();

                Excel::selectSheets($sheetName) -> load($request -> file('article'), function($reader) {
                    foreach ($reader->toArray() as $sheet) {
                        $reader -> ignoreEmpty();
                        
                        Comment::create($sheet);
                    }
                });
            }
        }

        return redirect('/articles');
    }
    
    public function export(){
        
    }

}
