<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class settingController extends Controller
{
    public  function  index (){
         $profile= User::where("role_id", Auth::id())->first();

          $userprofile= (object) $profile;

        return view('admin.post.setting',compact('userprofile'));
    }


    public function  updateProfile(Request $request){


        $this->validate($request,[
            'username'=>'required',
            "email"=>"required",
            'image' =>"required|image|mimes:jpg,png,jpeg"
        ]);

         $user= User::findOrfail(Auth::id());

        $image= $request->file('image');
        $slug= str_slug($request->username);

        if(isset($image))
        {
            $currentDate= Carbon::now()->toDateString();
            $imageName= $slug."-".$currentDate."-".uniqid().'.'.$image->getClientOriginalExtension();
            if(!Storage::disk('public')->exists('user')){

                Storage::disk('public')->makeDirectory('user');

            }
            if(Storage::disk('public')->exists('user/'.$user->image)){

                Storage::disk('public')->delete('user/'.$user->image);

            }

            $progileImage= Image::make($image)->resize(500,500)->stream();

            Storage::disk('public')->put('user/'.$imageName,$progileImage);
        }else{
            $imageName=$user->image;
        }

        $user->username=$request->username;
        $user->email =$request->username;
        $user->email =$request->email;
        $user->image =$imageName;
        $user->about =$request->about;
        $user->save();
        Toastr::success("Profile setting update successfully","Success");
         return redirect()->back();

    }



    public function  updatePassword(Request $request){
           $this->validate($request,[
                 "OldPassword"=>"required",
                 "password" =>"required:Confirm|min:6",

               ]);
           $hasspassword = Auth::user()->password;



           if(Hash::check($request->OldPassword,$hasspassword)){

               if(!Hash::check($request->password,$hasspassword)){
                   $user=  User::find(Auth::id());
                    $user->password = Hash::make($request->password);
                    $user->save();
                     Toastr::success(" Password update successfully",'Success');
                     Auth::logout();
                     return  redirect()->back();


               }else{
                    Toastr::info('New password  and Old password are not same');
                    return  redirect()->back();

               }

           }else{
                Toastr::info(" Do't Match passord ",'Error');

                return redirect()->back();
           }


    }


}
