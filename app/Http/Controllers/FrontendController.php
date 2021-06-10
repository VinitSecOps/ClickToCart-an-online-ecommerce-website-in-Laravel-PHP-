<?php

namespace App\Http\Controllers;
use Validator;
use Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class FrontendController extends Controller
{
    public function StoreNewsletter(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'email' => 'required|unique:newsletter|max:55',
            ],
            [
                'email.unique' => 'Congratulations! you have already been subscribed',
            ]
        );
        if (!$validator->passes()) {
            return response()->json(['status' => 0, 'error' => $validator->errors()->toArray()]);
        } else {
            $data = array();
            $data['email'] = $request->email;
            $data['created_at'] = Carbon::now();
            DB::table('newsletter')->insert($data);
    
            return response()->json(['status' => 1, 'msg'=>'Thanks for Subscribing', 'type' => 'success']);
        }
    }

    public function Unsubscribe($email){
        DB::table('newsletter')->where('email',$email)->delete();
        $notification = array(
            'messege' => 'Unsubscribed from ClickToCart',
            'alert-type' => 'warning'
        );
        return Redirect()->back()->with($notification);
    }


    
   

    public function ProductSearch(Request $request){
    
        $item = $request->search;
        $sort = $request->sort;
  
        $min =  $request->min;
        $max = $request->max;
       
        if ($sort == "name") {


            if(isset($min) || isset($max)){
                $products = DB::table('products')->where('status', 1)->where('product_name','LIKE',"%$item%")->whereRaw(('case 
                                                                                                                        WHEN discount_price IS NULL THEN selling_price >= '.$min.' AND selling_price <= '.$max.'
                                                                                                                        WHEN discount_price IS NOT NULL THEN discount_price >= '.$min.' AND discount_price <= '.$max.'
                                                                                                                        END'))
                                                                                                                        ->orderBy('product_name','ASC')
                    ->paginate(15);
                    
            }else{
                $products = DB::table('products')->where('status', 1)->where('product_name','LIKE',"%$item%")->orderBy('product_name','ASC')->paginate(15);
            }
        }


        if ($sort == "low") {

            if(isset($min) || isset($max)){
                    $products = DB::table('products')->where('status', 1)->where('product_name','LIKE',"%$item%")->whereRaw(('case 
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
                        $products = DB::table('products')->where('status', 1)->where('product_name','LIKE',"%$item%")->orderByRaw(
                            "CASE
                                WHEN discount_price IS NOT NULL THEN discount_price
                                WHEN discount_price IS NULL THEN selling_price
                                END ASC"
                        )->paginate(15);
                   }
        }

        if ($sort == "high") {

           

                if(isset($min) || isset($max)){
                    $products = DB::table('products')->where('status', 1)->where('product_name','LIKE',"%$item%")->whereRaw(('case 
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
                        $products = DB::table('products')->where('status', 1)->where('product_name','LIKE',"%$item%")->orderByRaw(
                            "CASE
                                WHEN discount_price IS NOT NULL THEN discount_price
                                WHEN discount_price IS NULL THEN selling_price
                                END DESC"
                        )->paginate(15);
                   }
            
        }
        return view('pages.search',compact('products','item'));
    }

    

    public function SearchData(Request $request){

       

            $item = $request->terms;
            $data = array();
            $products = DB::table('products')->where('product_name','LIKE',"%$item%")->select('product_name')->limit(10)->get();

            foreach ($products as  $value) {
                $data[] = $value->product_name;
            }
            
            return response()->json($data);
        
    
       
    }

    public function Disclaimer (){
        $setting = DB::table('sitesetting')->first();
        return view('pages.t&c.disclaimer',compact('setting'));
    }
    public function Policy (){
        $setting = DB::table('sitesetting')->first();
        return view('pages.t&c.policy',compact('setting'));
    }
    public function Safe (){
        $setting = DB::table('sitesetting')->first();
        return view('pages.t&c.safe',compact('setting'));
    }
    public function Terms (){
        $setting = DB::table('sitesetting')->first();
        return view('pages.t&c.terms',compact('setting'));
    }
    public function About (){
        return view('pages.about');
    }


    
}
