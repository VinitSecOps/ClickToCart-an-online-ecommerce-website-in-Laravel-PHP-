<?php

namespace App\Http\Controllers;

use Auth;
use Cart;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\PaginatedResourceResponse;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function ProductView($id)
    {
        $product = DB::table('products')
            ->join('categories', 'products.category_id', 'categories.id')
            ->join('subcategories', 'products.subcategory_id', 'subcategories.id')
            ->join('brands', 'products.brand_id', 'brands.id')
            ->select('products.*', 'categories.category_name', 'subcategories.subcategory_name', 'brands.brand_name')
            ->where('status', 1)
            ->where('products.id', $id)
            ->first();
        $colors = $product->product_color;
        $product_color = explode(",", $colors);

        $sizes = $product->product_size;
        $product_size = explode(",", $sizes);
        return view('pages.product_detail', compact('product', 'product_color', 'product_size'));
    }

    public function AddCart(Request $request, $id)
    {
        if (Auth::Check()) {
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

                $data = array();

                if ($product->discount_price == NULL) {
                    $data['id'] = $product->id;
                    $data['name'] = $product->product_name;
                    $data['qty'] = $request->qty;
                    $data['price'] = $product->selling_price;
                    $data['weight'] = 1;
                    $data['options']['image'] = $product->image_one;
                    $data['options']['color'] = $request->color;
                    $data['options']['size'] = $request->size;

                    Cart::add($data);

                    $notification = array(
                        'messege' => 'Added in your Cart!',
                        'alert-type' => 'success'
                    );
                    return Redirect()->back()->with($notification);
                } else {
                    $data['id'] = $product->id;
                    $data['name'] = $product->product_name;
                    $data['qty'] = $request->qty;
                    $data['price'] = $product->discount_price;
                    $data['weight'] = 1;
                    $data['options']['image'] = $product->image_one;
                    $data['options']['color'] = $request->color;
                    $data['options']['size'] = $request->size;

                    Cart::add($data);

                    $notification = array(
                        'messege' => 'Added in your Cart!',
                        'alert-type' => 'success'
                    );
                    return Redirect()->back()->with($notification);
                }
            }
        } else {
            $notification = array(
                'messege' => 'Login into Your Account First!',
                'alert-type' => 'error'
            );
            return Redirect()->back()->with($notification);
        }
    }

    public function ProductsView($id, $sort = null,Request $request)
    {
        $subcategory_name = DB::table('subcategories')->where('id', $id)->first();

        $min =  $request->min;
        $max = $request->max;
        
        
        if ($sort == "name") {


            if(isset($min) || isset($max)){
                $products = DB::table('products')->where('status', 1)->where('subcategory_id', $id)->whereRaw(('case 
                                                                                                                        WHEN discount_price IS NULL THEN selling_price >= '.$min.' AND selling_price <= '.$max.'
                                                                                                                        WHEN discount_price IS NOT NULL THEN discount_price >= '.$min.' AND discount_price <= '.$max.'
                                                                                                                        END'))
                                                                                                                        ->orderBy('product_name','ASC')
                    ->paginate(15);
                    
            }else{
                $products = DB::table('products')->where('status', 1)->where('subcategory_id', $id)->orderBy('product_name','ASC')->paginate(15);
            }
        }


        if ($sort == "low") {

            if(isset($min) || isset($max)){
                    $products = DB::table('products')->where('status', 1)->where('subcategory_id', $id)->whereRaw(('case 
                                                                                                                            WHEN discount_price IS NULL THEN selling_price >= '.$min.' AND selling_price <= '.$max.'
                                                                                                                            WHEN discount_price IS NOT NULL THEN discount_price >= '.$min.' AND discount_price <= '.$max.'
                                                                                                                            END'))
                    ->orderByRaw(
                        "CASE
                            WHEN discount_price IS NOT NULL THEN discount_price
                            WHEN discount_price IS NULL THEN selling_price
                            END ASC"
                        )->paginate(15);
                       
                   }else{
                        $products = DB::table('products')->where('status', 1)->where('subcategory_id', $id)->orderByRaw(
                            "CASE
                                WHEN discount_price IS NOT NULL THEN discount_price
                                WHEN discount_price IS NULL THEN selling_price
                                END ASC"
                        )->paginate(15);
                   }
        }

        if ($sort == "high") {

           

                if(isset($min) || isset($max)){
                    $products = DB::table('products')->where('status', 1)->where('subcategory_id', $id)->whereRaw(('case 
                                                                                                                            WHEN discount_price IS NULL THEN selling_price >= '.$min.' AND selling_price <= '.$max.'
                                                                                                                            WHEN discount_price IS NOT NULL THEN discount_price >= '.$min.' AND discount_price <= '.$max.'
                                                                                                                            END'))
                    ->orderByRaw(
                        "CASE
                            WHEN discount_price IS NOT NULL THEN discount_price
                            WHEN discount_price IS NULL THEN selling_price
                            END DESC"
                        )->paginate(15);
                       
                   }else{
                        $products = DB::table('products')->where('status', 1)->where('subcategory_id', $id)->orderByRaw(
                            "CASE
                                WHEN discount_price IS NOT NULL THEN discount_price
                                WHEN discount_price IS NULL THEN selling_price
                                END DESC"
                        )->paginate(15);
                   }
            
        }

        $categories = DB::table('categories')->get();

        $brands = DB::table('products')->where('subcategory_id', $id)->select('brand_id')->groupBy('brand_id')->get();

        return view('pages.all_products', compact('products', 'categories', 'brands', 'subcategory_name'));
    }

    public function CategoryView($id, $sort = null,Request $request)
    {

        $min =  $request->min;
        $max = $request->max;
        
        // By name
        if ($sort == "name") {
            $category_name = DB::table('categories')->where('id', $id)->first();
            $categories_all = DB::table('products')->where('status', 1)->where('category_id', $id)->orderBy('product_name','ASC')->paginate(10);

            if(isset($min) || isset($max)){
                $categories_all = DB::table('products')->where('status', 1)->where('category_id', $id)->whereRaw(('case 
                                                                                                                        WHEN discount_price IS NULL THEN selling_price >= '.$min.' AND selling_price <= '.$max.'
                                                                                                                        WHEN discount_price IS NOT NULL THEN discount_price >= '.$min.' AND discount_price <= '.$max.'
                                                                                                                        END'))
                                                                                                                        ->orderBy('product_name','ASC')
                    ->paginate(15);
                   
               }else{
                    $categories_all = DB::table('products')->where('status', 1)->where('category_id', $id)->orderBy('product_name','ASC')->paginate(15);
               }

            return view('pages.all_category', compact('categories_all', 'category_name'));
        }

        // Low to High
        if ($sort == "low") {
            $category_name = DB::table('categories')->where('id', $id)->first();
            
           

           if(isset($min) || isset($max)){
            $categories_all = DB::table('products')->where('status', 1)->where('category_id', $id)->whereRaw(('case 
                                                                                                                    WHEN discount_price IS NULL THEN selling_price >= '.$min.' AND selling_price <= '.$max.'
                                                                                                                    WHEN discount_price IS NOT NULL THEN discount_price >= '.$min.' AND discount_price <= '.$max.'
                                                                                                                    END'))
            ->orderByRaw(
                "CASE
                    WHEN discount_price IS NOT NULL THEN discount_price
                    WHEN discount_price IS NULL THEN selling_price
                    END ASC"
                )->paginate(15);
               
           }else{
                $categories_all = DB::table('products')->where('status', 1)->where('category_id', $id)->orderByRaw(
                    "CASE
                        WHEN discount_price IS NOT NULL THEN discount_price
                        WHEN discount_price IS NULL THEN selling_price
                        END ASC"
                )->paginate(15);
           }

            return view('pages.all_category', compact('categories_all', 'category_name'));
        }

        // High to Low
        if ($sort == "high") {
            $category_name = DB::table('categories')->where('id', $id)->first();

            if(isset($min) || isset($max)){
                $categories_all = DB::table('products')->where('status', 1)->where('category_id', $id)->whereRaw(('case 
                                                                                                                        WHEN discount_price IS NULL THEN selling_price >= '.$min.' AND selling_price <= '.$max.'
                                                                                                                        WHEN discount_price IS NOT NULL THEN discount_price >= '.$min.' AND discount_price <= '.$max.'
                                                                                                                        END'))
                ->orderByRaw(
                    "CASE
                        WHEN discount_price IS NOT NULL THEN discount_price
                        WHEN discount_price IS NULL THEN selling_price
                        END DESC"
                    )->paginate(15);
                   
               }else{
                    $categories_all = DB::table('products')->where('status', 1)->where('category_id', $id)->orderByRaw(
                        "CASE
                            WHEN discount_price IS NOT NULL THEN discount_price
                            WHEN discount_price IS NULL THEN selling_price
                            END DESC"
                    )->paginate(15);
               }

            return view('pages.all_category', compact('categories_all', 'category_name'));
        }
      
    }
}
