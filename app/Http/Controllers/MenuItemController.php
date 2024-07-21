<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MenuItem;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Project;
use App\Models\Page;
use App\Http\Controllers\Controller;
use DB;
use App\Models\BlogItem;
use App\Models\BlogCategory;
use App\Models\Service;

class MenuItemController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:menuItem');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $menuItems = MenuItem::orderBy('order','asc')->get();
        return view('admin.menuItems.menuItems',compact('menuItems'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $menus = Menu::where('status',1)->get();
        $menuParents=MenuItem::where('status',1)->get();
        return view('admin.menuItems.addMenuItem',compact('menus','menuParents'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $add = new MenuItem();
        $add -> name_en = $request->name_en;
        $add -> name_ar = $request -> name_ar;
        $add->menu_id = $request->menu_id;
        $add->type = $request->menu_type;
        $add -> link_en = str_replace(array('-',' ','/'),"-",$request -> name_en);
        $add -> link_ar = str_replace(array('-',' ','/'),"-",$request -> name_ar);
        $add->status = $request->status;
        if(isset($request->parent)){
            $add->parent_id = $request->parent;
        }else{
            $add->parent_id = 0;
        }
        $add->order = $request->order;
        $add->meta_keywords = $request->meta_keywords;
        $add->meta_description = $request->meta_description;
        $add->save();
        return redirect()->route('menu-items.index')->with('success',trans('home.your_item_added_successfully'));
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
        $menuItem=MenuItem::find($id);
        
        if($menuItem){       
            $menuParents=MenuItem::where('status',1)->get();
            $menus = Menu::where('status',1)->get();

            if($menuItem->type == 'category'){
                $values = Category::get();
            }elseif($menuItem->type == 'brand'){
                $values = Brand::get();
            }elseif($menuItem->type == 'Page'){
                $values = Page::get();
            }elseif($menuItem->type == 'blog-category'){
                $values = BlogCategory::get();
            }elseif($menuItem->type == 'blog-item'){
                $values = BlogItem::get();
            }elseif($menuItem->type == 'project'){
                $values=Project::get();
            }elseif($menuItem->type == 'service'){
                $values=Service::get();
            }elseif($menuItem->type == 'home' || $menuItem->type == 'about-us' || $menuItem->type == 'contact-us' || $menuItem->type =='board-of-members' || $menuItem->type == 'main-item' ||
            $menuItem->type == 'projects' || $menuItem->type == 'services' || $menuItem->type == 'galleryImages' || $menuItem->type == 'galleryVideos'|| $menuItem->type == 'categories' ||
            $menuItem->type == 'careers' || $menuItem->type == 'training'|| $menuItem->type == 'developers' || $menuItem->type == 'blogs' || $menuItem->type == 'check-certificate'){
                $values=[];
                return view('admin.menuItems.editMenuItem',compact('menus','menuParents','menuItem','values'));
            }elseif($menuItem->type == 'link'){
                $values=[];
                return view('admin.menuItems.editMenuItem',compact('menus','menuParents','menuItem','values'));
            }

            return view('admin.menuItems.editMenuItem',compact('menus','menuParents','menuItem','values'));
        }else{
            abort(404);
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
       
        $add = MenuItem::find($id);
        $add -> name_en = $request->name_en;
        $add -> name_ar = $request -> name_ar;
        $add->menu_id = $request->menu_id;
        $add->type = $request->menu_type;
        $add -> link_en = str_replace(array('-',' ','/'),"-",$request -> name_en);
        $add -> link_ar = str_replace(array('-',' ','/'),"-",$request -> name_ar);
        $add->status = $request->status;
        if(isset($request->parent)){
            $add->parent_id = $request->parent;
        }else{
            $add->parent_id = 0;
        }
        $add->order = $request->order;
        $add->meta_keywords = $request->menu_meta_keywords;
        $add->meta_description = $request->menu_meta_description;
        $add->save();
        return redirect()->route('menu-items.index')->with('success',trans('home.your_item_updated_successfully'));
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
            $m = MenuItem::findOrFail($id);
            $m->delete();
        }
    }


    public function menuTypeValue(){
        $type=$_POST['type'];
        
        if($type == 'category'){
            $categories=Category::where('status',1)->get();
            return response()->json([
                'html' => view('admin.menuItems.menuTypeValues', compact('categories','type'))->render(),
            ]);
        }

        if($type == 'product'){
            $products=Product::where('status',1)->get();
            return response()->json([
                'html' => view('admin.menuItems.menuTypeValues', compact('products','type'))->render(),
            ]);
        }
        
        if($type == 'brand'){
            $brands=Brand::where('status',1)->get();
            return response()->json([
                'html' => view('admin.menuItems.menuTypeValues', compact('brands','type'))->render(),
            ]);
        }
        
        if($type == 'compatible'){
            $compatibles=Compatible::get();
            return response()->json([
                'html' => view('admin.menuItems.menuTypeValues', compact('compatibles','type'))->render(),
            ]);
        }
        
        if($type == 'attribute'){
            $attributes=AttributeValue::get();
            return response()->json([
                'html' => view('admin.menuItems.menuTypeValues', compact('attributes','type'))->render(),
            ]);
        }
        
        if($type == 'pages'){
            $pages=Page::get();
            return response()->json([
                'html' => view('admin.menuItems.menuTypeValues', compact('pages','type'))->render(),
            ]);
        }
        
        if($type == 'link'){
            return response()->json([
                'html' => view('admin.menuItems.menuTypeValues', compact('type'))->render(),
            ]);
        }

        if($type == 'about-us'){
            return response()->json([
                'html' => view('admin.menuItems.menuTypeValues', compact('type'))->render(),
            ]);
        }

        if($type == 'contact-us'){
            return response()->json([
                'html' => view('admin.menuItems.menuTypeValues', compact('type'))->render(),
            ]);
        }

        if($type == 'deals'){
            return response()->json([
                'html' => view('admin.menuItems.menuTypeValues', compact('type'))->render(),
            ]);
        }

        if($type == 'home'){
            return response()->json([
                'html' => view('admin.menuItems.menuTypeValues', compact('type'))->render(),
            ]);
        }

        if($type == 'featured'){
            return response()->json([
                'html' => view('admin.menuItems.menuTypeValues', compact('type'))->render(),
            ]);
        }

        if($type == 'blog-item'){
            $blogItems=BlogItem::get();
            return response()->json([
                'html' => view('admin.menuItems.menuTypeValues', compact('blogItems','type'))->render(),
            ]);
        }

        if($type == 'blog-category'){
            $blogCategories=BlogCategory::get();
            return response()->json([
                'html' => view('admin.menuItems.menuTypeValues', compact('blogCategories','type'))->render(),
            ]);
        }
        
        if($type == 'blogs'){
            return response()->json([
                'html' => view('admin.menuItems.menuTypeValues', compact('type'))->render(),
            ]);
        }
        
        if($type == 'galleryImages'){
            return response()->json([
                'html' => view('admin.menuItems.menuTypeValues', compact('type'))->render(),
            ]);
        }
        
        
        if($type == 'galleryVideos'){
            return response()->json([
                'html' => view('admin.menuItems.menuTypeValues', compact('type'))->render(),
            ]);
        }
        
        if($type == 'main-item'){
            return response()->json([
                'html' => view('admin.menuItems.menuTypeValues', compact('type'))->render(),
            ]);
        }
        
        if($type == 'projects'){
            return response()->json([
                'html' => view('admin.menuItems.menuTypeValues', compact('type'))->render(),
            ]);
        }
        
        if($type == 'project'){
            $projects = Project::get();
            return response()->json([
                'html' => view('admin.menuItems.menuTypeValues', compact('type','projects'))->render(),
            ]);
        }
        
        if($type == 'services'){
            return response()->json([
                'html' => view('admin.menuItems.menuTypeValues', compact('type'))->render(),
            ]);
        }
        
        if($type == 'service'){
            $services = Service::get();
            return response()->json([
                'html' => view('admin.menuItems.menuTypeValues', compact('type','services'))->render(),
            ]);
        }
        
        
    }
}
