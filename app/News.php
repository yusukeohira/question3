<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class News extends Model
{
    //追記！バリデーション
    protected $guarded = array('id');
    public static $rules = array(
      'title'=>'required',
      'body'=>'required',
      );
      
    public function user() {
      return $this->belongsTo(User::class);
    }
}
