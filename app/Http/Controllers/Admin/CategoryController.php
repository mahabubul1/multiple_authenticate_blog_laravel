<?php

namespace App\Http\Controllers\admin;

use App\Category;
use Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories= Category::with('posts')->latest()->get();
        return view ("admin.category.index",compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ("admin.category.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg'

        ]);

       $image =$request->file('image');
       $slug= str_slug($request->name);

        $currentdata= Carbon::now()->toDateString();


        if(isset($image)){
            $imageName=$slug.'-'.$currentdata.'-'.uniqid().'.'.$image->getClientOriginalExtension();


            if(!Storage::disk('public')->exists('category')){
                 Storage::disk('public')->makeDirectory('category');

            }

             $category= Image::make($image)->resize(1600,479)->stream();
             Storage::disk('public')->put('category/'.$imageName,$category);



             //slider image

             if(!Storage::disk('public')->exists('category/slider')){
                 Storage::disk('public')->makeDirectory('category/slider');
             }


             $categorySlider= Image::make($image)->resize(500,333)->stream();

             Storage::disk('public')->put('category/slider/'.$imageName, $categorySlider);


        }else{
            $imageName="default.png";
        }


        $categories=  new Category();
        $categories->name=$request->name;
        $categories->slug=$slug;
        $categories->image=$imageName;
        $categories->save();
        Toastr::success("Tag update successfully",'success');
        return redirect()->route('admin.category.index');





    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $categoryById= Category::find($id);

       return view('admin.category.edit',compact('categoryById'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $this->validate($request,[

            'name'=>'required',
            'image'=>'required|image|mimes:jpeg,png,jpg'

        ]);

        $category= Category::find($id);

         $image=$request->file("image");
         $slug= str_slug($request->name);

         if(isset($image)){


             $currentdata=Carbon::now()->toDateString();

             $imageName = $slug."-".$currentdata."-".uniqid().".".$image->getClientOriginalExtension();

              if(!Storage::disk('public')->exists('category')){
                  Storage::disk('public')->makeDirectory('category');
              }

              //old image delete

              if(Storage::disk('public')->exists('category/'. $category->image)){
                   Storage::disk('public')->delete('category/'.$category->image);
              }


              $categoryImage= Image::make($image)->resize(1600,479)->stream();

               Storage::disk('public')->put('category/'.$imageName,$categoryImage);



               if(!Storage::disk('public')->exists('category/slider')){
                    Storage::disk('public')->makeDirectory('category/slider');

               }


               if(Storage::disk('public')->exists('category/slider/'.$category->image)){
                   Storage::disk('public')->delete("category/slider/".$category->image);
               }


               $categorySliderImage= Image::make($image)->resize(500,333)->stream();

               Storage::disk("public")->put('category/slider/'. $imageName,$categorySliderImage);


         }else{
             $imageName =$category->image;
         }


         $category->name=$request->name;
         $category->slug=$slug;
         $category->image=$imageName;
         $category->save();

         Toastr::success("Category update successfully",'success');
         return redirect()->route('admin.category.index');




    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category= Category::find($id);

        if(Storage::disk("public")->exists("category/".$category->image)){
             Storage::disk("public")->delete("category/".$category->image);
        }

        if(Storage::disk("public")->exists("category/slider/".$category->image)){
            Storage::disk("public")->delete("category/slider/".$category->image);
        }

        $category->delete();



        Toastr::success("Category Delete successfully",'success');
         return redirect()->route('admin.category.index');
    }
}
