<?php

namespace App\Http\Controllers;

use App\Models\Service;
use File;
use Image;
use Auth;
use App\Models\ServiceImage;
use DB;
use Illuminate\Http\Request;
use App\Models\Faq;
class ServiceController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:service');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $services = Service::all();
        return view('admin.services.services',compact('services'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $services = Service::get();
        return view('admin.services.addService',compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $add = new Service();
        $add->name_en = $request->name_en;
        $add->name_ar = $request->name_ar;
        $add->order = $request->order;
        $add->link_en = str_replace(" ","-",$request->link_en);
        $add->link_ar = str_replace(" ","-",$request->link_ar);
        $add->text_en = $request->text_en;
        $add->text_ar = $request->text_ar;
        $add->alt_img = $request->alt_img;
        $add->youtube_link = $request->youtube_link ? $this->getYoutubeEmbedUrl($request->youtube_link) : '';
        $add->meta_title_en = $request->meta_title_en;
        $add->meta_title_ar = $request->meta_title_ar;
        $add->meta_desc_en =$request->meta_desc_en;
        $add->meta_desc_ar =$request->meta_desc_ar;
        $add->meta_robots =$request->meta_robots;
        $add->status = $request->status;
        $add->home = $request->home;
        $add->menu = $request->menu;
        $add->parent_id = $request->parent_id;

        if ($request->hasFile("img")) {

            $file = $request->file("img");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/services/source/' . $fileName);
            $resize200 = base_path('uploads/services/resize200/' . $fileName);
            $resize800 = base_path('uploads/services/resize800/' . $fileName);
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

        if ($request->hasFile("icon")) {

            $file = $request->file("icon");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/services/source/' . $fileName);
            $resize200 = base_path('uploads/services/resize200/' . $fileName);
            $resize800 = base_path('uploads/services/resize800/' . $fileName);
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
        
        
        //////////// add faqs/////////////
        $questions=$request->question;
        $answers =$request->answer; 
        $statuses =$request->faq_status; 
        if (is_array($questions) || is_object($questions)){
            foreach($questions as $key=>$question){
                if($question){
                    $faq=new Faq();
                    $faq->service_id=$add->id;
                    $faq->type='service';
                    $faq->question=$question;
                    $faq->answer=$answers[$key];
                    $faq->status=$statuses[$key];
                    $faq->save();
                }
            }
        }

        return redirect('admin/services')->with('success',trans('home.your_item_added_successfully'));
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
        $service=Service::find($id);
        if($service){
            $questions = Faq::where('type','service')->where('service_id',$id)->get();
            $services = Service::get();

            $images = DB::table('temp_upload_files')->where('type','service')->where('service_id',$id)->get();
            if(count($images) > 0){
                foreach($images as $image){
                    try{
                        $img_path = base_path() . '/uploads/services/source/';
                        $img_path200 = base_path() . '/uploads/services/resize200/';
                        $img_path800 = base_path() . '/uploads/services/resize800/';
                        if($image->server_name){
                            unlink(sprintf($img_path . '%s', $image->server_name));
                            unlink(sprintf($img_path200 . '%s', $image->server_name));
                            unlink(sprintf($img_path800 . '%s', $image->server_name));
                        }
                    }catch(Exception $e){
                    }
                }
                DB::table('temp_upload_files')->where('type','service')->where('service_id',$id)->delete();
                session()->forget('imagesUpload');
                session()->forget('imagesUploadRealName');
            }
            
            return view('admin.services.editService',compact('services','service','questions'));
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
        $add = Service::find($id);
        $add->name_en = $request->name_en;
        $add->name_ar = $request->name_ar;
        $add->order = $request->order;
        $add->link_en = str_replace(" ","-",$request->link_en);
        $add->link_ar = str_replace(" ","-",$request->link_ar);
        $add->text_en = $request->text_en;
        $add->text_ar = $request->text_ar;
        $add->alt_img = $request->alt_img;
        $add->youtube_link = $request->youtube_link ? $this->getYoutubeEmbedUrl($request->youtube_link) : '';
        $add->meta_title_en = $request->meta_title_en;
        $add->meta_title_ar = $request->meta_title_ar;
        $add->meta_desc_en =$request->meta_desc_en;
        $add->meta_desc_ar =$request->meta_desc_ar;
        $add->meta_robots =$request->meta_robots;
        $add->status = $request->status;
        $add->home = $request->home;
        $add->menu = $request->menu;
        $add->parent_id = $request->parent_id;

        if ($request->hasFile("img")) {

            $file = $request->file("img");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = base_path() . '/uploads/services/source/';
            $img_path200 = base_path() . '/uploads/services/resize200/';
            $img_path800 = base_path() . '/uploads/services/resize800/';

            if ($add->img != null) {
                unlink(sprintf($img_path . '%s', $add->img));
                unlink(sprintf($img_path200 . '%s', $add->img));
                unlink(sprintf($img_path800 . '%s', $add->img));
            }

            // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/services/source/' . $fileName);
            $resize200 = base_path('uploads/services/resize200/' . $fileName);
            $resize800 = base_path('uploads/services/resize800/' . $fileName);
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

        if ($request->hasFile("icon")) {

            $file = $request->file("icon");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = base_path() . '/uploads/services/source/';
            $img_path200 = base_path() . '/uploads/services/resize200/';
            $img_path800 = base_path() . '/uploads/services/resize800/';

            if ($add->icon != null) {
                unlink(sprintf($img_path . '%s', $add->icon));
                unlink(sprintf($img_path200 . '%s', $add->icon));
                unlink(sprintf($img_path800 . '%s', $add->icon));
            }

            // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/services/source/' . $fileName);
            $resize200 = base_path('uploads/services/resize200/' . $fileName);
            $resize800 = base_path('uploads/services/resize800/' . $fileName);
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
        
        
        //////////// add faqs/////////////
        $questions=$request->question;
        $answers =$request->answer;
        $statuses =$request->faq_status; 
        if($questions){
            foreach($questions as $key=>$question){
                if($question){
                    $faq=new Faq();
                    $faq->service_id=$add->id;
                    $faq->type='service';
                    $faq->question=$question;
                    $faq->answer=$answers[$key];
                    $faq->status=$statuses[$key];
                    $faq->save();
                }
            }
        }
        
        ///////// save project images//////
        if(\Session::has('imagesUpload')){
            $images = \Session::get('imagesUpload');
            foreach ($images as $key=>$file) {
                $img = new ServiceImage();
                $img->image = $file;
                $img->service_id=$add->id;
                $img->save();
            }
        }

        DB::table('temp_upload_files')->where('service_id',$id)->delete();
        session()->forget('imagesUpload');
        session()->forget('imagesUploadRealName');
        return redirect('admin/services')->with('success',trans('home.your_item_added_successfully'));
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
        foreach ($ids as $id) {
            $service = Service::findOrFail($id);
            $img_path = base_path() . '/uploads/services/source/';
            $img_path200 = base_path() . '/uploads/services/resize200/';
            $img_path800 = base_path() . '/uploads/services/resize800/';

            if ($service->img != null) {
                unlink(sprintf($img_path . '%s', $service->img));
                unlink(sprintf($img_path200 . '%s', $service->img));
                unlink(sprintf($img_path800 . '%s', $service->img));
            }

            if ($service->icon != null) {
                unlink(sprintf($img_path . '%s', $service->icon));
                unlink(sprintf($img_path200 . '%s', $service->icon));
                unlink(sprintf($img_path800 . '%s', $service->icon));
            }

            $service->delete();
        }
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
            
            $path = base_path('uploads/services/source/' . $fileName);
            $resize200 = base_path('uploads/services/resize200/' . $fileName);
            $resize800 = base_path('uploads/services/resize800/' . $fileName);
            
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
            DB::table('temp_upload_files')->insert(['server_name' => $fileName,'original_name' => $realName ,'service_id' => $request->serviceId, 'type'=>'service']);
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
    public function removeUploadImages(Request $request)
    {
        $name = $request->name;
        $names = \Session::get('imagesUploadRealName');
        $images = \Session::get('imagesUpload');
        $key = array_search($name, $names);
        
        $img_path = base_path() . '/uploads/services/source/';
        $img_path200 = base_path() . '/uploads/services/resize200/';
        $img_path800 = base_path() . '/uploads/services/resize800/';

        unlink(sprintf($img_path . '%s', $images[$key]));
        unlink(sprintf($img_path200 . '%s', $images[$key]));
        unlink(sprintf($img_path800 . '%s', $images[$key]));
              
        unset($images[$key]);
        unset($names[$key]);
        \Session::put('imagesUpload',$images);
        \Session::put('imagesUploadRealName',$names);
        DB::table('temp_upload_files')->where('original_name',$name)->delete();
    }
    
    public function deleteImege(){
        $serviceId = $_POST['serviceId'];
        $image = $_POST['image'];
        $img =ServiceImage::where('service_id',$serviceId)->where('id',$image)->first();

        $img_path = base_path() . '/uploads/services/source/';
        $img_path200 = base_path() . '/uploads/services/resize200/';
        $img_path800 = base_path() . '/uploads/services/resize800/';

        if ($img->image != null) {
            unlink(sprintf($img_path . '%s', $img->image));
            unlink(sprintf($img_path200 . '%s', $img->image));
            unlink(sprintf($img_path800 . '%s', $img->image));
        }
        $img->delete();
    }
    
    function getYoutubeEmbedUrl($url){
         $shortUrlRegex = '/youtu.be\/([a-zA-Z0-9_-]+)\??/i';
         $longUrlRegex = '/youtube.com\/((?:embed)|(?:watch))((?:\?v\=)|(?:\/))([a-zA-Z0-9_-]+)/i';
    
        if (preg_match($longUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }
    
        if (preg_match($shortUrlRegex, $url, $matches)) {
            $youtube_id = $matches[count($matches) - 1];
        }
        return 'https://www.youtube.com/embed/' . $youtube_id ;
    }
}
