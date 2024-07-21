<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Address;
use DB;
use File;
use Image;

class AddressController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:address');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $addresses = Address::get();
        return view('admin.addresses.addresses',compact('addresses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.addresses.addAddress');
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
        $add = new Address();
        $add->address_en = $request->address_en;
        $add->address_ar = $request->address_ar;
        $add->map_url = $request->map_url;
        $add->status = $request->status;
        $add->save();
        return redirect()->route('addresses.index')->with('success',trans('home.your_item_updated_successfully'));
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
        $address = Address::find($id);
        if($address){
            return view('admin.addresses.editAddress',compact('address'));
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
        $add = Address::find($id);
        $add->address_en = $request->address_en;
        $add->address_ar = $request->address_ar;
        $add->map_url = $request->map_url;
        $add->status = $request->status;
        $add->save();
        return redirect()->route('addresses.index')->with('success',trans('home.your_item_updated_successfully'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($lang,$ids)
    {
        $ids = explode(',', $ids);
        if ($ids[0] == 'on') {
            unset($ids[0]);
        }
        foreach ($ids as $id) {
            $address = Address::findOrFail($id);
            $address->delete();
        }
    }
}
