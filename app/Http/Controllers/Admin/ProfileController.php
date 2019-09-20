<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Profile;
use Auth;
//課題17
use App\ProfileHistory;
use Carbon\Carbon;


class ProfileController extends Controller
{
    //
    public function add()
    {
      return view('admin.profile.create');
    }
    public function create(Request $request)
    {
      $this->validate($request, Profile::$rules);
      $profile = new Profile;
      $form = $request->all();
      
      //データベース保存
      $profile->fill($form);
      $profile->user_id = Auth::id();
      $profile->save();
      
      return redirect('admin/profile/create');
    }
    
    public function index(Request $request)
    {
      $cond_name = $request->cond_name;
      if ($cond_name !=''){
        $posts = Profile::where('name',$cond_name)->get();
      }else{
      $posts = Profile::all();
    }
    return view('admin.profile.index',['posts'=>$posts,'cond_name'=>$cond_name]);
    }
    
    
    public function edit(Request $request)
    {
      $profile = Profile::find($request->id);
      if(empty($profile)){
        abort(404);
      }
      return view('admin.profile.edit',['profile_form'=>$profile]);
    }
    public function update(Request $request)
    {
      $this->validate($request,Profile::$rules);
      $profile = Profile::find($request->id);
      $profile_form=$request->all();
      unset($profile_form['_token']);
      $profile->fill($profile_form)->save();
      
      //課題17
      $history = new ProfileHistory;
      $history->profile_id = $profile->id;
      $history->edited_at = Carbon::now();
      $history->save();
      
      return redirect('admin/profile/');
    }
}
