<?php

namespace App\Http\Controllers\Admin;
use DB;
use App\Http\Controllers\Controller;
use App\Mail\ContactReplyMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function AllMessages(){
        $messages = DB::table('contact')->orderBy('created_at','DESC')->get();
        return view('admin.contact.all_messages',compact('messages'));
    }

    public function ViewMessages($id){
        $message = DB::table('contact')->where('id',$id)->first();
        return view('admin.contact.view_message',compact('message'));
    }

    public function ViewRepliedMessages($id){
        $message = DB::table('contact')->where('id',$id)->first();
        return view('admin.contact.view_replied_message',compact('message'));
    }

    public function ReplyMessages(Request $request){

        $id = $request->id;

        $validateData = $request->validate(
            [
                'subject' => 'required|string|max:255',
                'reply' => 'required|string'
            ]);

        $data = array();
        $data['name'] = $request->name;
        $data['subject'] = $request->subject;
        $data['reply'] = $request->reply;
        $data['message'] = $request->message;

        $email = $request->email;

        Mail::to($email)->send(new ContactReplyMail($data));

        $contact = array();
        $contact['subject'] = $request->subject;
        $contact['reply'] = $request->reply;
        $contact['status'] = 1;

        DB::table('contact')->where('id',$id)->update($contact);

        $notification = array(
            'messege' => 'Sent',
            'alert-type' => 'success'
        );

        return redirect()->route('all.messages')->with($notification);
    }
}
