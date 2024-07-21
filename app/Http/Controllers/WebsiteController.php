<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HomeSlider;
use App\Models\Category;
use App\Models\HomeImage;
use DB;
use App\Models\MenuItem;
use Auth;
use App\Models\Service;
use App\Models\Project;
use App\Models\Page;
use App\Models\AboutStruc;
use App\Models\About;
use App\Models\ContactUs;
use App\Models\Setting;
use Mail;
use App\Models\BlogCategory;
use App\Models\BlogItem;
use App\Models\GalleryImage;
use App\Models\GalleryVideo;
use App\Models\SeoAssistant;
use App\Models\Configration;
use App\Models\Certificate;
use Melbahja\Seo\Schema;
use Melbahja\Seo\Schema\Thing;
use Melbahja\Seo\MetaTags;
use App\Models\Faq;
use App\Models\Comment;
use App\Models\Writer;
use App\Models\Brand;
use App\Traits\SeoTrait;
use App\Support\Collection;
use App\Models\Career;
use App\Models\CareerApplication;
use App\Models\Testimonial;
use App\Models\TrainingApplication;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class WebsiteController extends Controller
{
    use SeoTrait;
        public function checkUrl($slug){
            $checkMenu = MenuItem::where('type',$slug)->first();
            // $checkBlog = BlogItem::where('link_en', $slug)->orWhere('link_ar', $slug)->first();
            // $checkService = Service::where('link_en',$slug)->orWhere('link_ar',$slug)->first();
            // $checkProject = Project::where('link_en', $slug)->orWhere('link_ar', $slug)->first();
            
            if($checkMenu){
                return $this->menus($checkMenu->type);
            }else{
                abort('404');
            }
        }

    //////// function retun dynamic menu//////////
    public function menus($menu){
        $menu = MenuItem::where('type',$menu)->first();
        $lang=\LaravelLocalization::getCurrentLocale();
        
        if($menu->type == 'home'){
            return $this->home();
        }

        elseif($menu->type == 'about-us'){
            return $this->aboutUs();
        }

        elseif($menu->type == 'contact-us'){
            return $this->contactUs();
        }

        elseif($menu->type == 'projects'){
            return $this->getProjects();
        }

        elseif($menu->type == 'services'){
            return $this->getservices();
        }
        
        elseif($menu->type == 'galleryImages'){
             return $this->getGalleryImages();
        }
        
        
        elseif($menu->type == 'galleryVideos'){
             return $this->getGalleryVideos();
        }

        elseif($menu->type == 'blogs'){
             return $this->getBlogs();
        }

        elseif($menu->type == 'careers'){
            return $this->getCareersPage();
        }

        elseif($menu->type == 'training'){
            return $this->applyTrainingPage();
        }

        elseif($menu->type == 'developers'){
            return $this->developersPage();
        }
        
        
        elseif($menu->type == 'check-certificate'){
            return $this->getCertificateVerification();
        }
        
    }
    
    ////////////// function returnindex page///////////
    public function home(){
        $lang=\LaravelLocalization::getCurrentLocale();
        $sliders = HomeSlider::where('lang',$lang)->where('status',1)->get();
        $blogs = BlogItem::where('status',1)->take(6)->get();
        $categories = Category::where('status',1)->where('home',1)->get();
        $about = About::first();
        $aboutStrucs = AboutStruc::where('lang',$lang)->where('status',1)->get();
        $brands = Brand::where('status',1)->take(12)->get();
        $projects =Project::where('status',1)->get();
        $careers = Career::where('status',1)->get();
        $faqs = Faq::where('type','general')->get();
        $services = Service::where('parent_id',0)->where('status',1)->orderBy('order')->orderBy('name_ar')->get();
        

        ////// seo script//////
        list($schema, $metatags) = $this->homePageSeo();
        
        return view('website.home',compact('sliders','categories','about','blogs','schema','metatags','brands','aboutStrucs','projects','careers','faqs','services'));
    }
    
    ////////////FUNCTION RETURN VIEW ABOUT US//////
    public function aboutUs(){
        $lang= \LaravelLocalization::getCurrentLocale();
        $about = About::first();
        $blogCategories= BlogCategory::orderBy('id','desc')->get();
        $aboutStrucs = AboutStruc::where('lang',$lang)->where('status',1)->get();
        $services = Service::where('parent_id',0)->where('status',1)->orderBy('order')->orderBy('name_ar')->get();
        $projects =Project::where('status',1)->get();
        $members = Testimonial::where('status',1)->get();
        $brands = Brand::where('status',1)->get();
        ////// seo script//////
        list($schema, $metatags) = $this->aboutUsPageSeo();
        return view('website.about-us',compact('lang','members','brands','about','aboutStrucs','metatags','schema', 'services','blogCategories','projects'));
    }

    ////////////FUNCTION RETURN VIEW CONTACT US//////
    public function contactUs(){
        $lang=\LaravelLocalization::getCurrentLocale();
        $projects =Project::where('status',1)->get();
        $blogCategories= BlogCategory::orderBy('id','desc')->get();
        $services = Service::where('parent_id',0)->where('status',1)->orderBy('order')->orderBy('name_ar')->get();
        $about = About::first();
        ////// seo script//////
        list($schema, $metatags) = $this->contactUsPageSeo();
        return view('website.contact-us',compact('lang','schema','metatags','blogCategories','services','about','projects'));
    }

    ////////////// function saveContact//////////
    public function saveContactUs(Request $request){
        $request->validate([
          'name'=>'required|max:150',
          'email'=>'required|email',
          'message'=>'required',
          'phone'=>'required|regex:/(01)[0-9]{9}/',
        ]);

        $contact = new ContactUs();
        $contact->name = $request->name;
        $contact->email = $request->email;
        $contact->phone = $request->phone;
        $contact->message = $request->message;
        $contact->save();

//         $data = array('contact' => $contact);
//         $setting = Setting::first();
// 	    Mail::send('emails/contact_email', $data, function($msg) use ($setting) {
//   			$msg->to([$setting ->contact_email,'support@waelsakrplastic.com'], 'Booking Appointement')->subject('Booking');
//   			$msg->cc(['begroup.seo@gmail.com','ahmed.essam.be@gmail.com']);
//   			$msg->from(config('mail.from.address'),config('mail.from.name'));
// 		});

        return back()->with(['contact_message'=>trans('home.Thank you for contacting us. A customer service officer will contact you soon')]);

    }

    ////////// FUNCTION RETURN PAGE INFORMATION /////////
    public function getPage($link){
        $lang=\LaravelLocalization::getCurrentLocale();
        $page =Page::where('link_en',$link)->orwhere('link_ar',$link)->first();
        return view('website.page',compact('lang','page'));
    }

    /////////////////////FUNCTION RETURN VIEW BLOGS ///////////
    public function getBlogs($link = null){
        $lang=\LaravelLocalization::getCurrentLocale();
        if($link){
            $blogCategory = BlogCategory::where('link_en',$link)->orwhere('link_ar',$link)->first();
            $blogs = BlogItem::where('blogcategory_id',$blogCategory->id)->where('status',1)->get();
            $blogCategories= BlogCategory::orderBy('id','desc')->get();
            $services = Service::where('parent_id',0)->where('status',1)->orderBy('order')->orderBy('name_ar')->take(6)->get();
            $projects =Project::where('status',1)->get();
            $about = About::first();
            ////// seo script//////
            list($metatags) = $this->CategoryBlogsPageSeo($link);
            return view('website.category-blogs',compact('lang','blogCategory','blogs','metatags','services','blogCategories','about','projects'));
        }else{
            $blogs = BlogItem::where('status',1)->get();
            $about = About::first();
            $projects =Project::where('status',1)->get();
            ////// seo script//////
            list($metatags) = $this->blogsPageSeo();
            return view('website.blogs',compact('lang','blogs','metatags','about','projects'));
        }
    }

    /////////////////////FUNCTION RETURN VIEW BLOG ///////////
    public function getBlogPage($link){
        $blog = BlogItem::where('link_en',$link)->orwhere('link_ar',$link)->first();
        $blogCategories= BlogCategory::orderBy('id','desc')->get();
        $services = Service::where('parent_id',0)->where('status',1)->orderBy('order')->orderBy('name_ar')->take(6)->get();
        $faqs = Faq::where('type','blog_item')->where('blog_item_id',$blog->id)->get();
        $blogs = BlogItem::where('status',1)->take(6)->get();
        $comments = Comment::where('type','blog')->where('type_id',$blog->id)->where('admin_approve',1)->get();
        $about = About::first();
        $projects =Project::where('status',1)->get();
        ////// seo script//////
        list($schema, $metatags)= $this->blogSeo($link);
        
        return view('website.blogPage',compact('blog','schema','metatags','faqs','comments','blogs','services','blogCategories','about','projects'));
    }
    
      ////////// function return list of published categories/////
     public function getCategories(){
        $categories =Category::where('status',1)->get();
       
       
        $about = About::first();
        ////// seo script//////
        list($metatags)= $this->categoriesPageSeo();
        return view('website.categories',compact('categories','metatags','about'));
    }

    ////////// function return list of published products/////
    public function getProjects(){
        $projects =Project::where('status',1)->get();
        $projects = (new Collection($projects))->paginate(18);
       
        $about = About::first();
        ////// seo script//////
        list($metatags)= $this->projectsPageSeo();
        return view('website.projects',compact('projects','metatags','about'));
    }
    
    ////////// function return project Details /////
    public function getProjectDetails($link){
        $project =Project::where('link_en',$link)->orwhere('link_ar',$link)->first();
        $projects =Project::where('status',1)->get();
        $about = About::first();
        $faqs = Faq::where('type','project')->where('project_id',$project->id)->get();
        if($project){
            $faqs = Faq::where('type','project')->where('project_id',$project->id)->get();
            $relatedProjects = Project::where('category_id',$project->category_id)->where('status',1)->get();
            list($schema, $metatags)= $this->projectPageSeo($link);
            return view('website.project-details',compact('project','relatedProjects','schema','metatags','about','faqs','projects'));
        }else{
            abort('404');
        }
    }
    
    ////////// function return list of published services/////
    public function getservices(){
        $services = Service::where('parent_id',0)->where('status',1)->orderBy('order')->orderBy('name_ar')->get();
        $blogCategories= BlogCategory::orderBy('id','desc')->get();
        $projects =Project::where('status',1)->get();
        $about = About::first();
        ////// seo script//////
        list($metatags)= $this->servicesPageSeo();
        return view('website.services',compact('services','metatags','blogCategories','projects','about'));
    }
    
    ////////// function return project service /////
    public function getServiceDetails($link){
        $service =Service::where('link_en',$link)->orwhere('link_ar',$link)->first();
        $subServices = Service::where('parent_id',$service->id)->where('status',1)->get();
        $blogCategories= BlogCategory::orderBy('id','desc')->get();
        if(count($subServices) > 0){
            $faqs = Faq::where('type','service')->where('service_id',$service->id)->get();
            $services =$subServices;
            ////// seo script//////
            list($schema, $metatags)= $this->serviceSeo($link);
            return view('website.sub-services',compact('service','services', 'faqs','metatags','blogCategories'));
        }

        if($service){
            $faqs = Faq::where('type','service')->where('service_id',$service->id)->get();
            $services = Service::where('parent_id',0)->where('status',1)->orderBy('order')->orderBy('name_ar')->get();
            $blogCategories= BlogCategory::orderBy('id','desc')->get();
            ////// seo script//////
            list($schema, $metatags)= $this->serviceSeo($link);
            return view('website.service-details',compact('service','services','metatags','schema','faqs','blogCategories'));
        }else{
            abort('404');
        }
    }
    
    public function getGalleryImages(){
        $images =GalleryImage::where('status',1)->orderBy('order','asc')->paginate(9);
        $blogCategories= BlogCategory::orderBy('id','desc')->get();
        $services = Service::where('parent_id',0)->where('status',1)->orderBy('order')->orderBy('name_ar')->take(6)->get();
        ////// seo script//////
        list($schema, $metatags)= $this->galleryImagesPageSeo();
        return view('website.gallery-images',compact('images','metatags','schema','blogCategories','services'));
    }
    
    public function getGalleryVideos(){
        $videos =GalleryVideo::where('status',1)->orderBy('order','asc')->get();
        $blogCategories= BlogCategory::orderBy('id','desc')->get();
        $services = Service::where('parent_id',0)->where('status',1)->orderBy('order')->orderBy('name_ar')->take(6)->get();
        ////// seo script//////
        list($schema, $metatags)= $this->galleryVideosPageSeo();
        return view('website.gallery-videos',compact('videos','metatags','schema','blogCategories','services'));
    }
    
    public function saveComment(Request $request){
        $add = new Comment();
        $add->name=$request->name;
        $add->email=$request->email;
        $add->comment=$request->comment;
        $add->type=$request->type;
        $add->type_id=$request->type_id;
        $add->save();
        return back()->with(['success'=>trans('home.Thank you for your Comment , your commnet under review')]);
        
    }
    
    
    

    public function getDeveloperProjects($link){
        $developer = Brand::where('link_en',$link)->orwhere('link_ar',$link)->first();

        $projects =Project::where('brand_id',$developer->id)->where('status',1)->get();
        $projects = (new Collection($projects))->paginate(18);
        ////// seo script//////
        list($metatags)= $this->projectsPageSeo();
        return view('website.developer-project',compact('projects','metatags','developer'));
    }


    public function projectsSearchResults(Request $request){

        $projects =Project::where('status',1)->whereBetween('price', [intval($request->from)-1,intval($request->to)+1])->get();

        if($request->project_name){
            $projects =Project::where('status',1)->whereBetween('price', [intval($request->from)-1,intval($request->to)+1]);
            $projects =  $projects->where('name_en', 'like', '%' . $request->project_name . '%')->orwhere('name_ar', 'like', '%' . $request->project_name . '%')->get();
        }

        if($request->region_id){
            $projects =Project::where('status',1)->whereBetween('price', [intval($request->from)-1,intval($request->to)+1]);
            $projects =  $projects->where('name_en', $request->region_id)->get();
        }

        if($request->developer_id){
            $projects =Project::where('status',1)->whereBetween('price', [intval($request->from)-1,intval($request->to)+1]);
            $projects =  $projects->where('brand_id', $request->developer_id)->get();
        }

        if($request->project_area){
            $projects =Project::where('status',1)->whereBetween('price', [intval($request->from)-1,intval($request->to)+1]);
            $projects =  $projects->where('project_area', $request->project_area)->get();
        }   
        $projects = (new Collection($projects))->paginate(18);

        return view('website.search-results',compact('projects'));
    }

    public function getRecommendedProjects(){
        $projects =Project::where('status',1)->where('recommended',1)->get();
        $recommendedProjects  = (new Collection($projects))->paginate(18);
        ////// seo script//////
        list($metatags)= $this->projectsPageSeo();
        return view('website.all-recommended-projects',compact('recommendedProjects','metatags'));
    }


    public function getCategoryProjects($link){
        $category = Category::where('link_en',$link)->orwhere('link_ar',$link)->first();
        $projects =Project::where('status',1)->where('category_id',$category->id)->get();
        $projects = (new Collection($projects))->paginate(3);
        $about = About::first();
        $categories = Category::orderBy('id','DESC')->get();
        $MainCategories = Category::orderBy('id','DESC')->get();
        ////// seo script//////
        list($metatags)= $this->categoryPageSeo($link);

        return view('website.category-projects',compact('projects','metatags','category','about','categories','MainCategories'));
    }


    public function getCareersPage(){
        $careers = Career::where('status',1)->get();
        ////// seo script//////
        list($metatags)= $this->projectsPageSeo();
        return view('website.careers',compact('careers','metatags'));
    }

    public function applyTrainingPage(){
        ////// seo script//////
        list($metatags)= $this->projectsPageSeo();
        return view('website.apply-training',compact('metatags'));
    }

    public function developersPage(){
        ////// seo script//////
        list($metatags)= $this->projectsPageSeo();
        return view('website.developers',compact('metatags'));
    }

    public function saveCareerApplication(Request $request){
        $request->validate([
            'name'=>'required|max:150',
            'email'=>'required|email',
            'phone'=>'required|regex:/(01)[0-9]{9}/',
            'cv_file'=>'mimes:pdf,docx',
            'position'=>'required',
        ]);
        
        $add = new CareerApplication();
        $add->name = $request->name;
        $add->email = $request->email;
        $add->phone = $request->phone;
        $add->notes = $request->notes;
        $add->gender = $request->gender;
        $add->career_id = $request->career_id;
        $add->position = $request->position;
        
        //upload cv pdf file
        if($request->hasFile("cv_file")){
            $extension = $request->file('cv_file')->getClientOriginalExtension();
            $filename = rand(11111111, 99999999). '.' . $extension;
            $request->file('cv_file')->move( base_path() . '/uploads/careers/cvs', $filename );
            $add->cv_file = $filename;
        }
        
        $add->save();
        
                
        //         $data = array('contact' => $contact);
//         $setting = Setting::first();
// 	    Mail::send('emails/contact_email', $data, function($msg) use ($setting) {
//   			$msg->to([$setting ->contact_email,'support@waelsakrplastic.com'], 'Booking Appointement')->subject('Booking');
//   			$msg->cc(['begroup.seo@gmail.com','ahmed.essam.be@gmail.com']);
//   			$msg->from(config('mail.from.address'),config('mail.from.name'));
// 		});

        return back()->with(['success'=>trans('home.Thank you for contacting us. A customer service officer will contact you soon')]);
    }
    
    public function saveTrainingApplications(Request $request){
        $request->validate([
            'name'=>'required|max:150',
            'email'=>'required|email',
            'notes'=>'required',
            'phone'=>'required|regex:/(01)[0-9]{9}/',
        ]);
        
        $add = new TrainingApplication();
        $add->name = $request->name;
        $add->email = $request->email;
        $add->phone = $request->phone;
        $add->notes = $request->notes;
        $add->training = $request->training;
        $add->save();

        //         $data = array('contact' => $contact);
//         $setting = Setting::first();
// 	    Mail::send('emails/contact_email', $data, function($msg) use ($setting) {
//   			$msg->to([$setting ->contact_email,'support@waelsakrplastic.com'], 'Booking Appointement')->subject('Booking');
//   			$msg->cc(['begroup.seo@gmail.com','ahmed.essam.be@gmail.com']);
//   			$msg->from(config('mail.from.address'),config('mail.from.name'));
// 		});
        return back()->with(['success'=>trans('home.Thank you for contacting us. A customer service officer will contact you soon')]);
        
    }
    
    //////////////////// search auto complete function ///////////////////
    public function autoCompletesearch(){
        $lang=\LaravelLocalization::getCurrentLocale();
        $text = $_GET['phrase'];
        $projects = Project::where('name_en', 'like', '%' . $text . '%')->orwhere('name_ar', 'like', '%' . $text . '%')->where('status',1)->get();
        $results = [];
        foreach ($projects as $query){
            if($lang == 'en'){
                $results[] = ['name' => $query->name_en ];
            }else{
                $results[] = ['name' => $query->name_ar ];
            }
        }
        return response()->json($results);
    }
    

    public function getCertificateVerification(){
        $about = About::first();
        return view('website.certificateVerification',compact('about'));
    }
    
    public function checkCertificateVerification(){
        $certificate_id = $_POST['certificate_id'];
        $certificate = Certificate::where('certificate_id',$certificate_id)->first();
        return response()->json([
            'html' => view('website.partials.certificate', compact('certificate'))->render(),
        ]);
    }
    
    
    
}
