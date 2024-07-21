<?php

namespace App\Http\Controllers;

use App\Models\OfferSlider;
use DB;
use File;
use Image;
use Illuminate\Http\Request;

class OfferSliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware(['permission:offersSlider']);
    }

    public function index()
    {
        //
        $sliders = OfferSlider::orderBy('id','DESC')->get();
        return view('admin.sliders.offers-sliders.sliders',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.sliders.offers-sliders.addSlider');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = new OfferSlider();
        $add->title = $request->title;
        $add->text = $request->text;
        $add->link = $request->link;
        $add->order = $request->order;
        $add->lang = $request->lang;
        if($request->status){
            $add->status = 1;
        }else{
            $add->status = 0;
        }

        if ($request->hasFile("image")) {

            $file = $request->file("image");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/sliders/offers-sliders/source/' . $fileName);
            $resize200 = base_path('uploads/sliders/offers-sliders/resize200/' . $fileName);
            $resize800 = base_path('uploads/sliders/offers-sliders/resize800/' . $fileName);
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
        $add->save();
        return redirect('admin/offers-sliders')->with('success',trans('home.your_item_added_successfully'));
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
        $slider=OfferSlider::find($id);
        if($slider){
            return view('admin.sliders.offers-sliders.editSlider',compact('slider'));
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
        $add = OfferSlider::find($id);
        $add->title = $request->title;
        $add->text = $request->text;
        $add->link = $request->link;
        $add->order = $request->order;
        $add->lang = $request->lang;

        if($request->status){
            $add->status = 1;
        }else{
            $add->status = 0;
        }

        if ($request->hasFile("image")) {

            $file = $request->file("image");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = base_path() . '/uploads/sliders/offers-sliders/source/';
            $img_path200 = base_path() . '/uploads/sliders/offers-sliders/resize200/';
            $img_path800 = base_path() . '/uploads/sliders/offers-sliders/resize800/';

            if ($add->image != null) {
                unlink(sprintf($img_path . '%s', $add->image));
                unlink(sprintf($img_path200 . '%s', $add->image));
                unlink(sprintf($img_path800 . '%s', $add->image));
            }

            // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/sliders/offers-sliders/source/' . $fileName);
            $resize200 = base_path('uploads/sliders/offers-sliders/resize200/' . $fileName);
            $resize800 = base_path('uploads/sliders/offers-sliders/resize800/' . $fileName);
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
        $add->save();
        return redirect('/admin/offers-sliders')->with('success',trans('home.your_item_updated_successfully'));
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
        $img_path = base_path() . '/uploads/sliders/offers-sliders/source/';
        $img_path200 = base_path() . '/uploads/sliders/offers-sliders/resize200/';
        $img_path800 = base_path() . '/uploads/sliders/offers-sliders/resize800/'; 
        
        foreach ($ids as $id) {
            $slider = OfferSlider::findOrFail($id);

            if ($slider->image != null) {
                unlink(sprintf($img_path . '%s', $slider->image));
                unlink(sprintf($img_path200 . '%s', $slider->image));
                unlink(sprintf($img_path800 . '%s', $slider->image));
            }

            $slider->delete();
        }
    }  
    
}
