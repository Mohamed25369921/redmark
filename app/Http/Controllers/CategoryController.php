<?php

namespace App\Http\Controllers;

use App\Models\Category;
use DB;
use File;
use Image;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware(['permission:categories']);
    }

    public function index()
    {
        //
        $categories = Category::orderBy('id','DESC')->get();
        return view('admin.categories.categories',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories=Category::where('status',1)->get();
        return view('admin.categories.addCategory',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $add = new Category();
        $add->name_en = $request->name_en;
        $add->name_ar = $request->name_ar;
        $add->desc_en = $request->desc_en;
        $add->desc_ar = $request->desc_ar;
        $link_en = str_replace(" ","-",$add->name_en);
        $add->link_en = str_replace(" ","-",$link_en);  
        $link_ar = str_replace(" ","-",$add->name_ar);
        $add->link_ar = str_replace(" ","-",$link_ar); 
        $add->meta_title_en = $request->meta_title_en;
        $add->meta_desc_en = $request->meta_desc_en;
        $add->meta_title_ar = $request->meta_title_ar;
        $add->meta_desc_ar = $request->meta_desc_ar;
        $add->meta_robots = $request->meta_robots ; 

        if($request->status){
            $add->status = 1;
        }else{
            $add->status = 0;
        }

        if($request->menu){
            $add->menu = 1;
        }else{
            $add->menu = 0;
        }

        if($request->home){
            $add->home = 1;
        }else{
            $add->home = 0;
        }

        if($request->parent_id !=0){
            $add->parent_id = $request->parent_id;
            $category=Category::find($request->parent_id);
            $category->has_sub =1;
            $category->save();
            $add->has_sub =0;
        }else{
            $add->parent_id = 0;
            $add->has_sub =0;
        }

        if ($request->hasFile("image")) {

            $file = $request->file("image");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/categories/source/' . $fileName);
            $resize200 = base_path('uploads/categories/resize200/' . $fileName);
            $resize800 = base_path('uploads/categories/resize800/' . $fileName);
            //  $file->move($destinationPath, $fileName);

            Image::make($file->getRealPath())->save($path);

            $arrayimage = list($width, $height) = getimagesize($file->getRealPath());
            $widthreal = $arrayimage['0'];
            $heightreal = $arrayimage['1'];

            $width200 = ($widthreal / $heightreal) * 150;
            $height200 = $width200 / ($widthreal / $heightreal);

            $img200 = Image::canvas($width200, $height200);
            $image200 = Image::make($file->getRealPath())->resize($width200, $height200, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $img200->insert($image200, 'center');
            $img200->save($resize200);

            $width800 = ($widthreal / $heightreal) * 800;
            $height800 = $width800 / ($widthreal / $heightreal);

            $img800 = Image::canvas($width800, $height800);
            $image800 = Image::make($file->getRealPath())->resize($width800, $height800, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $img800->insert($image800, 'center');
            $img800->save($resize800);

            $add->image = $fileName;
        }
        
        if ($request->hasFile("banner")) {

            $file = $request->file("banner");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/categories/source/' . $fileName);
            $resize200 = base_path('uploads/categories/resize200/' . $fileName);
            $resize800 = base_path('uploads/categories/resize800/' . $fileName);
            //  $file->move($destinationPath, $fileName);

            Image::make($file->getRealPath())->save($path);

            $arrayimage = list($width, $height) = getimagesize($file->getRealPath());
            $widthreal = $arrayimage['0'];
            $heightreal = $arrayimage['1'];

            $width200 = ($widthreal / $heightreal) * 150;
            $height200 = $width200 / ($widthreal / $heightreal);

            $img200 = Image::canvas($width200, $height200);
            $image200 = Image::make($file->getRealPath())->resize($width200, $height200, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $img200->insert($image200, 'center');
            $img200->save($resize200);

            $width800 = ($widthreal / $heightreal) * 800;
            $height800 = $width800 / ($widthreal / $heightreal);

            $img800 = Image::canvas($width800, $height800);
            $image800 = Image::make($file->getRealPath())->resize($width800, $height800, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $img800->insert($image800, 'center');
            $img800->save($resize800);

            $add->banner = $fileName;
        }
        $add->save();
        return redirect('admin/categories')->with('success',trans('home.your_item_added_successfully'));
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
        //
        $category=Category::find($id);
        if($category){
            $categories=Category::where('id','!=',$id)->where('status',1)->get();
            return view('admin.categories.editCategory',compact('categories','category'));
        }else{
            abort('404');
        }
        
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
        //
        $add = Category::find($id);
        $add->name_en = $request->name_en;
        $add->name_ar = $request->name_ar;
        $add->desc_en = $request->desc_en;
        $add->desc_ar = $request->desc_ar;

        $link_en = str_replace(" ","-",$add->name_en);
        $add->link_en = str_replace(" ","-",$link_en);  
        $link_ar = str_replace(" ","-",$add->name_ar);
        $add->link_ar = str_replace(" ","-",$link_ar); 
        
        $add->meta_title_en = $request->meta_title_en;
        $add->meta_desc_en = $request->meta_desc_en;
        $add->meta_title_ar = $request->meta_title_ar;
        $add->meta_desc_ar = $request->meta_desc_ar;
        $add->meta_robots = $request->meta_robots ; 

        if($request->status){
            $add->status = 1;
        }else{
            $add->status = 0;
        }

        if($request->menu){
            $add->menu = 1;
        }else{
            $add->menu = 0;
        }

        if($request->home){
            $add->home = 1;
        }else{
            $add->home = 0;
        }

        if($request->parent_id !=0){
            $add->parent_id = $request->parent_id;
            $category=Category::find($request->parent_id);
            $category->has_sub =1;
            $category->save();
            $add->has_sub =0;
        }else{
            $add->parent_id = 0;
        }

        if ($request->hasFile("image")) {

            $file = $request->file("image");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = base_path() . '/uploads/categories/source/';
            $img_path200 = base_path() . '/uploads/categories/resize200/';
            $img_path800 = base_path() . '/uploads/categories/resize800/';

            if ($add->image != null) {
                unlink(sprintf($img_path . '%s', $add->image));
                unlink(sprintf($img_path200 . '%s', $add->image));
                unlink(sprintf($img_path800 . '%s', $add->image));
            }

            // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/categories/source/' . $fileName);
            $resize200 = base_path('uploads/categories/resize200/' . $fileName);
            $resize800 = base_path('uploads/categories/resize800/' . $fileName);
            //  $file->move($destinationPath, $fileName);

            $img =Image::make($file->getRealPath());
            $img->save($path);

            $arrayimage = list($width, $height) = getimagesize($file->getRealPath());
            $widthreal = $arrayimage['0'];
            $heightreal = $arrayimage['1'];

            $width200 = ($widthreal / $heightreal) * 150;
            $height200 = $width200 / ($widthreal / $heightreal);

            $img200 = Image::canvas($width200, $height200);
            $image200 = Image::make($file->getRealPath())->resize($width200, $height200, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $img200->insert($image200, 'center');
            $img200->save($resize200);

            $width800 = ($widthreal / $heightreal) * 800;
            $height800 = $width800 / ($widthreal / $heightreal);

            $img800 = Image::canvas($width800, $height800);
            $image800 = Image::make($file->getRealPath())->resize($width800, $height800, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $img800->insert($image800, 'center');
            $img800->save($resize800);

            $add->image = $fileName;
        }


        if ($request->hasFile("banner")) {

            $file = $request->file("banner");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = base_path() . '/uploads/categories/source/';
            $img_path200 = base_path() . '/uploads/categories/resize200/';
            $img_path800 = base_path() . '/uploads/categories/resize800/';

            if ($add->banner != null) {
                unlink(sprintf($img_path . '%s', $add->banner));
                unlink(sprintf($img_path200 . '%s', $add->banner));
                unlink(sprintf($img_path800 . '%s', $add->banner));
            }

            // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/categories/source/' . $fileName);
            $resize200 = base_path('uploads/categories/resize200/' . $fileName);
            $resize800 = base_path('uploads/categories/resize800/' . $fileName);
            //  $file->move($destinationPath, $fileName);

            $img =Image::make($file->getRealPath());
            $img->save($path);

            $arrayimage = list($width, $height) = getimagesize($file->getRealPath());
            $widthreal = $arrayimage['0'];
            $heightreal = $arrayimage['1'];

            $width200 = ($widthreal / $heightreal) * 150;
            $height200 = $width200 / ($widthreal / $heightreal);

            $img200 = Image::canvas($width200, $height200);
            $image200 = Image::make($file->getRealPath())->resize($width200, $height200, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $img200->insert($image200, 'center');
            $img200->save($resize200);

            $width800 = ($widthreal / $heightreal) * 800;
            $height800 = $width800 / ($widthreal / $heightreal);

            $img800 = Image::canvas($width800, $height800);
            $image800 = Image::make($file->getRealPath())->resize($width800, $height800, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $img800->insert($image800, 'center');
            $img800->save($resize800);

            $add->banner = $fileName;
        }
        
        $add->save();


        return redirect('/admin/categories')->with('success',trans('home.your_item_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ids)
    {
        //
        $ids = explode(',', $ids);
        if ($ids[0] == 'on') {
            unset($ids[0]);
        }
        $img_path = base_path() . '/uploads/category/source/';
        $img_path200 = base_path() . '/uploads/category/resize200/';
        $img_path800 = base_path() . '/uploads/category/resize800/'; 
         
        
        foreach ($ids as $id) {
            $category = Category::findOrFail($id);

            if ($category->img != null) {
                unlink(sprintf($img_path . '%s', $category->img));
                unlink(sprintf($img_path200 . '%s', $category->img));
                unlink(sprintf($img_path800 . '%s', $category->img));
            }

            $category->delete();
        }
    }  
    
}
