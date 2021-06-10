<?php

namespace App\Http\Controllers;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ContactController extends Controller
{
    public function ContactPage(){
        return view('pages.contact');
    }

    public function ContactForm(Request $request){

        $validataData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'phone' => 'required|string|regex:/^[6-9]\d{9}$/|max:10|min:10',
            'message' => 'required|string'
        ],
        [
            'phone.regex' => 'Must be 10 digit',
        ]);
        $data = array();
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['message'] = $request->message;
        $data['created_at'] = Carbon::now();

        DB::table('contact')->insert($data);

        $notification = array(
            'messege' => 'We\'ll be soon in touch, thanks for contacting',
            'alert-type' => 'success'
        );
        return Redirect()->back()->with($notification);
    }
}
