<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Hash;
use App\Admin;
use Illuminate\Support\Facades\Auth;
use DB;
use Illuminate\Support\Carbon;

class AdminController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth:admin');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    return view('admin.home');
  }

  public function ChangePassword()
  {
    return view('admin.auth.passwordchange');
  }

  public function Update_pass(Request $request)
  {
    $password = Auth::user()->password;
    $oldpass = $request->oldpass;
    $newpass = $request->password;
    $confirm = $request->password_confirmation;
    if (Hash::check($oldpass, $password)) {
      if ($newpass === $confirm) {
        $user = Admin::find(Auth::id());
        $user->password = Hash::make($request->password);
        $user->save();
        Auth::logout();
        $notification = array(
          'messege' => 'Password Changed Successfully ! Now Login with Your New Password',
          'alert-type' => 'success'
        );
        return Redirect()->route('admin.login')->with($notification);
      } else {
        $notification = array(
          'messege' => 'New password and Confirm Password not matched!',
          'alert-type' => 'error'
        );
        return Redirect()->back()->with($notification);
      }
    } else {
      $notification = array(
        'messege' => 'Old Password not matched!',
        'alert-type' => 'error'
      );
      return Redirect()->back()->with($notification);
    }
  }

  public function logout()
  {
    Auth::logout();
    $notification = array(
      'messege' => 'Successfully Logout',
      'alert-type' => 'success'
    );
    return Redirect()->route('admin.login')->with($notification);
  }

  public function EditProfile()
  {
    $profile = DB::table('admins')->where('id', Auth::id())->first();

    return view('admin.auth.edit_profile', compact('profile'));
  }

  public function UpdateProfile(Request $request)
  {
    $validateData =  $request->validate([
      'name' => 'required|string|max:255',
    ]);

    $old_avatar = $request->old_avatar;

    $data = array();
    $data['name'] = $request->name;
    $image = $request->file('avatar');

    if ($image) {
      $validateData = $request->validate([
        'avatar' => 'required|mimes:jpg,jpeg,png'
      ]);
      if($old_avatar != 'public/media/admin/no_image.jpg'){
        unlink($old_avatar);
      }
      
      $image_name = date('dmy_H_i_s');
      $ext = strtolower($image->getClientOriginalExtension());
      $image_full_name = $image_name . '.' . $ext;
      $upload_path = 'public/media/admin/';
      $image_url = $upload_path . $image_full_name;
      $image->move($upload_path, $image_full_name);

      $data['avatar'] = $image_url;
      $data['updated_at'] = Carbon::now();
      DB::table('admins')->where('id', Auth::id())->update($data);

      $notification = array(
        'messege' => 'Profile Updated Successfully',
        'alert-type' => 'success'
      );

      return redirect()->back()->with($notification);
    } else {
      $update = DB::table('admins')->where('id', Auth::id())->update($data);
      if ($update) {
        $data['updated_at'] = Carbon::now();
        $update = DB::table('admins')->where('id', Auth::id())->update($data);
        $notification = array(
          'messege' => 'Profile Updated Successfully',
          'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
      } else {
        $notification = array(
          'messege' => 'Nothing to Update',
          'alert-type' => 'error'
        );

        return redirect()->back()->with($notification);
      }
    }


  }
}
