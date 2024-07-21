<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Lang;
use App\Models\Page;
use App\Models\Menu;
use App\Models\MenuItem;
use Auth;
use App\Models\Service;
use App\Models\Brand;
use App\Models\Project;
use App\Models\User;
use App\Models\GalleryImage;
use App\Models\BlogItem;
use App\Models\ContactUs;
use App\Models\Testimonial;
use App\Models\Career;
use App\Models\CareerApplication;
use App\Models\Address;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    ///// function return admin index view///////
    public function admin(){
        $services = Service::count();
        $brands = Brand::count();
        $projects = Project::count();
        $users = User::count();
        $galleryImages = GalleryImage::count();
        $blogs = BlogItem::count();
        $messages = ContactUs::count();
        $categories = Category::count();
        $careers = Career::count();
        $careersApplications = CareerApplication::count();
        $pages = Page::count();
        $addresses = Address::count();
        
        
        return view('admin.index',compact('services','brands','projects','users','galleryImages','blogs','messages','categories','careers','careersApplications','pages','addresses'));
    }

    ///// function set session lang of the app////
    public function setlang($lang){
        $langs = ['en', 'ar'];
        if (in_array($lang, $langs)) {
            session(['lang' => $lang]);
            return redirect()->back();
        }
    }


    ///// function publish and unpublish status////
    public function updatestatus($name,$ids)
    {
        $ids = explode(',', $ids);
        foreach ($ids as $x) {

            if($name == 'categories'){
                $update = Category::findOrFail($x);
            }

            if($name == 'countries'){
                $update = Country::findOrFail($x);
            }

            if($name == 'regions'){
                $update = Region::findOrFail($x);
            }

            if($name == 'pages'){
                $update = Page::findOrFail($x);
            }

            if($name == 'products'){
                $update = Product::findOrFail($x);
            }

            if($name == 'menus'){
                $update = Menu::findOrFail($x);
            }

            if($name == 'menu-items'){
                $update = MenuItem::findOrFail($x);
            }
            
            if($name == 'testimonials'){
                $update = Testimonial::findOrFail($x);
            }



            if ($update->status == 0) {
                $update->status = 1;
                $update->save();
            }
            else {
                $update->status = 0;
                $update->save();
            }
        }
    }
    
    public function switchTheme(){
        $user =Auth::user();
        if ($user ->theme == 'light') {
            $user ->theme = 'dark';
            $user ->save();
        }else {
            $user->theme = 'light';
            $user->save();
        }
        return back();
    }
}
