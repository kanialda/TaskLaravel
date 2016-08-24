<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

 class Article extends \Eloquent
 {
    protected $fillable = ['title', 'content', 'author', 'image'];
    
    public function comments() {
    return $this -> hasMany('App\Comment', 'article_id');
    }
    
    public static function valid($id='') {
      return array(
        'title' => 'required|min:5|unique:articles,title'.($id ? ",$id" : ''),
        'image' => 'required',
        'content' => 'required|min:10|unique:articles,content'.($id ? ",$id" : ''),
        'author' => 'required'
      );
    }

 }
  
  
