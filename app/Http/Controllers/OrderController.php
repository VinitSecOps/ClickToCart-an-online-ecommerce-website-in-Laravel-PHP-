<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Auth;
use Response;

use LaravelDaily\Invoices\Invoice;
use LaravelDaily\Invoices\Classes\Party;
use LaravelDaily\Invoices\Classes\InvoiceItem;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function ViewOrderDetails($id)
    {

        $order = DB::table('orders')
            ->join('users', 'orders.user_id', 'users.id')
            ->select('orders.*', 'users.name', 'users.phone')
            ->where('orders.id', $id)
            ->first();

        $shipping = DB::table('shipping')->where('order_id', $id)->first();

        $details = DB::table('orders_details')
            ->join('products', 'orders_details.product_id', 'products.id')
            ->select('orders_details.*', 'products.product_code', 'products.image_one')
            ->where('order_id', $id)
            ->get();

        return Response::json(array(
            'order' => $order,
            'shipping' => $shipping,
            'details' => $details,
        ));
    }

    public function OrderTracking($status_code)
    {


        $track = DB::table('orders')->where('user_id', Auth::id())->where('status_code', $status_code)->first();

        if ($track) {
            return view('pages.tracking', compact('track'));
        }
    }

    public function Invoice($id)
    {

        // QUERY

        $setting = DB::table('sitesetting')->first();

        $order = DB::table('orders')
                ->join('users','orders.user_id','users.id')
                ->select('orders.*','users.name','users.phone','users.email')
                ->where('orders.id',$id)
                ->first();
        
        $shipping = DB::table('shipping')->where('order_id',$id)->first();
       

        $details = DB::table('orders_details')
                ->join('products','orders_details.product_id','products.id')
                ->select('orders_details.*','products.product_code','products.image_one')
                ->where('order_id',$id)
                ->get();


        // INVOICE 

        $client = new Party([
            'name'          => 'ClickToCart Seller Pvt. Ltd.',
            'phone'         => '1800 3000 9009',
            'custom_fields' => [
                
                'GST Registration No' => '27AAQCS4259Q1ZA',
                'PAN No' => 'AAQCS4259Q',
            ],
        ]);

        $customer = new Party([
            'name'          => $order->name,
            'phone'       => '+91'.$order->phone,
            'custom_fields' => [
                'Name' => $shipping->ship_name,
                'Phone' => '+91'.$shipping->ship_phone,
                'Email' => $shipping->ship_email,
                'Address' => $shipping->ship_address,
                'Country' => $shipping->ship_country,
                'State' => $shipping->ship_state,
                'City' => $shipping->ship_city,
            ],
        ]);

        $total = 0;
        $items = array();
        foreach ($details as $key => $value) {
            $items[$key+1] =  (new InvoiceItem())->title($value->product_name)->pricePerUnit($value->single_price)->quantity($value->quantity);
            $total = floatval($total) + floatval($value->total_price);
        }
        $discount =  (floatval($order->vat) + floatval($order->shipping) + floatval($total)) - floatval($order->total);
        $grand_total = floatval($order->total) + floatval($discount);

        $notes = "Hey ". $order->name." thanks for shopping at ClickToCart Services Pvt. Ltd.";

        $invoice = Invoice::make('Receipt')
            ->dateFormat('d F Y')
            ->seller($client)
            ->buyer($customer)
            ->shipping($order->shipping)
            ->totalTaxes($order->vat)
            ->totalAmount($grand_total)
            ->totalDiscount($discount)
            ->currencySymbol('')
            ->notes($notes)
            ->logo($setting->logo)
            ->addItems($items);

        return $invoice->stream();
    }

    public function SuccessOrderList(){
        $orders = DB::table('orders')->where('user_id',Auth::id())->where('status',3)->orderBy('id','DESC')->paginate(3);
        return view('pages.return_order',compact('orders'));
    }

    public function ReturnOrder($id){
        $orders = DB::table('orders')->where('id',$id)->update(['return_order' => 1]);
        $notification = array(
            'messege' => 'Return requested',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}


