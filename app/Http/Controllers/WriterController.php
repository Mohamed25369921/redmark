<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Writer;
use App\Models\BlogItem;
use DB;
use File;
use Image;
class WriterController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('permission:setting');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $writers =Writer::get();
        return view('admin.writers.writers',compact('writers'));
    }
        public function create()
    {
        //
        return view('admin.writers.addWriter');
    }
    public function store(Request $request){
        $request->validate([
          'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp'
        ]);
        $writer = new Writer();
        $writer->name = $request->name;
        $writer->email = $request->email;
        $writer->phone = $request->phone;
        $writer->position = $request->position;
        $writer->aboutWriter = $request->aboutWriter;
        $writer->facebook = $request->facebook;
        $writer->linkedin = $request->linkedin;
        $writer->instgram = $request->instgram;
        $writer->twitter = $request->twitter;
        $writer->status = $request->status;
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

            $writer->image = $fileName;
        }
        $writer->save();
        return redirect('admin/writers')->with('success',trans('home.writers_added_successfully'));

    }
    public function edit($id){
        $writer = Writer::find($id);
        if($writer){
            return view('admin.writers.editWriter',compact('writer'));
        }
        else{
            abort('404');
        }
    }
    public function update(Request $request, $id){
        $request->validate([
          'image' => 'image|mimes:jpeg,png,jpg,gif,svg,webp'
        ]);
        $writer = Writer::find($id);
        $writer->name = $request->name;
        $writer->email = $request->email;
        $writer->phone = $request->phone;
        $writer->position = $request->position;
        $writer->aboutWriter = $request->aboutWriter;
        $writer->facebook = $request->facebook;
        $writer->linkedin = $request->linkedin;
        $writer->instgram = $request->instgram;
        $writer->twitter = $request->twitter;
        $writer->status = $request->status;
        if ($request->hasFile("image")) {

            $file = $request->file("image");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = base_path() . '/uploads/aboutStrucs/source/';
            $img_path200 = base_path() . '/uploads/aboutStrucs/resize200/';
            $img_path800 = base_path() . '/uploads/aboutStrucs/resize800/';
            if ($writer->image != null) {
                unlink(sprintf($img_path . '%s', $writer->image));
                unlink(sprintf($img_path200 . '%s', $writer->image));
                unlink(sprintf($img_path800 . '%s', $writer->image));
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

            $writer->image = $fileName;
        }
        $writer->save();
        return redirect('admin/writers')->with('success',trans('home.writers_updated_successfully'));
    }
    public function show(){
        //
    }

    public function destroy($ids)
    {
        //
        $ids = explode(',', $ids);
        if ($ids[0] == 'on') {
            unset($ids[0]);
        }
        foreach ($ids as $id) {
            $m = Writer::findOrFail($id);
            $m->delete();
        }
    }

    


}
