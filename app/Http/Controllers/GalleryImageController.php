<?php

namespace App\Http\Controllers;

use DB;
use File;
use Image;
use App\Models\GalleryImage;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class GalleryImageController extends Controller
{
 

    public function __construct(){
        $this->middleware(['permission:galleryImage']);
    }


    public function index(){
        $galleryImages = GalleryImage::orderBy('order','asc')->get();
        return view('admin.galleryImages.galleryImages',compact('galleryImages'));
    }
    
    
    public function createPluck(){
        $images = DB::table('temp_upload_files')->where('type','gallery_image')->get();
        if(count($images) > 0){
            foreach($images as $image){
                try{
                    $img_path = base_path() . '/uploads/galleryImages/source/';
                    $img_path200 = base_path() . '/uploads/galleryImages/resize200/';
                    $img_path800 = base_path() . '/uploads/galleryImages/resize800/';
                    if($image->server_name){
                        unlink(sprintf($img_path . '%s', $image->server_name));
                        unlink(sprintf($img_path200 . '%s', $image->server_name));
                        unlink(sprintf($img_path800 . '%s', $image->server_name));
                    }
                }catch(Exception $e){
                }
            }
            DB::table('temp_upload_files')->where('type','gallery_image')->delete();
            session()->forget('imagesUpload');
            session()->forget('imagesUploadRealName');
        }
            
            
        return view('admin.galleryImages.addPluckGalleryImages');
    }
    
    public function storePluck(){
        ///////// save gallery images//////
        if(\Session::has('imagesUpload')){
            $images = \Session::get('imagesUpload');
            foreach ($images as $key=>$file) {
                $img = new GalleryImage();
                $img->img = $file;
                $img->status=1;
                $img->save();
            }
        }

        DB::table('temp_upload_files')->where('type','gallery_image')->delete();
        session()->forget('imagesUpload');
        session()->forget('imagesUploadRealName');
        
        $GalleryImageIds = GalleryImage::pluck('id')->toArray();
        foreach ($GalleryImageIds as $index => $id) {
            GalleryImage::where('id', $id)->update(['order' => $index + 1]);
        }
        
        return redirect('admin/gallery-images')->with('success',trans('home.your_items_added_successfully'));
    }


    public function create(){
        return view('admin.galleryImages.addGalleryImage');
    }
    
    
    public function store(Request $request){
        $add = new GalleryImage();
        $add->text_en = $request->text_en;
        $add->text_ar = $request->text_ar;
        $add->order = $request->order;

        if($request->status){
            $add->status = 1;
        }else{
            $add->status = 0;
        }

        if ($request->hasFile("img")) {

            $file = $request->file("img");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/galleryImages/source/' . $fileName);
            $resize200 = base_path('uploads/galleryImages/resize200/' . $fileName);
            $resize800 = base_path('uploads/galleryImages/resize800/' . $fileName);
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

            $add->img = $fileName;
        }
        $add->save();
        return redirect('admin/gallery-images')->with('success',trans('home.your_item_added_successfully'));
    }
    
    public function edit($id){
        $galleryImage=GalleryImage::find($id);
        if($galleryImage){
            return view('admin.galleryImages.editGalleryImage',compact('galleryImage'));
        }else{
            abort('404');
        }
    }
    
    public function update(Request $request,$id){
        $add = GalleryImage::find($id);
        $add->text_en = $request->text_en;
        $add->text_ar = $request->text_ar;
        $add->order = $request->order;

        if($request->status){
            $add->status = 1;
        }else{
            $add->status = 0;
        }
        if ($request->hasFile("img")) {

            $file = $request->file("img");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = base_path() . '/uploads/galleryImages/source/';
            $img_path200 = base_path() . '/uploads/galleryImages/resize200/';
            $img_path800 = base_path() . '/uploads/galleryImages/resize800/';
            if ($add->img != null) {
                unlink(sprintf($img_path . '%s', $add->img));
                unlink(sprintf($img_path200 . '%s', $add->img));
                unlink(sprintf($img_path800 . '%s', $add->img));
            }
           // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/galleryImages/source/' . $fileName);
            $resize200 = base_path('uploads/galleryImages/resize200/' . $fileName);
            $resize800 = base_path('uploads/galleryImages/resize800/' . $fileName);
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

            $add->img = $fileName;
        }
        
        $add->save();
        return redirect('admin/gallery-images')->with('success',trans('home.your_item_updated_successfully'));
    }

    public function reorderImeges(Request $request){
        $request->validate([
            'ids'   => 'required|array',
            'ids.*' => 'integer',
        ]);

        foreach ($request->ids as $index => $id) {
            GalleryImage::where('id', $id)->update(['order' => $index + 1]);
        }
        
        $positions = GalleryImage::pluck('order', 'id');

        return response(compact('positions'), Response::HTTP_OK);

    }
    
    
    /////// upload product images///////////////
    public function uploadImages(Request $request){
        if($request->hasFile('file')){

            $file = $request->file("file");
            $realName = $file->getClientOriginalName();
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111111, 99999999) . '.' . $extension; // renameing image
            
            $path = base_path('uploads/galleryImages/source/' . $fileName);
            $resize200 = base_path('uploads/galleryImages/resize200/' . $fileName);
            $resize800 = base_path('uploads/galleryImages/resize800/' . $fileName);
            
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
            DB::table('temp_upload_files')->insert(['server_name' => $fileName,'original_name' => $realName , 'type'=>'gallery_image']);
            if(\Session::has('imagesUpload')){
                \Session::push('imagesUpload',$fileName);
                \Session::push('imagesUploadRealName',$realName);
            }else{
                $images = [];
                array_push($images,$fileName);
                \Session::put('imagesUpload',$images);
                
                $realImages = [];
                array_push($realImages,$realName);
                \Session::put('imagesUploadRealName',$realImages);
            }
        }
    }
    
    ///////// delete uploaded images///////////
    public function removeUploadImages(Request $request){
        $name = $request->name;
        $names = \Session::get('imagesUploadRealName');
        $images = \Session::get('imagesUpload');
        $key = array_search($name, $names);
        
        $img_path = base_path() . '/uploads/galleryImages/source/';
        $img_path200 = base_path() . '/uploads/galleryImages/resize200/';
        $img_path800 = base_path() . '/uploads/galleryImages/resize800/';

        unlink(sprintf($img_path . '%s', $images[$key]));
        unlink(sprintf($img_path200 . '%s', $images[$key]));
        unlink(sprintf($img_path800 . '%s', $images[$key]));
              
        unset($images[$key]);
        unset($names[$key]);
        \Session::put('imagesUpload',$images);
        \Session::put('imagesUploadRealName',$names);
        DB::table('temp_upload_files')->where('original_name',$name)->delete();
    }
    
    public function destroy($ids){
        $ids = explode(',', $ids);
        if ($ids[0] == 'on') {
            unset($ids[0]);
        }
        foreach ($ids as $id) {
            $m = GalleryImage::findOrFail($id);
            $img_path = base_path() . '/uploads/gallery-images/source/';
            $img_path200 = base_path() . '/uploads/gallery-images/resize200/';
            $img_path800 = base_path() . '/uploads/gallery-images/resize800/';

            if ($m->image != null) {
                unlink(sprintf($img_path . '%s', $m->image));
                unlink(sprintf($img_path200 . '%s', $m->image));
                unlink(sprintf($img_path800 . '%s', $m->image));
            }
            $m->delete();
        }
        
        $GalleryImageIds = GalleryImage::pluck('id')->toArray();
        foreach ($GalleryImageIds as $index => $id) {
            GalleryImage::where('id', $id)->update(['order' => $index + 1]);
        }
    }

}
