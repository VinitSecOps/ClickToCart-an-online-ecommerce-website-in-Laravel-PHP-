<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        $products = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('subcategories', 'products.subcategory_id', 'subcategories.id')
            ->join('brands', 'products.brand_id', 'brands.id')
            ->select('products.*', 'categories.category_name', 'subcategories.subcategory_name', 'brands.brand_name')
            ->latest()
            ->get();
        return view('admin.product.index', compact('products'));
    }

    public function Create()
    {
        $categories = DB::table('categories')->get();
        $brands = DB::table('brands')->get();
        $colors = DB::table('colors')->get();
        $sizes = DB::table('sizes')->get();
        return view('admin.product.create', compact('categories', 'brands', 'colors', 'sizes'));
    }

    public function GetSubCategory($category_id)
    {
        $subcategories = DB::table('subcategories')->where('category_id', $category_id)->get();
        return json_encode($subcategories);
    }

    public function StoreProduct(Request $request)
    {
        $validate = $request->validate(
            [
                'product_name' => 'required',
                'product_quantity' => 'required|numeric|gt:-1|lt:101',
                'discount_price' => 'nullable|numeric|gt:0|lt:' . $request->selling_price,
                'selling_price' => 'required|numeric',
                'category_id' => 'required',
                'subcategory_id' => 'required',
                'brand_id' => 'required',
                'product_size' => 'required',
                'product_color' => 'required',
                'product_details' => 'required',
                'video_link' => 'nullable|url',
                'image_one' => 'required|mimes:jpg,jpeg,png',
                'image_two' => 'required|mimes:jpg,jpeg,png',
                'image_three' => 'required|mimes:jpg,jpeg,png',
            ],
            [
                'discount_price.lt' => 'The discount price must be less than selling price.',
                'discount_price.gt' => 'The discount price must be greater than 0.',
            ]
        );

        if ($request->discount_price != "") {
            $validate = $request->validate(
                [
                    'selling_price' => 'required|numeric|gt:' . $request->discount_price,
                ],
                [
                    'selling_price.gt' => 'The selling price must be greater than discount price',
                ]
            );
        }

        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_code'] = hexdec(uniqid());
        $data['product_quantity'] = $request->product_quantity;
        $data['discount_price'] = $request->discount_price;
        $data['category_id'] = $request->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_size'] = implode(',', $request->product_size);
        $data['product_color'] = implode(',', $request->product_color);
        $data['selling_price'] = $request->selling_price;
        $data['product_details'] = $request->product_details;
        $data['video_link'] = $request->video_link;
        $data['main_slider'] = $request->main_slider;
        $data['hot_deal'] = $request->hot_deal;
        $data['best_rated'] = $request->best_rated;
        $data['trend'] = $request->trend;
        $data['mid_slider'] = $request->mid_slider;
        $data['hot_new'] = $request->hot_new;
        $data['buyone_getone'] = $request->buyone_getone;
        $data['status'] = 1;

        $image_one = $request->image_one;
        $image_two = $request->image_two;
        $image_three = $request->image_three;

        if ($image_one && $image_two && $image_three) {
            $image_one_name = hexdec(uniqid()) . "." . $image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(300, 300)->save('public/media/product/' . $image_one_name);
            $data['image_one'] = 'public/media/product/' . $image_one_name;


            $image_two_name = hexdec(uniqid()) . "." . $image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(300, 300)->save('public/media/product/' . $image_two_name);
            $data['image_two'] = 'public/media/product/' . $image_two_name;


            $image_three_name = hexdec(uniqid()) . "." . $image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(300, 300)->save('public/media/product/' . $image_three_name);
            $data['image_three'] = 'public/media/product/' . $image_three_name;

            $data['created_at'] = Carbon::now();
            DB::table('products')->insert($data);

            $notification = array(
                'messege' => 'Product Added Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.product')->with($notification);
        }
    }

    public function Inactive($id)
    {
        DB::table('products')->where('id', $id)->update(['status' => 0]);
        $notification = array(
            'messege' => 'Product Successfully Inactive',
            'alert-type' => 'warning'
        );

        return redirect()->back()->with($notification);
    }

    public function Active($id)
    {
        DB::table('products')->where('id', $id)->update(['status' => 1]);
        $notification = array(
            'messege' => 'Product Successfully Active',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DeleteProduct($id)
    {
        $products = DB::table('products')->where('id', $id)->first();

        $image_one = $products->image_one;
        $image_two = $products->image_two;
        $image_three = $products->image_three;

        unlink($image_one);
        unlink($image_two);
        unlink($image_three);

        DB::table('products')->where('id', $id)->delete();
        $notification = array(
            'messege' => 'Product Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function ViewProduct($id)
    {
        $product =  DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('subcategories', 'products.subcategory_id', 'subcategories.id')
            ->join('brands', 'products.brand_id', 'brands.id')
            ->select('products.*', 'categories.category_name', 'subcategories.subcategory_name', 'brands.brand_name')
            ->where('products.id', $id)
            ->first();
        return view('admin.product.show', compact('product'));
    }

    public function EditProduct($id)
    {
        $product = DB::table('products')->where('id', $id)->first();
        return view('admin.product.edit', compact('product'));
    }

    public function UpdateProductWithoutPhoto(Request $request, $id)
    {
        $validate = $request->validate(
            [
                'product_name' => 'required',
                'product_quantity' => 'required|numeric|gt:-1|lt:101',
                'discount_price' => 'nullable|numeric|gt:0|lt:' . $request->selling_price,
                'selling_price' => 'required|numeric',
                'category_id' => 'required',
                'subcategory_id' => 'required',
                'brand_id' => 'required',
                'product_size' => 'required',
                'product_color' => 'required',
                'product_details' => 'required',
                'video_link' => 'nullable|url',
            ],
            [
                'discount_price.lt' => 'The discount price must be less than selling price.',
                'discount_price.gt' => 'The discount price must be greater than 0.',
            ]
        );

        if ($request->discount_price != "") {
            $validate = $request->validate(
                [
                    'selling_price' => 'required|numeric|gt:' . $request->discount_price,
                ],
                [
                    'selling_price.gt' => 'The selling price must be greater than discount price',
                ]
            );
        }

        $data = array();
        $data['product_name'] = $request->product_name;
        $data['product_quantity'] = $request->product_quantity;
        $data['category_id'] = $request->category_id;
        $data['subcategory_id'] = $request->subcategory_id;
        $data['brand_id'] = $request->brand_id;
        $data['product_size'] = implode(',', $request->product_size);
        $data['product_color'] = implode(',', $request->product_color);
        $data['selling_price'] = $request->selling_price;
        $data['discount_price'] = $request->discount_price;
        $data['product_details'] = $request->product_details;
        $data['video_link'] = $request->video_link;
        $data['main_slider'] = $request->main_slider;
        $data['hot_deal'] = $request->hot_deal;
        $data['best_rated'] = $request->best_rated;
        $data['trend'] = $request->trend;
        $data['mid_slider'] = $request->mid_slider;
        $data['hot_new'] = $request->hot_new;
        $data['buyone_getone'] = $request->buyone_getone;

        $update = DB::table('products')->where('id', $id)->update($data);

        if ($update) {
            $data['updated_at'] = Carbon::now();
            $update = DB::table('products')->where('id', $id)->update($data);
            $notification = array(
                'messege' => 'Product Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.product')->with($notification);
        } else {
            $notification = array(
                'messege' => 'Nothing To Update',
                'alert-type' => 'error'
            );
            return redirect()->route('all.product')->with($notification);
        }
    }

    public function UpdateProductWithPhoto(Request $request, $id)
    {

        $old_image_one = $request->old_image_one;
        $old_image_two = $request->old_image_two;
        $old_image_three = $request->old_image_three;

        $data = array();

        $image_one = $request->file('image_one');
        $image_two = $request->file('image_two');
        $image_three = $request->file('image_three');

        $flag = 0;

        if ($image_one) {
            $validate = $request->validate([
                'image_one' => 'mimes:jpg,jpeg,png',
                'image_two' => 'mimes:jpg,jpeg,png',
                'image_three' => 'mimes:jpg,jpeg,png',
            ]);
            unlink($old_image_one);
            $image_one_name = hexdec(uniqid()) . "." . $image_one->getClientOriginalExtension();
            Image::make($image_one)->resize(300, 300)->save('public/media/product/' . $image_one_name);
            $data['image_one'] = 'public/media/product/' . $image_one_name;

            $data['updated_at'] = Carbon::now();
            DB::table('products')->where('id', $id)->update($data);

            $flag = 1;
        }


        if ($image_two) {
            $validate = $request->validate([
                'image_one' => 'mimes:jpg,jpeg,png',
                'image_two' => 'mimes:jpg,jpeg,png',
                'image_three' => 'mimes:jpg,jpeg,png',
            ]);
            unlink($old_image_two);

            $image_two_name = hexdec(uniqid()) . "." . $image_two->getClientOriginalExtension();
            Image::make($image_two)->resize(300, 300)->save('public/media/product/' . $image_two_name);
            $data['image_two'] = 'public/media/product/' . $image_two_name;


            $data['updated_at'] = Carbon::now();
            DB::table('products')->where('id', $id)->update($data);

            $flag = 1;
        }


        if ($image_three) {
            $validate = $request->validate([
                'image_one' => 'mimes:jpg,jpeg,png',
                'image_two' => 'mimes:jpg,jpeg,png',
                'image_three' => 'mimes:jpg,jpeg,png',
            ]);
            unlink($old_image_three);

            $image_three_name = hexdec(uniqid()) . "." . $image_three->getClientOriginalExtension();
            Image::make($image_three)->resize(300, 300)->save('public/media/product/' . $image_three_name);
            $data['image_three'] = 'public/media/product/' . $image_three_name;

            $data['updated_at'] = Carbon::now();
            DB::table('products')->where('id', $id)->update($data);
        }

        if ($flag == 1) {
            $notification = array(
                'messege' => 'Product Image Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.product')->with($notification);
        } else {
            $notification = array(
                'messege' => 'Nothing To Update',
                'alert-type' => 'error'
            );
            return redirect()->route('all.product')->with($notification);
        }
    }
}
