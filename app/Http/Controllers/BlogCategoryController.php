<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\BlogCategory;

class BlogCategoryController extends Controller
{


    public function __construct()
    {
        $this->middleware('permission:blogCategory');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blogCategories= BlogCategory::orderBy('id','desc')->get();
        return view('admin.blogCategories.blogCategories',compact('blogCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.blogCategories.addBlogCategory');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $blogcategory = new BlogCategory();
        $blogcategory->title_en = $request->title_en;
        $blogcategory->title_ar = $request->title_ar;
        $blogcategory->link_en = str_replace(" ","-",$request->link_en);
        $blogcategory->link_ar = str_replace(" ","-",$request->link_ar);
        $blogcategory->text_en = $request->text_en;
        $blogcategory->text_ar = $request->text_ar;
        $blogcategory->status = $request->status;
        $blogcategory->meta_title_en = $request->meta_title_en;
        $blogcategory->meta_title_ar = $request->meta_title_ar;
        $blogcategory->meta_desc_en =$request->meta_desc_en;
        $blogcategory->meta_desc_ar =$request->meta_desc_ar;
        $blogcategory->meta_robots =$request->meta_robots;
        $blogcategory->save();
        return redirect()->route('blog-categories.index',app()->getLocale())->with('success',trans('home.your_item_added_successfully'));
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
        $blogCategory = BlogCategory::find($id);
        if($blogCategory){
            return view('admin.blogCategories.editBlogCategory',compact('blogCategory'));
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
    public function update(Request $request,$id)
    {
        //
        $blogcategory = BlogCategory::find($id);
        $blogcategory->title_en = $request->title_en;
        $blogcategory->title_ar = $request->title_ar;
        $blogcategory->link_en = str_replace(" ","-",$request->link_en);
        $blogcategory->link_ar = str_replace(" ","-",$request->link_ar);
        $blogcategory->text_en = $request->text_en;
        $blogcategory->text_ar = $request->text_ar;
        $blogcategory->status = $request->status;
        $blogcategory->meta_title_en = $request->meta_title_en;
        $blogcategory->meta_title_ar = $request->meta_title_ar;
        $blogcategory->meta_desc_en =$request->meta_desc_en;
        $blogcategory->meta_desc_ar =$request->meta_desc_ar;
        $blogcategory->meta_robots =$request->meta_robots;
        $blogcategory->save();
        return redirect()->route('blog-categories.index')->with('success',trans('home.your_item_updated_successfully'));

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
            $m = BlogCategory::findOrFail($id);
            $m->delete();
        }
    }
}
