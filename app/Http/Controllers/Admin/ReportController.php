<?php

namespace App\Http\Controllers\Admin;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function TodayOrder(){
        $today = date('d-m-Y');
        $orders = DB::table('orders')->where('status',0)->where('date',$today)->get();
        return view('admin.report.today_order',compact('orders'));
    }

    public function TodayDelivery(){
        $today = date('d-m-Y');
        $orders = DB::table('orders')->where('status',3)->where('date',$today)->get();
        return view('admin.report.today_delivery',compact('orders'));
    }

    public function ThisMonth(){
        $month = date('F');
        $orders = DB::table('orders')->where('status',3)->where('month',$month)->get();
        return view('admin.report.this_month',compact('orders'));
    }

    public function Search(){
        return view('admin.report.search');
    }

    public function SearchByYear(Request $request){
        $validateData = $request->validate([
            'year' => 'required|string'
        ]);
        $year =  $request->year;
        $total = DB::table('orders')->where('status',3)->where('year',$year)->sum('total');
        $orders = DB::table('orders')->where('status',3)->where('year',$year)->get();
        return view('admin.report.search_year',compact('orders','total','year'));
    }

    public function SearchByMonth(Request $request){
        $validateData = $request->validate([
            'month' => 'required|string'
        ]);
        $data =  $request->month;
        $month =  date("F", mktime(0, 0, 0, substr($data,5)));
        $year =  substr($data,0,4);
        $total = DB::table('orders')->where('status',3)->where('month',$month)->where('year',$year)->sum('total');
        $orders = DB::table('orders')->where('status',3)->where('month',$month)->where('year',$year)->get();
        return view('admin.report.search_month',compact('orders','total','month','year'));
    }

    public function SearchByDate(Request $request){
        $validateData = $request->validate([
            'date' => 'required|date'
        ]);
        $temp_date =  $request->date;
        $date = date('d-m-Y',strtotime($temp_date));
        $total = DB::table('orders')->where('status',3)->where('date',$date)->sum('total');
        $orders = DB::table('orders')->where('status',3)->where('date',$date)->get();
        return view('admin.report.search_date',compact('orders','total','date'));
    }
}
