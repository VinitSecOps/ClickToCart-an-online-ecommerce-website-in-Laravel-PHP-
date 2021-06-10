<?php

namespace App\Http\Controllers\Admin;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class UserRoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function AllUser(){
        $users = DB::table('admins')->where('type',2)->orderBy('id','DESC')->get();
        return view('admin.user_role.all_user',compact('users'));
    }

    public function AddUser(){
        return view('admin.user_role.add_user');
    }

    public function StoreUser(Request $request){

        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|regex:/^[6-9]\d{9}$/|max:10|min:10',
            'email' => 'required|unique:admins|email|max:255',
            'password' => 'required|confirmed|min:8',
        ],
        [
            'phone.regex' => 'Must be 10 digit'
        ]);
        $data = array();
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['avatar'] = "public/media/admin/no_image.jpg";
        $data['password'] = Hash::make($request->password);
        $data['reports'] = $request->reports;
        $data['categories'] = $request->categories;
        $data['products'] = $request->products;
        $data['orders'] = $request->orders;
        $data['return_orders'] = $request->return_orders;
        $data['coupons'] = $request->coupons;
        $data['blogs'] = $request->blogs;
        $data['user_roles'] = $request->user_roles;
        $data['contact_messages'] = $request->contact_messages;
        $data['product_comments'] = $request->product_comments;
        $data['site_settings'] = $request->site_settings;
        $data['others'] = $request->others;
        $data['type'] = 2;
        $data['created_at'] = Carbon::now();

        DB::table('admins')->insert($data);
        $notification = array(
            'messege' => 'New subadmin created',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.all.user')->with($notification);
    }

    public function DeleteUser($id){
        DB::table('admins')->where('id',$id)->where('type',2)->delete();
        $notification = array(
            'messege' => 'Subadmin removed',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.all.user')->with($notification);
    }

    public function EditUser($id){
        $user = DB::table('admins')->where('id',$id)->where('type',2)->first();
        return view('admin.user_role.edit_user',compact('user'));
    }

    public function UpdateUser(Request $request){
        $id = $request->id;

        $validateData = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|regex:/^[6-9]\d{9}$/|max:10|min:10',
            'email' => 'required|unique:admins,email,'.$id.'|email|max:255',
        ],
        [
            'phone.regex' => 'Must be 10 digit'
        ]);


        $data = array();
        $data['name'] = $request->name;
        $data['phone'] = $request->phone;
        $data['email'] = $request->email;
        $data['reports'] = $request->reports;
        $data['categories'] = $request->categories;
        $data['products'] = $request->products;
        $data['orders'] = $request->orders;
        $data['return_orders'] = $request->return_orders;
        $data['coupons'] = $request->coupons;
        $data['blogs'] = $request->blogs;
        $data['user_roles'] = $request->user_roles;
        $data['contact_messages'] = $request->contact_messages;
        $data['product_comments'] = $request->product_comments;
        $data['site_settings'] = $request->site_settings;
        $data['others'] = $request->others;

        $update = DB::table('admins')->where('id',$id)->where('type',2)->update($data);

        if($update){
            $data['updated_at'] = Carbon::now();
            DB::table('admins')->where('id',$id)->where('type',2)->update($data);
            $notification = array(
                'messege' => 'Subadmin updated',
                'alert-type' => 'success'
            );
    
            return redirect()->route('admin.all.user')->with($notification);
        }else{
            $notification = array(
                'messege' => 'Nothing to update',
                'alert-type' => 'error'
            );
    
            return redirect()->route('admin.all.user')->with($notification);

        }
       


    }
}
