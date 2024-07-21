<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Setting;
use File;
use Image;
use Excel;
use App\Models\Certificate;
use App\Imports\CertificateImport;
class SettingController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('permission:setting');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $settings =Setting::first();
        return view('admin.settings.setting',compact('settings'));
    }

    public function update(Request $request, $id)
    {
        $settings=Setting::first();
        $settings->default_lang = $request->default_lang;
        $settings->contact_email = $request->contact_email;
        $settings->email = $request->email;
        $settings->telphone = $request->telphone;
        $settings->mobile = $request->mobile;
        $settings->fax = $request->fax;
        $settings->facebook = $request->facebook;
        $settings->linkedin = $request->linkedin;
        $settings->instgram = $request->instgram;
        $settings->twitter = $request->twitter;
        $settings->lat = $request->lat;
        $settings->lng = $request->lng;
        $settings->map_url = $request->map_url;
        $settings->whatsapp = $request->whatsapp;
        $settings->snapchat = $request->snapchat;
        $settings->tiktok = $request->tiktok;
        $settings->youtube = $request->youtube;
        $settings->cetificates = $request->cetificates;
        $settings->exp_years = $request->exp_years;
        $settings->surgeries = $request->surgeries;
        $settings->consult = $request->consult;
        $settings->gtm_script = $request->gtm_script;
        $settings->gtm_noscript = $request->gtm_noscript;
        $settings->publish_gtm_script = $request->publish_gtm_script;
        $settings->publish_contact_modal = $request->publish_contact_modal;
        
                
        if ($request->hasFile("about_banner")) {

            $file = $request->file("about_banner");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = base_path() . '/uploads/settings/source/';
            $img_path200 = base_path() . '/uploads/settings/resize200/';
            $img_path800 = base_path() . '/uploads/settings/resize800/';

            if ($settings->about_banner != null) {
                unlink(sprintf($img_path . '%s', $settings->about_banner));
                unlink(sprintf($img_path200 . '%s', $settings->about_banner));
                unlink(sprintf($img_path800 . '%s', $settings->about_banner));
            }

            // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/settings/source/' . $fileName);
            $resize200 = base_path('uploads/settings/resize200/' . $fileName);
            $resize800 = base_path('uploads/settings/resize800/' . $fileName);
            //  $file->move($destinationPath, $fileName);

            $img =Image::make($file->getRealPath());
            $img->save($path);

            $arrayimage = list($width, $height) = getimagesize($file->getRealPath());
            $widthreal = $arrayimage['0'];
            $heightreal = $arrayimage['1'];

            $width200 = ($widthreal / $heightreal) * 150;
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

            $settings->about_banner = $fileName;
        }
        
        if ($request->hasFile("contact_banner")) {

            $file = $request->file("contact_banner");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = base_path() . '/uploads/settings/source/';
            $img_path200 = base_path() . '/uploads/settings/resize200/';
            $img_path800 = base_path() . '/uploads/settings/resize800/';

            if ($settings->contact_banner != null) {
                unlink(sprintf($img_path . '%s', $settings->contact_banner));
                unlink(sprintf($img_path200 . '%s', $settings->contact_banner));
                unlink(sprintf($img_path800 . '%s', $settings->contact_banner));
            }

            // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/settings/source/' . $fileName);
            $resize200 = base_path('uploads/settings/resize200/' . $fileName);
            $resize800 = base_path('uploads/settings/resize800/' . $fileName);
            //  $file->move($destinationPath, $fileName);

            $img =Image::make($file->getRealPath());
            $img->save($path);

            $arrayimage = list($width, $height) = getimagesize($file->getRealPath());
            $widthreal = $arrayimage['0'];
            $heightreal = $arrayimage['1'];

            $width200 = ($widthreal / $heightreal) * 150;
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

            $settings->contact_banner = $fileName;
        }
        
        if ($request->hasFile("blogs_banner")) {

            $file = $request->file("blogs_banner");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = base_path() . '/uploads/settings/source/';
            $img_path200 = base_path() . '/uploads/settings/resize200/';
            $img_path800 = base_path() . '/uploads/settings/resize800/';

            if ($settings->blogs_banner != null) {
                unlink(sprintf($img_path . '%s', $settings->blogs_banner));
                unlink(sprintf($img_path200 . '%s', $settings->blogs_banner));
                unlink(sprintf($img_path800 . '%s', $settings->blogs_banner));
            }

            // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/settings/source/' . $fileName);
            $resize200 = base_path('uploads/settings/resize200/' . $fileName);
            $resize800 = base_path('uploads/settings/resize800/' . $fileName);
            //  $file->move($destinationPath, $fileName);

            $img =Image::make($file->getRealPath());
            $img->save($path);

            $arrayimage = list($width, $height) = getimagesize($file->getRealPath());
            $widthreal = $arrayimage['0'];
            $heightreal = $arrayimage['1'];

            $width200 = ($widthreal / $heightreal) * 150;
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

            $settings->blogs_banner = $fileName;
        }
        
        if ($request->hasFile("certificate_banner")) {

            $file = $request->file("certificate_banner");
            $mime = File::mimeType($file);
            $mimearr = explode('/', $mime);

            $img_path = base_path() . '/uploads/settings/source/';
            $img_path200 = base_path() . '/uploads/settings/resize200/';
            $img_path800 = base_path() . '/uploads/settings/resize800/';

            if ($settings->certificate_banner != null) {
                unlink(sprintf($img_path . '%s', $settings->certificate_banner));
                unlink(sprintf($img_path200 . '%s', $settings->certificate_banner));
                unlink(sprintf($img_path800 . '%s', $settings->certificate_banner));
            }

            // $destinationPath = base_path() . '/uploads/'; // upload path
            $extension = $mimearr[1]; // getting file extension
            $fileName = rand(11111, 99999) . '.' . $extension; // renameing image
            $path = base_path('uploads/settings/source/' . $fileName);
            $resize200 = base_path('uploads/settings/resize200/' . $fileName);
            $resize800 = base_path('uploads/settings/resize800/' . $fileName);
            //  $file->move($destinationPath, $fileName);

            $img =Image::make($file->getRealPath());
            $img->save($path);

            $arrayimage = list($width, $height) = getimagesize($file->getRealPath());
            $widthreal = $arrayimage['0'];
            $heightreal = $arrayimage['1'];

            $width200 = ($widthreal / $heightreal) * 150;
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

            $settings->certificate_banner = $fileName;
        }
        
        $settings->save();

        return back()->with('success',trans('home.settings_updated_successfully'));
    }
    
    public function certificateExcelView(){
        $records = Certificate::get();
        return view('admin.settings.certificateExcel',compact('records'));
    }

    public function saveCertificateRecords(Request $request){
        
        $this->validate($request,[
            'excel_file' => 'required|mimes:xlsx'
        ]);
        Excel::import(new CertificateImport, $request->excel_file);
        return back()->with('success',trans('home.imported_successfully'));
    }


}
