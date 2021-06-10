<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class HomeController extends Controller
{
  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('auth');
  }

  /**
   * Show the application dashboard.
   *
   * @return \Illuminate\Contracts\Support\Renderable
   */
  public function index()
  {
    return view('home');
  }

  public function changePassword()
  {
    return view('auth.changepassword');
  }

  public function updatePassword(Request $request)
  {
    $password = Auth::user()->password;
    $oldpass = $request->oldpass;
    $newpass = $request->password;
    $confirm = $request->password_confirmation;
    if (Hash::check($oldpass, $password)) {
      if ($newpass === $confirm) {
        $user = User::find(Auth::id());
        $user->password = Hash::make($request->password);
        $user->save();
        Auth::logout();
        $notification = array(
          'messege' => 'Password Changed Successfully ! Now Login with Your New Password',
          'alert-type' => 'success'
        );
        return Redirect()->route('login')->with($notification);
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

  public function Logout()
  {
    // $logout= Auth::logout();
    Auth::logout();
    $notification = array(
      'messege' => 'Successfully Logout',
      'alert-type' => 'success'
    );
    return Redirect()->route('login')->with($notification);
  }

  public function Profile()
  {
    return view('auth.profile');
  }

  public function profileUpdate(Request $request)
  {
    $validateData =  $request->validate([
      'name' => 'required|string|max:255',
      'phone' => 'required|regex:/^[6-9]\d{9}$/|min:10|max:10'
    ],
    [
      'phone.regex' => 'Must be 10 digit'
    ]);
    $old_avatar = $request->old_avatar; 

    $data = array();
    $data['name'] = $request->name;
    $data['phone'] = $request->phone;
    $image = $request->file('avatar');

    if ($image) {
      $validateData = $request->validate([
        'avatar' => 'required|mimes:jpg,jpeg,png'
      ]);
      if($old_avatar != 'public/media/user/no_image.jpg'){
        unlink($old_avatar);
      }
      
      $image_name = date('dmy_H_i_s');
      $ext = strtolower($image->getClientOriginalExtension());
      $image_full_name = $image_name . '.' . $ext;
      $upload_path = 'public/media/user/';
      $image_url = $upload_path . $image_full_name;
      $image->move($upload_path, $image_full_name);

      $data['avatar'] = $image_url;
      $data['updated_at'] = Carbon::now();
      DB::table('users')->where('id', Auth::id())->update($data);

      $notification = array(
        'messege' => 'Profile Updated Successfully',
        'alert-type' => 'success'
      );

      return redirect()->back()->with($notification);
    } else {
      $update = DB::table('users')->where('id', Auth::id())->update($data);
      if ($update) {
        $data['updated_at'] = Carbon::now();
        $update = DB::table('users')->where('id', Auth::id())->update($data);
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
