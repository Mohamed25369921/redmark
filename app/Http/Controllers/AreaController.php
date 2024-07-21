<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Area;
use Illuminate\Http\Request;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        //$this->middleware(['permission:areas']);
    }

    public function index()
    {
        //
        $areas = Area::orderBy('id','DESC')->with(['region'])->get();
        return view('admin.areas.areas',compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $regions = Region::where('status',1)->get();
        return view('admin.areas.addArea',compact('regions'));
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
        $add = new Area();
        $add->name_en = $request->name_en;
        $add->name_ar = $request->name_ar;
        $add->region_id = $request->region_id;
        $add->available_beranche = $request->available_beranche;
        $add->shipping_fees = $request->shipping_fees;
         
        if($request->status){
            $add->status = 1;
        }else{
            $add->status = 0;
        }
        $add->save();
        return redirect('admin/areas')->with('success',trans('home.your_item_added_successfully'));
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
        $area=Area::find($id);
        if($area){
            $regions = Region::where('status',1)->get();
            return view('admin.areas.editArea',compact('regions','area'));
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
        $add = Area::find($id);
        $add->name_en = $request->name_en;
        $add->name_ar = $request->name_ar;
        $add->region_id = $request->region_id;
        $add->available_beranche = $request->available_beranche;
        $add->shipping_fees = $request->shipping_fees;
        if($request->status){
            $add->status = 1;
        }else{
            $add->status = 0;
        }
        $add->save();
        return redirect('admin/areas')->with('success',trans('home.your_item_updated_successfully'));
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
            $area = Area::findOrFail($id)->delete();
        }
    }

}
