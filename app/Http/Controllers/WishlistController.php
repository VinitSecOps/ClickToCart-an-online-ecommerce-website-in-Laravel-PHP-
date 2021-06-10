<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WishlistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function addWishlist($id)
    {

        $user_id = Auth::id();

        $check = DB::table('wishlists')->where('user_id', $user_id)->where('product_id', $id)->first();

        $data = array();
        $data['user_id'] = $user_id;
        $data['product_id'] = $id;

        if (Auth::Check()) {
            if ($check) {

                return \Response::json(['error' => 'Already in your Wishlist']);

            } else {
                $data['created_at'] = Carbon::now();
                DB::table('wishlists')->insert($data);


                return \Response::json(['success' => 'Added to Wishlist']);
            }
        } else {

            return \Response::json(['error' => 'Login into Your Account First']);
        }
    }

    public function Wishlist(){
        $user_id = Auth::id();

        $products = DB::table('wishlists')
                ->join('products','wishlists.product_id','products.id')
                ->select('products.*','wishlists.user_id')
                ->where('user_id', $user_id)->get();

        return view('pages.wihslist',compact('products'));

    }

    public function RemoveWishlist($id){
        $user_id = Auth::id();
        DB::table('wishlists')->where('user_id', $user_id)->where('product_id', $id)->delete();
        $notification = array(
            'messege' => 'Product Removed From your Wishlist',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function RemoveAllWishlist(){
        $user_id = Auth::id();
        DB::table('wishlists')->where('user_id', $user_id)->delete();
        $notification = array(
            'messege' => 'All Products Removed From your Wishlist',
            'alert-type' => 'success'
        );
        return Redirect()->to('/')->with($notification);
    }
}
