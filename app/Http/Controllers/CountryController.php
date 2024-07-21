<?php

namespace App\Http\Controllers;

use App\Models\Country;
use File;
use Image;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct(){
        //$this->middleware(['permission:countries']);
    }

    public function index()
    {
        //
        $countries = Country::orderBy('id','DESC')->get();
        return view('admin.countries.countries',compact('countries'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.countries.addCountry');
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
        $add = new Country();
        $add->name_en = $request->name_en;
        $add->name_ar = $request->name_ar;
        if($request->status){
            $add->status = 1;
        }else{
            $add->status = 0;
        }
        $add->save();
        return redirect('admin/countries')->with('success',trans('home.your_item_added_successfully'));
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
        $country=Country::find($id);
        return view('admin.countries.editCountry',compact('country'));
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
        $add = Country::find($id);
        $add->name_en = $request->name_en;
        $add->name_ar = $request->name_ar;
        if($request->status){
            $add->status = 1;
        }else{
            $add->status = 0;
        }
        
        $add->save();
        return redirect('admin/countries')->with('success',trans('home.your_item_updated_successfully'));
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
            $country = Country::findOrFail($id)->delete();
        }
    }
}
