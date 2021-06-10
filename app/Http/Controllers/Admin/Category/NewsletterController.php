<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class NewsletterController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function Newsletter(){
        $newsletters = DB::table('newsletter')->orderBy('id','DESC')->get();
        return view('admin.newsletter.newsletter',compact('newsletters'));
    }

    public function DeleteNewsletter($id){
        DB::table('newsletter')->where('id',$id)->delete();
        $notification = array(
            'messege' => 'Subscriber Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function DeleteSelectedNewsletter(Request $request){
        $ids =  $request->ids;

        if(!empty($ids)){
            foreach ($ids as $value) {
                DB::table('newsletter')->where('id',$value)->delete();
            }
    
            $notification = array(
                'messege' => 'Subscribers Deleted Successfully',
                'alert-type' => 'success'
            );
            return redirect()->back()->with($notification);
        }else{
            $notification = array(
                'messege' => 'Please select an item',
                'alert-type' => 'error'
            );
            return redirect()->back()->with($notification);
        }
        
       


    }

    
}
