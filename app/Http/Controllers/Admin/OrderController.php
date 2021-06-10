<?php

namespace App\Http\Controllers\Admin;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function NewOrder(){
        $orders = DB::table('orders')->where('status',0)->orderBy('id','DESC')->get();
        return view('admin.order.pending',compact('orders'));
    }

    public function ViewOrder($id){
        $order = DB::table('orders')
                ->join('users','orders.user_id','users.id')
                ->select('orders.*','users.name','users.phone')
                ->where('orders.id',$id)
                ->first();
        
        $shipping = DB::table('shipping')->where('order_id',$id)->first();
       

        $details = DB::table('orders_details')
                ->join('products','orders_details.product_id','products.id')
                ->select('orders_details.*','products.product_code','products.image_one')
                ->where('order_id',$id)
                ->get();
        
        return view('admin.order.view_order',compact('order','shipping','details'));

    }

    public function PaymentAccept($id){
        DB::table('orders')->where('id',$id)->update(['status' => 1]);

        $notification = array(
            'messege' => 'Payment Accepted',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.accept.payment')->with($notification);
    }

    public function OrderCancel($id){
        DB::table('orders')->where('id',$id)->update(['status' => 4]);

        $notification = array(
            'messege' => 'Order cancelled',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.cancel.order')->with($notification);

    }

    public function DeliveryProccess($id){
        DB::table('orders')->where('id',$id)->update(['status' => 2]);

        $notification = array(
            'messege' => 'Sent to Delivery',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.process.payment')->with($notification);

    }

    public function DeliveryDone($id){
        $data = array();
        $data['status'] = 3;
        $data['updated_at'] = Carbon::now();
        DB::table('orders')->where('id',$id)->update($data);

        $order_details = DB::table('orders_details')->where('order_id',$id)->get();

        foreach ($order_details as $row) {
            DB::table('products')->where('id',$row->product_id)->update(['product_quantity' => DB::raw('product_quantity-'.$row->quantity)]);
        }

        $notification = array(
            'messege' => 'Product Delivered Successfull',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.success.payment')->with($notification);

    }

    public function AcceptPayment(){
            $orders = DB::table('orders')->where('status',1)->get();
            return view('admin.order.pending',compact('orders'));
    }

    public function CancelOrder(){
            $orders = DB::table('orders')->where('status',4)->get();
            return view('admin.order.pending',compact('orders'));
    }
    
    public function ProcessPayment(){
            $orders = DB::table('orders')->where('status',2)->get();
            return view('admin.order.pending',compact('orders'));
    }
    public function SuccessPayment(){
            $orders = DB::table('orders')->where('status',3)->get();
            return view('admin.order.pending',compact('orders'));
    }
}
