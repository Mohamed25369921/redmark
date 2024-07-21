<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use DB;
use File;
use Image;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware(['permission:brands']);
    }

    public function index()
    {
        //
        $brands = Brand::orderBy('id','DESC')->get();
        return view('admin.brands.brands',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.brands.addBrand');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = new Brand();
        $add->name_en = $request->name_en;
        $add->name_ar = $request->name_ar;

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

        if ($request->hasFile("logo")) {

            $file = $request->file("logo");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/brands/source/' . $fileName);
            $resize200 = base_path('uploads/brands/resize200/' . $fileName);
            $resize800 = base_path('uploads/brands/resize800/' . $fileName);
            $resize800 = base_path('uploads/brands/resize800/' . $fileName);
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

            $add->logo = $fileName;
        }
        $add->save();
        return redirect('admin/brands')->with('success',trans('home.your_item_added_successfully'));
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
        $brand=Brand::find($id);
        if($brand){
            return view('admin.brands.editBrand',compact('brand'));
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
        $add = Brand::find($id);
        $add->name_en = $request->name_en;
        $add->name_ar = $request->name_ar;

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

        if ($request->hasFile("logo")) {

            $file = $request->file("logo");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = base_path() . '/uploads/brands/source/';
            $img_path200 = base_path() . '/uploads/brands/resize200/';
            $img_path800 = base_path() . '/uploads/brands/resize800/';

            if ($add->logo != null) {
                unlink(sprintf($img_path . '%s', $add->logo));
                unlink(sprintf($img_path200 . '%s', $add->logo));
                unlink(sprintf($img_path800 . '%s', $add->logo));
            }

            // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/brands/source/' . $fileName);
            $resize200 = base_path('uploads/brands/resize200/' . $fileName);
            $resize800 = base_path('uploads/brands/resize800/' . $fileName);
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

            $add->logo = $fileName;
        }
        $add->save();
        return redirect('/admin/brands')->with('success',trans('home.your_item_updated_successfully'));
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
        $img_path = base_path() . '/uploads/brand/source/';
        $img_path200 = base_path() . '/uploads/brand/resize200/';
        $img_path800 = base_path() . '/uploads/brand/resize800/'; 
        
        foreach ($ids as $id) {
            $brand = Brand::findOrFail($id);

            if ($brand->logo != null) {
                unlink(sprintf($img_path . '%s', $brand->logo));
                unlink(sprintf($img_path200 . '%s', $brand->logo));
                unlink(sprintf($img_path800 . '%s', $brand->logo));
            }

            $brand->delete();
        }
    }  
    
}
