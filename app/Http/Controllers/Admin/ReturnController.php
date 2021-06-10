<?php

namespace App\Http\Controllers\Admin;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReturnController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function ReturnRequest(){
        $orders = DB::table('orders')->where('return_order',1)->get();
        return view('admin.return_order.new_request',compact('orders'));
    }

    public function AllRequest(){
        $orders = DB::table('orders')->where('return_order',2)->get();
        return view('admin.return_order.all_request',compact('orders'));
    }

    public function RequestApprove($id){
        DB::table('orders')->where('id',$id)->update(['return_order' => 2]);
        $notification = array(
            'messege' => 'Request approved',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }
}
