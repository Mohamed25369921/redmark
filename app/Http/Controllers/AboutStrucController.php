<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AboutStruc;
use DB;
use File;
use Image;

class AboutStrucController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('permission:aboutStruc');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $aboutStrucs = AboutStruc::orderBy('id','DESC')->get();
        return view('admin.aboutStrucs.aboutStrucs',compact('aboutStrucs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.aboutStrucs.addAboutStruc');
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
        //dd($request->all());
        $add = new AboutStruc();
        $add->title = $request->title;
        $add->text = $request->text;
        $add->lang = $request->lang;
        $add->status = $request->status;
        $add->alt_img = $request->alt_img;

        if ($request->hasFile("image")) {

            $file = $request->file("image");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

           // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/aboutStrucs/source/' . $fileName);
            $resize200 = base_path('uploads/aboutStrucs/resize200/' . $fileName);
            $resize800 = base_path('uploads/aboutStrucs/resize800/' . $fileName);
              //  $file->move($destinationPath, $fileName);

            Image::make($file->getRealPath())->save($path);

            $arrayimage = getimagesize($file->getRealPath());
            $widthreal = $arrayimage[0];
            $heightreal = $arrayimage[1];
            $width200 = ($widthreal / $heightreal) * 200;
            $height200 = $width200 / ($widthreal / $heightreal);
            if($widthreal > 200 && $heightreal > 200){
                $img200 = Image::canvas($width200, $height200);
                $image200 = Image::make($file->getRealPath())->resize($width200, $height200, function ($c) {
                    $c->aspectRatio();
                    $c->upsize();
                });
                $img200->insert($image200, 'center');
                $img200->save($resize200);
            }
            else{
               Image::make($file->getRealPath())->save($resize200);
            }
            $width800 = ($widthreal / $heightreal) * 800;
            $height800 = $width800 / ($widthreal / $heightreal);
            if($widthreal > 800 && $heightreal > 800){
                $img800 = Image::canvas($width800, $height800);
                $image800 = Image::make($file->getRealPath())->resize($width800, $height800, function ($c) {
                    $c->aspectRatio();
                    $c->upsize();
                });
                $img800->insert($image800, 'center');
                $img800->save($resize800);
            }
            else{
               Image::make($file->getRealPath())->save($resize800);
            }
            $add->image = $fileName;
        }
        $add->save();
        return redirect()->route('aboutStrucs.index',app()->getLocale())->with('success',trans('home.your_item_updated_successfully'));
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
        $aboutStruc = AboutStruc::find($id);
        if($aboutStruc){
            return view('admin.aboutStrucs.editAboutStruc',compact('aboutStruc'));
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
        $add = AboutStruc::find($id);
        $add->title = $request->title;
        $add->text = $request->text;
        $add->lang = $request->lang;
        $add->status = $request->status;
        $add->alt_img = $request->alt_img;
        if ($request->hasFile("image")) {

            $file = $request->file("image");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = base_path() . '/uploads/aboutStrucs/source/';
            $img_path200 = base_path() . '/uploads/aboutStrucs/resize200/';
            $img_path800 = base_path() . '/uploads/aboutStrucs/resize800/';
            if ($add->image != null) {
                unlink(sprintf($img_path . '%s', $add->image));
                unlink(sprintf($img_path200 . '%s', $add->image));
                unlink(sprintf($img_path800 . '%s', $add->image));
            }
           // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/aboutStrucs/source/' . $fileName);
            $resize200 = base_path('uploads/aboutStrucs/resize200/' . $fileName);
            $resize800 = base_path('uploads/aboutStrucs/resize800/' . $fileName);
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
        return redirect()->route('aboutStrucs.index',app()->getLocale())->with('success',trans('home.your_item_updated_successfully'));
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

        $img_path = base_path() . '/uploads/aboutStrucs/source/';
        $img_path200 = base_path() . '/uploads/aboutStrucs/resize200/';
        $img_path800 = base_path() . '/uploads/aboutStrucs/resize800/';
        foreach ($ids as $id) {
            $aboutStruc = AboutStruc::findOrFail($id);
            if ($aboutStruc->image != null) {
                unlink(sprintf($img_path . '%s', $aboutStruc->image));
                unlink(sprintf($img_path200 . '%s', $aboutStruc->image));
                unlink(sprintf($img_path800 . '%s', $aboutStruc->image));
            }
            $aboutStruc->delete();
        }
    }
}
