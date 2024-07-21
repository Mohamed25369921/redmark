<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use App;
use View;
use App\Models\Setting;
use App\Models\Configration;
use App\Models\MenuItem;
use App\Models\Page;
use Auth;
use App\Models\Category;
use App\Models\Service;
use App\Models\GalleryImage;
use App\Models\Address;
use App\Models\SeoAssistant;
use App\Models\BlogCategory;
use App\Models\Writer;
use App\Models\Region;
use App\Models\Project;
use App\Models\About;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
        Schema::defaultStringLength(191);
        // \URL::forceScheme('https');

        view()->composer('*', function($view)
        {
            $setting = Setting::first();
            $seo = SeoAssistant::first();
            $writers = Writer::where('status',1)->get();
            $lang = \LaravelLocalization::getCurrentLocale();
            App::setlocale($lang);
            $blogCategories= BlogCategory::orderBy('id','desc')->get();
            $configration = Configration::where('lang',$lang)->first();
            $menus = MenuItem::where('menu_id',1)->where('status',1)->where('parent_id',0)->orderBy('order','ASC')->get();
            $footerMenus = MenuItem::where('menu_id',2)->where('status',1)->where('parent_id',0)->orderBy('order','ASC')->get();
            $pages = Page::where('status',1)->get();
            $menuServices = Service::where('menu',1)->where('status',1)->where('parent_id',0)->orderBy('order','ASC')->take(6)->get();
   
            $menuCategories = Category::where('menu',1)->where('status',1)->get();
            $footerServices = Service::where('parent_id',0)->where('status',1)->orderBy('order')->orderBy('name_ar')->take(6)->get();;
            $galleryImages = GalleryImage::where('status',1)->orderBy('order','asc')->get();
            $regions = Region::where('status',1)->where('available_units',1)->get();
            $lang=\App::getLocale();
            
            $addresses = Address::where('status',1)->get();
            $projects =Project::where('status',1)->get();
            $about = About::first();

            App::setlocale($lang);
            View::share('language', $lang);
            View::share('setting', $setting);
            View::share('configration', $configration);
            View::share('menus', $menus);
            View::share('pages', $pages);
            View::share('lang', $lang);
            View::share('footerServices', $footerServices);
            View::share('blogCategories', $blogCategories);
            View::share('galleryImages', $galleryImages);
            View::share('addresses', $addresses);
            View::share('writers', $writers);
            View::share('seo', $seo);
            View::share('footerMenus', $footerMenus);
            View::share('menuServices', $menuServices);
            View::share('menuCategories', $menuCategories);
            View::share('regions', $regions);
            View::share('projects', $projects);
            View::share('about', $about);
            
            
        });
    }
}
