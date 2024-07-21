<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Http\Requests;
use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\CategoryAttribute;
use DB;
use File;
use Image;


class AttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $attributes = Attribute::get();
        return view('admin.attributes.attributes',compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $categories = Category::where('status',1)->get();
        return view('admin.attributes.addAttribute',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add=new Attribute();
        $add->name_en=$request->name_en;
        $add->name_ar=$request->name_ar;
        if($request->status){
            $add->status=1;
        }else{
            $add->status=0;
        }

        if ($request->hasFile("icon")) {

            $file = $request->file("icon");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/attributes/source/' . $fileName);
            $resize200 = base_path('uploads/attributes/resize200/' . $fileName);
            $resize800 = base_path('uploads/attributes/resize800/' . $fileName);
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

            $add->icon = $fileName;
        }
        $add->save();

        ////////// add attribute categories////////////
        if($request->category_id){
            $categoryIds=$request->category_id;
            foreach ($categoryIds as $categoryId){
                $attCategory=new CategoryAttribute();
                $attCategory->category_id=$categoryId;
                $attCategory->attribute_id=$add->id;
                $attCategory->save();
            }
        }

        //////////// add attribute values/////////////
        if($request->value_en  && $request->value_ar){
            $valuesInEnglish=$request->value_en;
            $valuesInArabic =$request->value_ar; 
            foreach($valuesInEnglish as $key=>$value){
                if($value && $valuesInArabic[$key]){
                    $attVal=new AttributeValue();
                    $attVal->attribute_id=$add->id;
                    $attVal->value_en=$value;
                    $attVal->value_ar=$valuesInArabic[$key];
                    $attVal->save();
                }
            }
        }
        
        return redirect()->route('attributes.index')->with('success',trans('home.your_item_added_successfully'));
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
        $categories=Category::where('status',1)->get();
        $attribute=Attribute::find($id);
        $values=AttributeValue::where('attribute_id',$id)->get();
        $categories_ids = CategoryAttribute::where('attribute_id', $attribute->id)->pluck('category_id');
        return view('admin.attributes.editAttribute',compact('categories','attribute','values','categories_ids'));
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
        $add=Attribute::find($id);
        $add->name_en=$request->name_en;
        $add->name_ar=$request->name_ar;
        if($request->status){
            $add->status=1;
        }else{
            $add->status=0;
        }

        if ($request->hasFile("icon")) {

            $file = $request->file("icon");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = base_path() . '/uploads/attributes/source/';
            $img_path200 = base_path() . '/uploads/attributes/resize200/';
            $img_path800 = base_path() . '/uploads/attributes/resize800/';
            if ($add->icon != null) {
                unlink(sprintf($img_path . '%s', $add->icon));
                unlink(sprintf($img_path200 . '%s', $add->icon));
                unlink(sprintf($img_path800 . '%s', $add->icon));
            }

            // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/attribute/source/' . $fileName);
            $resize200 = base_path('uploads/attribute/resize200/' . $fileName);
            $resize800 = base_path('uploads/attribute/resize800/' . $fileName);
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

            $add->icon = $fileName;
        }
        $add->save();

        ////////// add attribute categories////////////
        if($request->category_id){
            CategoryAttribute::where('attribute_id',$add->id)->delete();
            $categoryIds=$request->category_id;
            foreach ($categoryIds as $categoryId){
                $check = CategoryAttribute::where('category_id',$categoryId)->where('attribute_id',$add->id)->first();
                if(!$check){
                    $attCategory=new CategoryAttribute();
                    $attCategory->category_id=$categoryId;
                    $attCategory->attribute_id=$add->id;
                    $attCategory->save();
                }
            }
        }

        //////////// add attribute values/////////////
        if($request->value_en  && $request->value_ar){
            $valuesInEnglish=$request->value_en;
            $valuesInArabic =$request->value_ar; 
            foreach($valuesInEnglish as $key=>$value){
                if($value && $valuesInArabic[$key]){
                    $attVal=new AttributeValue();
                    $attVal->attribute_id=$add->id;
                    $attVal->value_en=$value;
                    $attVal->value_ar=$valuesInArabic[$key];
                    $attVal->save();
                }
            }
        }
        
        return redirect()->route('attributes.index')->with('success',trans('home.your_item_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($ids)
    {
        $ids = explode(',', $ids);
        if ($ids[0] == 'on') {
            unset($ids[0]);
        }
        $img_path = base_path() . '/uploads/attributes/source/';
        $img_path200 = base_path() . '/uploads/attributes/resize200/';
        $img_path800 = base_path() . '/uploads/attributes/resize800/';
        foreach ($ids as $id) {
            $attribute = Attribute::findOrFail($id);
            if ($attribute->icon != null) {
                unlink(sprintf($img_path . '%s', $attribute->icon));
                unlink(sprintf($img_path200 . '%s', $attribute->icon));
                unlink(sprintf($img_path800 . '%s', $attribute->icon));
            }
            $attribute->delete();
        }
    }

    
    public function updateAttributeValue(Request $request){
        $attributeValue=AttributeValue::find($request->value_id);
        $attributeValue->value_en = $request->value_en;
        $attributeValue->value_ar = $request->value_ar;
        $attributeValue->save();
        return back()->with('success',trans('home.your_attribute_value_updated_successfully'));

    }
    
    public function removeAttributeValue(){
        $valId = $_POST['value_id'];
        AttributeValue::find($valId)->delete();
    }
}
