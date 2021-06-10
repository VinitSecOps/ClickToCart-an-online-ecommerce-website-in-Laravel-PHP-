<?php

namespace App\Http\Controllers;

use Cart;
use Response;
use Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Cartcontroller extends Controller
{
    public function addToCart($id)
    {


        if (Auth::Check()) {
            $content = Cart::content();
            $ids = [];
            foreach ($content as $row) {
                $ids[] = $row->id;
            }
            if (in_array($id, $ids)) {
                return \Response::json(['error' => 'Already in your Cart']);
            } else {
                $product = DB::table('products')->where('id', $id)->first();

                $data = array();

                if ($product->discount_price == NULL) {
                    $data['id'] = $product->id;
                    $data['name'] = $product->product_name;
                    $data['qty'] = 1;
                    $data['price'] = $product->selling_price;
                    $data['weight'] = 1;
                    $data['options']['image'] = $product->image_one;
                    $data['options']['color'] = '';
                    $data['options']['size'] = '';

                    Cart::add($data);

                    return \Response::json(['success' => 'Added in your Cart']);
                } else {
                    $data['id'] = $product->id;
                    $data['name'] = $product->product_name;
                    $data['qty'] = 1;
                    $data['price'] = $product->discount_price;
                    $data['weight'] = 1;
                    $data['options']['image'] = $product->image_one;
                    $data['options']['color'] = '';
                    $data['options']['size'] = '';

                    Cart::add($data);

                    return \Response::json(['success' => 'Added in your Cart']);
                }
            }
        } else {
            return \Response::json(['error' => 'Login into Your Account First']);
        }
    }

    public function check()
    {
        $content = Cart::content();
        return response()->json($content);
    }

    public function ShowCart()
    {

        $cart = Cart::content();
        return view('pages.cart', compact('cart'));
    }

    public function DestroyCart(){
        Cart::destroy();
        $notification = array(
            'messege' => 'Products successfully Remove from Cart',
            'alert-type' => 'success'
        );
        return Redirect()->to('/')->with($notification);
        
    }

    public function RemoveCart($rowId)
    {
        Cart::remove($rowId);
        $notification = array(
            'messege' => 'Product successfully Remove from Cart',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function UpdateCart(Request $request)
    {
        $rowId = $request->product_id;
        $qty = $request->qty;

        Cart::update($rowId, $qty);
        $notification = array(
            'messege' => 'Product Quantity Updated',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    public function ViewProduct($id)
    {
        $product = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('subcategories', 'products.subcategory_id', 'subcategories.id')
            ->join('brands', 'products.brand_id', 'brands.id')
            ->select('products.*', 'categories.category_name', 'subcategories.subcategory_name', 'brands.brand_name')
            ->where('products.status', 1)
            ->where('products.id', $id)
            ->first();



        $colors = $product->product_color;
        $product_color = explode(",", $colors);

        $sizes = $product->product_size;
        $product_size = explode(",", $sizes);

        return response::json(array(
            'product' => $product,
            'product_color' => $product_color,
            'product_size' => $product_size,
        ));
    }

    public function InsertIntoCart(Request $request)
    {
        $id = $request->product_id;


        $content = Cart::content();
        $ids = [];
        foreach ($content as $row) {
            $ids[] = $row->id;
        }
        if (in_array($id, $ids)) {
            $notification = array(
                'messege' => 'Already in your Cart',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        } else {
            $product = DB::table('products')->where('id', $id)->first();
            $color = $request->color;
            $size = $request->size;
            $qty = $request->qty;

            $data = array();

            if ($product->discount_price == NULL) {
                $data['id'] = $product->id;
                $data['name'] = $product->product_name;
                $data['qty'] = $qty;
                $data['price'] = $product->selling_price;
                $data['weight'] = 1;
                $data['options']['image'] = $product->image_one;
                $data['options']['color'] = $color;
                $data['options']['size'] = $size;

                Cart::add($data);

                $notification = array(
                    'messege' => 'Added in your Cart',
                    'alert-type' => 'success'
                );
                return Redirect()->back()->with($notification);
            } else {
                $data['id'] = $product->id;
                $data['name'] = $product->product_name;
                $data['qty'] = $qty;
                $data['price'] = $product->discount_price;
                $data['weight'] = 1;
                $data['options']['image'] = $product->image_one;
                $data['options']['color'] = $color;
                $data['options']['size'] = $size;

                Cart::add($data);

                $notification = array(
                    'messege' => 'Added in your Cart',
                    'alert-type' => 'success'
                );
                return Redirect()->back()->with($notification);
            }
        }
    }

    public function Checkout()
    {
        if (Auth::Check()) {
            $cart = Cart::content();
            return view('pages.checkout', compact('cart'));
        } else {
            $notification = array(
                'messege' => 'Login into Your Account First',
                'alert-type' => 'error'
            );
            return Redirect()->route('login')->with($notification);
        }
    }

    public function ApplyCoupon(Request $request)
    {
        $coupon = $request->coupon;
        $check = DB::table('coupons')->where('coupon', $coupon)->first();
        if ($check) {
            Session::put('coupon', [
                'name' => $check->coupon,
                'discount' => $check->discount,
                'balance' => Cart::subtotal() - (Cart::subtotal() * $check->discount / 100),
            ]);

            $notification = array(
                'messege' => 'PromoCode Applied',
                'alert-type' => 'success'
            );
            return Redirect()->back()->with($notification);
        } else {
            $notification = array(
                'messege' => 'Invalid PromoCode',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function RemoveCoupon()
    {
        Session::forget('coupon');
        $notification = array(
            'messege' => 'PromoCode Removed',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }

    
}
