<?php

namespace App\Http\Controllers;

use App\Country;
use Illuminate\Http\Request;
use Cart;
use DB;
use Auth;
use Session;
use Illuminate\Validation\Rules\Unique;

class PaymentController extends Controller
{
    public function PaymentPage()
    {
        $cart = Cart::Content();
        $data['countries'] = Country::where("id",'101')->get(["name", "id"]);
        return view('pages.payment', compact('cart','data'));
    }

    public function PaymentProcess(Request $request)
    {

        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|regex:/^[6-9]\d{9}$/|max:10|min:10',
            'email' => 'required|string|email|max:255',
            'address' => 'required|string|max:1000',
        ],
        [
            'phone.regex' => 'Must be 10 Digit',
        ]);

        $data = array();
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['address'] = $request->address;

        $country = DB::table('countries')->where('id',$request->country)->select('name')->first();
        $data['country'] = $country->name; 
        
        $state = DB::table('states')->where('id',$request->state)->select('name')->first();
        $data['state'] = $state->name;

        $city = DB::table('cities')->where('id',$request->city)->select('name')->first();
        $data['city'] = $city->name;

        $data['payment'] = $request->payment;
        //dd($data);

        if ($request->payment == 'stripe') {
            return view('pages.payment.stripe', compact('data'));
        } elseif ($request->payment == 'paypal') {
        } elseif ($request->payment == 'ideal') {
        } else {
            echo "cash on Delivery";
        }
    }

    public function StripeCharge(Request $request)
    {
        //Brazil 4000000760000002
        //Mexico 4000004840008001


        $total = $request->total;
        // Set your secret key. Remember to switch to your live secret key in production.
        // See your keys here: https://dashboard.stripe.com/apikeys
        \Stripe\Stripe::setApiKey('sk_test_51IkmXKSAxR6KhDcNAIC48BmF5OFTeq3nMG8SWFrCyZMaKxkEdgiWdxUhGkSHArPBGv29nKBB6xiGWqo82ouq9SBU00KCLSKgsN');

        // Token is created using Checkout or Elements!
        // Get the payment token ID submitted by the form:
        $token = $_POST['stripeToken'];

        $charge = \Stripe\Charge::create([
            'amount' => $total * 100,
            'currency' => 'inr',
            'description' => 'Payment Done by '.Auth::user()->name.' At ClickToCart',
            'source' => $token,
            'metadata' => ['order_id' => uniqid()],
        ]);

        $data = array();
        $data['user_id'] = Auth::id();
        $data['payment_type'] = $request->payment_type;
        $data['payment_id'] = $charge->payment_method;
        $data['paying_amount'] = $charge->amount;
        $data['balance_transaction'] = $charge->balance_transaction;
        $data['stripe_order_id'] = $charge->metadata->order_id;
        $data['shipping'] = $request->shipping;
        $data['vat'] = $request->vat;
        $data['total'] = $request->total;
        $data['status_code'] = mt_rand(100000,999999);

        if(Session::has('coupon')){
            $data['subtotal'] = Session::get('coupon')['balance'];
        }else{
            $data['subtotal'] = Cart::subtotal();
        }

        $data['status'] = 0;

        $data['date'] = date('d-m-Y');
        $data['month'] = date('F');
        $data['year'] = date('Y');
        $order_id = DB::table('orders')->insertGetId($data);

        // shipping

        $shipping = array();
        $shipping['order_id'] = $order_id;
        $shipping['ship_name'] = $request->ship_name;
        $shipping['ship_phone'] = $request->ship_phone;
        $shipping['ship_email'] = $request->ship_email;
        $shipping['ship_address'] = $request->ship_address;
        $shipping['ship_country'] = $request->ship_country;
        $shipping['ship_state'] = $request->ship_state;
        $shipping['ship_city'] = $request->ship_city;

        DB::table('shipping')->insert($shipping);

        //order details

        $content = Cart::content();
        $details = array();
        
        foreach ($content as $row) {
           $details['order_id'] = $order_id;
           $details['product_id'] = $row->id;
           $details['product_name'] = $row->name;
           $details['color'] = $row->options->color;
           $details['size'] = $row->options->size;
           $details['quantity'] = $row->qty;
           $details['single_price'] = $row->price;
           $details['total_price'] = $row->qty*$row->price;
           DB::table('orders_details')->insert($details);

        }

        

        Cart::destroy();

        if(Session::has('coupon')){
            Session::forget('coupon');
        }

        $notification = array(
            'messege' => 'Order Placed Successfully',
            'alert-type' => 'success'
        );
        return Redirect()->to('/')->with($notification);

    }
}
