<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use App\Models\NewsLetter;


class NewsLetterController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:newsLetter');
    }

    public function index()
    {
        $newsLetters = NewsLetter::orderBy('id','asc')->get();
        return view('admin.newsLetters.newsLetters',compact('newsLetters'));
    }

    
    public function sendEmail($ids){
        $ids = explode(',', $ids);
        if ($ids[0] == 'on') {
            unset($ids[0]);
        }
        foreach ($ids as $id) {
            $m = MenuItem::findOrFail($id);
            $m->delete();
        }
    }

}
