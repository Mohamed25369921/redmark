<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Page;

class PageController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:page');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $pages = Page::all();
        return view('admin.pages.pages',compact('pages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.pages.addPage');
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
        $add = new Page();
        
        $add->title_en=$request->title_en;
        $add->title_ar=$request->title_ar;
        $link_en = str_replace(" ","-",$add->title_en);
        $add->link_en = str_replace(" ","-",$link_en);  
        $link_ar = str_replace(" ","-",$add->title_ar);
        $add->link_ar = str_replace(" ","-",$link_ar);      
        $add->text_en = $request->text_en;
        $add->text_ar = $request->text_ar;
        if($request->status){
            $add->status = 1;
        }else{
            $add->status = 0;
        }
        $add->save();
        return redirect('admin/pages')->with('success',trans('home.your_item_added_successfully'));
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
        $page = Page::find($id);
        if($page){
            return view('admin.pages.editPage',compact('page'));
        }else{
            abort('views.404');
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
        $add = Page::find($id);
        $add->title_en=$request->title_en;
        $add->title_ar=$request->title_ar;
        $link_en = str_replace(" ","-",$add->title_en);
        $add->link_en = str_replace(" ","-",$link_en);  
        $link_ar = str_replace(" ","-",$add->title_ar);
        $add->link_ar = str_replace(" ","-",$link_ar);       
        $add->text_en = $request->text_en;
        $add->text_ar = $request->text_ar;
        if($request->status){
            $add->status = 1;
        }else{
            $add->status = 0;
        }
        $add->save();
        return redirect('admin/pages')->with('success',trans('home.your_item_updated_successfully'));
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
            $m = Page::findOrFail($id);
            $m->delete();
        }
    }
}
