<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Service;
use App\Models\Project;
use App\Models\Brand;
use App\Models\Page;
use App\Models\BlogItem;

class SiteMapController extends Controller
{
    public function index(){
	  return response()->view('sitemap.index')->header('Content-Type', 'text/xml');
	}

    public function services(){
        $services= Service::orderBy('order')->orderBy('name_ar')->latest()->get();
        return response()->view('sitemap.services-sitemap', [
    	      'services'=>$services,
    	])->header('Content-Type', 'text/xml');
    }
    
    public function brands(){
        $brands= Brand::latest()->get();
        return response()->view('sitemap.brands-sitemap', [
    	      'brands' => $brands,
    	])->header('Content-Type', 'text/xml');
    }
    
    public function categories(){
        $categories= Category::latest()->get();
        return response()->view('sitemap.categories-sitemap', [
    	      'categories' => $categories,
    	])->header('Content-Type', 'text/xml');
    }
    
    public function projects(){
        $projects= Project::latest()->get();
        return response()->view('sitemap.projects-sitemap', [
    	      'projects' => $projects,
    	])->header('Content-Type', 'text/xml');
    }
    
    public function pages(){
        $pages = Page::latest()->get();
        return response()->view('sitemap.pages-sitemap', [
    	      'pages' => $pages,
    	])->header('Content-Type', 'text/xml');
    }
    
    public function blogs(){
        $blogs = BlogItem::latest()->get();
        return response()->view('sitemap.blogs-sitemap', [
    	      'blogs' => $blogs,
    	])->header('Content-Type', 'text/xml');
    }
    
    public function galleryImages(){
        $galleryImages = GalleryImage::latest()->get();
        return response()->view('sitemap.galleryImages-sitemap', [
    	      'galleryImages' => $galleryImages,
    	])->header('Content-Type', 'text/xml');
    }

}