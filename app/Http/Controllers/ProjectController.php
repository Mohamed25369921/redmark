<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Brand;
use App\Models\Service;
use App\Models\Category;
use DB;
use File;
use Image;
use App\Models\ProjectImage;
use App\Models\CategoryAttribute;
use App\Models\Attribute;
use App\Models\ProjectAttribute;
use App\Models\Region;
use Illuminate\Http\Request;
use App\Models\Faq;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        $this->middleware(['permission:project']);
    }

    public function index()
    {
        $projects = Project::orderBy('id','DESC')->get();
        return view('admin.projects.projects',compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $brands = Brand::where('status',1)->get();
        $services = Service::where('status',1)->get();
        $categories = Category::where('status',1)->get();
        return view('admin.projects.addProject',compact('brands','services','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = new Project();
        $add->name_en = $request->name_en;
        $add->name_ar = $request->name_ar;
        $add->link_en = str_replace(" ","-",$request->link_en);
        $add->link_ar = str_replace(" ","-",$request->link_ar);
        $add->brand_id = $request->brand_id;
        $add->img_alt = $request->img_alt;
        $add->category_id = $request->category_id;
        if ($request->hasFile("image")) {

            $file = $request->file("image");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/projects/source/' . $fileName);
            $resize200 = base_path('uploads/projects/resize200/' . $fileName);
            $resize800 = base_path('uploads/projects/resize800/' . $fileName);
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

        //////////// add faqs/////////////
        $questions=$request->question;
        $answers =$request->answer; 
        $statuses =$request->faq_status; 
        if (is_array($questions) || is_object($questions)){
            foreach($questions as $key=>$question){
                if($question){
                    $faq=new Faq();
                    $faq->project_id=$add->id;
                    $faq->type='project';
                    $faq->question=$question;
                    $faq->answer=$answers[$key];
                    $faq->status=$statuses[$key];
                    $faq->save();
                }
            }
        }

        return redirect('admin/projects/'.$add->id.'/edit')->with('success',trans('home.your_produt_added_successfully_upload_images_and_complete_specifications'));
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
        $project=Project::find($id);
        
        if($project){
            $questions = Faq::where('type','project')->where('project_id',$id)->get();
            $brands = Brand::where('status',1)->get();
            $services = Service::where('status',1)->get();
            $categories = Category::where('status',1)->get();
            $regions = Region::where('country_id',1)->where('available_units',1)->where('status',1)->get();

            $categoryAttributeIds = CategoryAttribute::where('category_id',$project->category_id)->pluck('attribute_id')->toArray();
            $attributes=Attribute::whereIn('id',$categoryAttributeIds)->get();
            $projectAttributeValueIds = ProjectAttribute::where('project_id',$id)->pluck('attribute_value_id')->toArray();
            
            $images = DB::table('temp_upload_files')->where('type','project')->where('project_id',$id)->get();
            if(count($images) > 0){
                foreach($images as $image){
                    try{
                        $img_path = base_path() . '/uploads/projects/source/';
                        $img_path200 = base_path() . '/uploads/projects/resize200/';
                        $img_path800 = base_path() . '/uploads/projects/resize800/';
                        if($image->server_name){
                            unlink(sprintf($img_path . '%s', $image->server_name));
                            unlink(sprintf($img_path200 . '%s', $image->server_name));
                            unlink(sprintf($img_path800 . '%s', $image->server_name));
                        }
                    }catch(Exception $e){
                    }
                }
                DB::table('temp_upload_files')->where('type','project')->where('project_id',$id)->delete();
                session()->forget('imagesUpload');
                session()->forget('imagesUploadRealName');
            }
            
            return view('admin.projects.editProject',compact('project','brands','services','categories','attributes','projectAttributeValueIds','regions','questions'));
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
        $add = Project::find($id);
        $add->name_en = $request->name_en;
        $add->name_ar = $request->name_ar;
        $add->text_ar = $request->text_ar;
        $add->text_en = $request->text_en;
        $add->faq_en = $request->faq_en;
        $add->faq_ar = $request->faq_ar;
        $add->status = $request->status;
        $add->brand_id = $request->brand_id;
        $add->img_alt = $request->img_alt;
        $add->service_id = $request->service_id;
        $link_en = str_replace(" ","-",$add->name_en);
        $add->link_en = str_replace(" ","-",$link_en);  
        $link_ar = str_replace(" ","-",$add->name_ar);
        $add->link_ar = str_replace(" ","-",$link_ar); 
        
        $add->meta_title_en = $request->meta_title_en;
        $add->meta_desc_en = $request->meta_desc_en;
        $add->meta_title_ar = $request->meta_title_ar;
        $add->meta_desc_ar = $request->meta_desc_ar;
        $add->meta_robots = $request->meta_robots ; 

        $add->price = $request->price ; 
        $add->lectures = $request->lectures ; 
        $add->duration = $request->duration ;
        $add->enrolled = $request->enrolled ;
        $add->language_en = $request->language_en;
        $add->language_ar = $request->language_ar;
        $add->map_url = $request->map_url ;

        $add->instructor_en = $request->instructor_en ;
        $add->instructor_ar = $request->instructor_ar ;
        $add->region_id = $request->region_id ;
        $add->project_area = $request->project_area ;


        if ($request->hasFile("image")) {

            $file = $request->file("image");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = base_path() . '/uploads/projects/source/';
            $img_path200 = base_path() . '/uploads/projects/resize200/';
            $img_path800 = base_path() . '/uploads/projects/resize800/';

            if ($add->image != null) {
                unlink(sprintf($img_path . '%s', $add->image));
                unlink(sprintf($img_path200 . '%s', $add->image));
                unlink(sprintf($img_path800 . '%s', $add->image));
            }

            // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/projects/source/' . $fileName);
            $resize200 = base_path('uploads/projects/resize200/' . $fileName);
            $resize800 = base_path('uploads/projects/resize800/' . $fileName);
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
        

        //////////// add faqs/////////////
        $questions=$request->question;
        $answers =$request->answer; 
        $statuses =$request->faq_status; 
        if (is_array($questions) || is_object($questions)){
            foreach($questions as $key=>$question){
                if($question){
                    $faq=new Faq();
                    $faq->project_id=$add->id;
                    $faq->type='project';
                    $faq->question=$question;
                    $faq->answer=$answers[$key];
                    $faq->save();
                }
            }
        }

        ///////// save project images//////
        if(\Session::has('imagesUpload')){
            $images = \Session::get('imagesUpload');
            foreach ($images as $key=>$file) {
                $img = new ProjectImage();
                $img->image = $file;
                $img->project_id=$add->id;
                $img->save();
            }
        }

        DB::table('temp_upload_files')->where('project_id',$id)->delete();
        session()->forget('imagesUpload');
        session()->forget('imagesUploadRealName');


        //////// save project attributes///////////////
        if($request->attribute){
            ProjectAttribute::where('project_id',$id)->delete();
            $attributes=$request->attribute;
            foreach($attributes as $attribute){
                if($attribute){
                    $x=explode('-',$attribute);
                    $attr=new ProjectAttribute();
                    $attr->project_id =$add->id;
                    $attr->attribute_id=$x[0];
                    $attr->attribute_value_id=$x[1];
                    $attr->save();
                }
            }
        }

        return redirect('/admin/projects')->with('success',trans('home.your_item_updated_successfully'));
    }

    public function changeCategory(Request $request,$id){
        $project=Project::find($id);
        $project->category_id = $request->category_id;
        $project->save();
        
        //////delete attributes////
        ProjectAttribute::where('project_id',$id)->delete();
        return back()->with('success',trans('home.category_changed_successfully'));
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
        $img_path = base_path() . '/uploads/projects/source/';
        $img_path200 = base_path() . '/uploads/projects/resize200/';
        $img_path800 = base_path() . '/uploads/projects/resize800/'; 
        
        foreach ($ids as $id) {
            $project = Project::findOrFail($id);

            if ($brand->image != null) {
                unlink(sprintf($img_path . '%s', $project->image));
                unlink(sprintf($img_path200 . '%s', $project->image));
                unlink(sprintf($img_path800 . '%s', $project->image));
            }

            $project->delete();
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
            
            $path = base_path('uploads/projects/source/' . $fileName);
            $resize200 = base_path('uploads/projects/resize200/' . $fileName);
            $resize800 = base_path('uploads/projects/resize800/' . $fileName);
            
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
            DB::table('temp_upload_files')->insert(['server_name' => $fileName,'original_name' => $realName ,'project_id' => $request->projectId, 'type'=>'project']);
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
        
        $img_path = base_path() . '/uploads/projects/source/';
        $img_path200 = base_path() . '/uploads/projects/resize200/';
        $img_path800 = base_path() . '/uploads/projects/resize800/';

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
        $projectId = $_POST['projectId'];
        $image = $_POST['image'];
        $img =ProjectImage::where('project_id',$projectId)->where('id',$image)->first();

        $img_path = base_path() . '/uploads/projects/source/';
        $img_path200 = base_path() . '/uploads/projects/resize200/';
        $img_path800 = base_path() . '/uploads/projects/resize800/';

        if ($img->image != null) {
            unlink(sprintf($img_path . '%s', $img->image));
            unlink(sprintf($img_path200 . '%s', $img->image));
            unlink(sprintf($img_path800 . '%s', $img->image));
        }
        $img->delete();
    }

    
}
