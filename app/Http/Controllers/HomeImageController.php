<?php

namespace App\Http\Controllers;

use App\Models\HomeImage;
use Illuminate\Http\Request;
use File;
use Image;
class HomeImageController extends Controller
{
    
    public function __construct(){
        $this->middleware(['permission:homeImage']);
    }


    public function index()
    {
        $homeImages = HomeImage::get();
        return view('admin.homeImages.homeImages',compact('homeImages'));
    }


    public function update(Request $request, $id)
    {
        $homeImage = HomeImage::find($id);
        $homeImage->link = $request->link;

        if ($request->hasFile("img_en")) {

            $file = $request->file("img_en");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = base_path() . '/uploads/homeImages/source/';
            $img_path200 = base_path() . '/uploads/homeImages/resize200/';
            $img_path800 = base_path() . '/uploads/homeImages/resize800/';

            if ($homeImage->img_en != null) {
                unlink(sprintf($img_path . '%s', $homeImage->img_en));
                unlink(sprintf($img_path200 . '%s', $homeImage->img_en));
                unlink(sprintf($img_path800 . '%s', $homeImage->img_en));
            }

            // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/homeImages/source/' . $fileName);
            $resize200 = base_path('uploads/homeImages/resize200/' . $fileName);
            $resize800 = base_path('uploads/homeImages/resize800/' . $fileName);
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

            $homeImage->img_en = $fileName;
        }

        if ($request->hasFile("img_ar")) {

            $file = $request->file("img_ar");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = base_path() . '/uploads/homeImages/source/';
            $img_path200 = base_path() . '/uploads/homeImages/resize200/';
            $img_path800 = base_path() . '/uploads/homeImages/resize800/';

            if ($homeImage->img_ar != null) {
                unlink(sprintf($img_path . '%s', $homeImage->img_ar));
                unlink(sprintf($img_path200 . '%s', $homeImage->img_ar));
                unlink(sprintf($img_path800 . '%s', $homeImage->img_ar));
            }

            // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/homeImages/source/' . $fileName);
            $resize200 = base_path('uploads/homeImages/resize200/' . $fileName);
            $resize800 = base_path('uploads/homeImages/resize800/' . $fileName);

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

            $homeImage->img_ar = $fileName;
        }
        $homeImage -> save();

        return redirect()->back()->with('success',trans('home.image_updated_successfully'));

    }
    
}
