<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SeoAssistant;
class SeoAssistantContoller extends Controller
{
    
    public function __construct()
    {
        //$this->middleware('permission:seo');
    }
    
    public function index()
    {
        $seo =SeoAssistant::first();
        return view('admin.seo.seo',compact('seo'));
    }

    public function update(Request $request, $id){
        $add=SeoAssistant::first();
        
        $add->home_meta_title = $request->home_meta_title;
        $add->home_meta_desc = $request->home_meta_desc;
        $add->home_meta_title_ar = $request->home_meta_title_ar;
        $add->home_meta_desc_ar = $request->home_meta_desc_ar;
        $add->home_meta_robots = $request->home_meta_robots ; 
        
        $add->about_meta_title = $request->about_meta_title;
        $add->about_meta_desc = $request->about_meta_desc;
        $add->about_meta_title_ar = $request->about_meta_title_ar;
        $add->about_meta_desc_ar = $request->about_meta_desc_ar;
        $add->about_meta_robots = $request->about_meta_robots ; 
        
        $add->gallery_images_meta_title = $request->gallery_images_meta_title;
        $add->gallery_images_meta_desc = $request->gallery_images_meta_desc;
        $add->gallery_images_meta_title_ar = $request->gallery_images_meta_title_ar;
        $add->gallery_images_meta_desc_ar = $request->gallery_images_meta_desc_ar;
        $add->gallery_images_meta_robots = $request->gallery_images_meta_robots ; 
        
        $add->gallery_videos_meta_title = $request->gallery_videos_meta_title;
        $add->gallery_videos_meta_desc = $request->gallery_videos_meta_desc;
        $add->gallery_videos_meta_title_ar = $request->gallery_videos_meta_title_ar;
        $add->gallery_videos_meta_desc_ar = $request->gallery_videos_meta_desc_ar;
        $add->gallery_videos_meta_robots = $request->gallery_videos_meta_robots ; 
        
        $add->contact_meta_title = $request->contact_meta_title;
        $add->contact_meta_desc = $request->contact_meta_desc;
        $add->contact_meta_title_ar = $request->contact_meta_title_ar;
        $add->contact_meta_desc_ar = $request->contact_meta_desc_ar;
        $add->contact_meta_robots = $request->contact_meta_robots ; 
        
        $add->services_meta_title = $request->services_meta_title ; 
        $add->services_meta_desc = $request->services_meta_desc ; 
        $add->services_meta_title_ar = $request->services_meta_title_ar ; 
        $add->services_meta_desc_ar = $request->services_meta_desc_ar ; 
        $add->services_meta_robots = $request->services_meta_robots ;
        
        $add->blogs_meta_title = $request-> blogs_meta_title;
        $add->blogs_meta_desc = $request-> blogs_meta_desc;
        $add->blogs_meta_title_ar = $request-> blogs_meta_title_ar;
        $add->blogs_meta_desc_ar = $request-> blogs_meta_desc_ar;
        $add->blogs_meta_robots = $request-> blogs_meta_robots;
        
        $add->brands_meta_title = $request-> brands_meta_title;
        $add->brands_meta_desc = $request-> brands_meta_desc;
        $add->brands_meta_title_ar = $request-> brands_meta_title_ar;
        $add->brands_meta_desc_ar = $request-> brands_meta_desc_ar;
        $add->brands_meta_robots = $request-> brands_meta_robots;
        
        $add->categories_meta_title = $request-> categories_meta_title;
        $add->categories_meta_desc = $request-> categories_meta_desc;
        $add->categories_meta_title_ar = $request-> categories_meta_title_ar;
        $add->categories_meta_desc_ar = $request-> categories_meta_desc_ar;
        $add->categories_meta_robots = $request-> categories_meta_robots;
        
        $add->save();
        return back()->with('success',trans('home.data_updated_successfully'));
    }


}
