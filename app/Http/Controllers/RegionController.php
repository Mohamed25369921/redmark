<?php

namespace App\Http\Controllers;

use App\Models\Region;
use App\Models\Country;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        //$this->middleware(['permission:regions']);
    }

    public function index()
    {
        //
        $regions = Region::orderBy('id','DESC')->with(['country'])->get();
        return view('admin.regions.regions',compact('regions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $countries = Country::where('status',1)->get();
        return view('admin.regions.addRegion',compact('countries'));
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
        $add = new Region();
        $add->name_en = $request->name_en;
        $add->name_ar = $request->name_ar;
        $add->country_id = $request->country_id;
        $add->available_units = $request->available_units;
        if($request->status){
            $add->status = 1;
        }else{
            $add->status = 0;
        }
        $add->save();
        return redirect('admin/regions')->with('success',trans('home.your_item_added_successfully'));
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
        $region=Region::find($id);
        $countries = Country::where('status',1)->get();
        return view('admin.regions.editRegion',compact('region','countries'));
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
        $add = Region::find($id);
        $add->name_en = $request->name_en;
        $add->name_ar = $request->name_ar;
        $add->country_id = $request->country_id;
        $add->available_units = $request->available_units;
        if($request->status){
            $add->status = 1;
        }else{
            $add->status = 0;
        }
        $add->save();
        return redirect('admin/regions')->with('success',trans('home.your_item_updated_successfully'));
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
            $region = Region::findOrFail($id)->delete();
        }
    }

}
