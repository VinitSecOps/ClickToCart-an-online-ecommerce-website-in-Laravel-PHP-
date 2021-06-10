<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SeoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $seo = DB::table('seo')->first();

        return view('admin.seo.index',compact('seo'));
    }

    public function Update(Request $request){

        $validate = $request->validate([
            'meta_title' => 'required|string|max:255',
            'meta_author' => 'required|string|max:255',
            'meta_tag' => 'required|string|max:255',
            'meta_description' => 'required|string',
            'google_analytics' => 'required|string',
            'bing_analytics' => 'required|string',
        ]);

        $id = $request->id;

        $data = array();
        $data['meta_title'] = $request->meta_title;
        $data['meta_author'] = $request->meta_author;
        $data['meta_tag'] = $request->meta_tag;
        $data['meta_description'] = $request->meta_description;
        $data['google_analytics'] = $request->google_analytics;
        $data['bing_analytics'] = $request->bing_analytics;

        DB::table('seo')->where('id',$id)->update($data);

        $notification = array(
            'messege' => 'SEO Setting Updated',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
