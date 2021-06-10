<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class BlogController extends Controller
{
    public function Blog(){
        $posts = DB::table('posts')
                ->join('post_category','posts.category_id','post_category.id')
                ->select('posts.*','post_category.category_name_english','post_category.category_name_hindi','post_category.category_name_gujarati')
                ->get();
        return view('pages.blog',compact('posts'));
    }

    public function English(){
        Session::get('lang');
        Session()->forget('lang');
        Session::put('lang','english');
        return redirect()->back();
        
    }

    public function Hindi(){
        Session::get('lang');
        Session()->forget('lang');
        Session::put('lang','hindi');
        return redirect()->back();
    }

    public function Gujarati(){
        Session::get('lang');
        Session()->forget('lang');
        Session::put('lang','gujarati');
        return redirect()->back();
    }

    public function BlogSingle($id){
        $posts = DB::table('posts')->where('id',$id)->get();
        return view('pages.blog_single',compact('posts'));
    }
}
