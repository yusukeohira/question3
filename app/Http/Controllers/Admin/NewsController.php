<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\News;

class NewsController extends Controller
{
    //
    public function add()
    {
      return view('admin.news.create');
    }
    public function create(Request $request)
    {
      //varidationを行う！
      $this->validate($request,News::$rules);
      $news = new News;
      $form = $request->all();
      
      // フォームから画像が送信されてきたら、保存して、$news->image_path に画像のパスを保存する
      if(isset($form['image'])){
        $path = $request->file('image')->store('public/image');
        $news->image_path=basename($path);
      }else{
        $news->image_path=null;
      }
      //フォームから送信されてきたtokenを削除する。
      unset($form['_token']);
      unset($form['image']);
      
      //データベースの保存
      $news->fill($form);
      $news->save();
      
      return redirect('admin/news/create');
    }
}
