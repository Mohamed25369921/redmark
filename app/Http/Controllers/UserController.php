<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\User;
use DB;
use File;
use Illuminate\Support\Str;
use Image;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    
    public function __construct()
    {
        //$this->middleware('permission:user');
    }
    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $users = User::all();
        return view('admin.users.users',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $roles = Role::get();
        return view('admin.users.addUser',compact('roles'));
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
        $token = Str::random(80);
        $add = new User();

        $add->f_name = $request->f_name;
        $add->l_name = $request->l_name;
        $add->email = $request->email;
        $add->phone = $request->phone;
        $add->password = bcrypt($request->password);
        $add->remember_token = $token;
        $add->is_admin = $request->admin;

        if ($request->hasFile("image")) {

            $file = $request->file("image");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/users/source/' . $fileName);
            $resize200 = base_path('uploads/users/resize200/' . $fileName);
            $resize800 = base_path('uploads/users/resize800/' . $fileName);
            //  $file->move($destinationPath, $fileName);

            Image::make($file->getRealPath())->save($path);

            $arrayimage = list($width, $height) = getimagesize($file->getRealPath());
            $widthreal = $arrayimage['0'];
            $heightreal = $arrayimage['1'];

            $width200 = ($widthreal / $heightreal) * 200;
            $height200 = $width200 / ($widthreal / $heightreal);

            $img200 = Image::canvas($width200, $height200);
            $image200 = Image::make($file->getRealPath())->resize($width200, $height200, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $img200->insert($image200, 'center');
            $img200->save($resize200);

            $width800 = ($widthreal / $heightreal) * 800;
            $height800 = $width800 / ($widthreal / $heightreal);

            $img800 = Image::canvas($width800, $height800);
            $image800 = Image::make($file->getRealPath())->resize($width800, $height800, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $img800->insert($image800, 'center');
            $img800->save($resize800);

            $add->image = $fileName;
        }

        $add->save();

        if ($request->role){
            $roles=$request->role;
            foreach ($roles as $role) {
                $add->assignRole($role);
            }
        }

        return redirect('admin/users')->with('success',trans('home.your_item_added_successfully'));
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
        $user = User::find($id);
        $user->admin_seen =1;
        $user->save();
        $roles = Role::get();
        $userRoles = $user->roles ->pluck('name') ->toArray();
        return view('admin.users.editUser',compact('user','roles','userRoles'));
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
        $update = User::find($id);
        $update->is_admin = $request->admin;
        $update->f_name = $request->f_name;
        $update->l_name = $request->l_name;
        $update->email = $request->email;
        $update->phone = $request->phone;
        if ($request->password) {
            $update->password = bcrypt($request->password);
        }

        if ($request->hasFile("image")) {

            $file = $request->file("image");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = base_path() . '/uploads/users/source/';
            $img_path200 = base_path() . '/uploads/users/resize200/';
            $img_path800 = base_path() . '/uploads/users/resize800/';

            if ($update->image != null) {
                unlink(sprintf($img_path . '%s', $update->image));
                unlink(sprintf($img_path200 . '%s', $update->image));
                unlink(sprintf($img_path800 . '%s', $update->image));
            }
            // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/users/source/' . $fileName);
            $resize200 = base_path('uploads/users/resize200/' . $fileName);
            $resize800 = base_path('uploads/users/resize800/' . $fileName);
            //  $file->move($destinationPath, $fileName);

            Image::make($file->getRealPath())->save($path);

            $arrayimage = list($width, $height) = getimagesize($file->getRealPath());
            $widthreal = $arrayimage['0'];
            $heightreal = $arrayimage['1'];

            $width200 = ($widthreal / $heightreal) * 200;
            $height200 = $width200 / ($widthreal / $heightreal);

            $img200 = Image::canvas($width200, $height200);
            $image200 = Image::make($file->getRealPath())->resize($width200, $height200, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $img200->insert($image200, 'center');
            $img200->save($resize200);

            $width800 = ($widthreal / $heightreal) * 800;
            $height800 = $width800 / ($widthreal / $heightreal);

            $img800 = Image::canvas($width800, $height800);
            $image800 = Image::make($file->getRealPath())->resize($width800, $height800, function ($c) {
                $c->aspectRatio();
                $c->upsize();
            });
            $img800->insert($image800, 'center');
            $img800->save($resize800);

            $update->image = $fileName;
        }

        $update->save();

       DB::table('model_has_roles')->where('model_id',$id)->delete();

        if ($request->role){
            $roles=$request->role;
            foreach ($roles as $role) {
                $update->assignRole($role);
            }
        }
        return redirect('admin/users')->with('success',trans('home.your_item_updated_successfully'));
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
            $user = User::findOrFail($id);
            $user->delete();
        }
    }
}
