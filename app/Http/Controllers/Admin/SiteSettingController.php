<?php

namespace App\Http\Controllers\Admin;
use DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Image;

class SiteSettingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index(){
        $setting = DB::table('sitesetting')->first();
        return view('admin.setting.site_setting',compact('setting'));
    }

    public function UpdateSiteSetting(Request $request){
        $id = $request->id;

        $validateData = $request->validate([
            'phone_one' => 'required|string|regex:/^[6-9]\d{9}$/|max:10|min:10',
            'phone_two' => 'required|string|regex:/^[6-9]\d{9}$/|max:10|min:10',
            'email' => 'required|email|max:255',
            'company_name' => 'required|max:255',
            'company_address' => 'required|max:1000',
            'facebook' => 'url|nullable',
            'youtube' => 'url|nullable',
            'instagram' => 'url|nullable',
            'twitter' => 'url|nullable',
        ],
        [
            'phone_one.regex' => 'Must be valid',
            'phone_two.regex' => 'Must be valid'
        ]);

        $data = array();
        $data['phone_one'] = $request->phone_one;
        $data['phone_two'] = $request->phone_two;
        $data['email'] = $request->email;
        $data['company_name'] = $request->company_name;
        $data['company_address'] = $request->company_address;
        $data['facebook'] = $request->facebook;
        $data['youtube'] = $request->youtube;
        $data['instagram'] = $request->instagram;
        $data['twitter'] = $request->twitter;

        DB::table('sitesetting')->where('id',$id)->update($data);

        $notification = array(
            'messege' => 'Setting updated',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.site.setting')->with($notification);
    }
    

    public function tc(){
        $setting = DB::table('sitesetting')->first();
        return view('admin.setting.site_tc_setting',compact('setting'));
    }

    public function UpdateTCSiteSetting(Request $request){
        $id = $request->id;

       

        $data = array();
        $data['disclaimer'] = $request->disclaimer;
        $data['policy'] = $request->policy;
        $data['terms'] = $request->terms;
        $data['safe'] = $request->safe;
       

        DB::table('sitesetting')->where('id',$id)->update($data);

        $notification = array(
            'messege' => 'T&C Setting updated',
            'alert-type' => 'success'
        );

        return redirect()->route('admin.site.tc.setting')->with($notification);
    }

    public function SettingLogo(Request $request)
    {
        $id = $request->id;

        $old_logo = $request->old_logo;
        $old_favicon = $request->old_favicon;

        $data = array();

        $logo = $request->file('logo');
        $favicon = $request->file('favicon');

        $flag = 0;

       

        if ($logo) {
            $validate = $request->validate([
                'logo' => 'mimes:jpg,jpeg,png',
                'favicon' => 'mimes:jpg,jpeg,png,ico',
            ]);
            unlink($old_logo);
            $logo_name = hexdec(uniqid()) . "." . $logo->getClientOriginalExtension();
            Image::make($logo)->resize(120, 120)->save('public/media/logo/' . $logo_name);
            $data['logo'] = 'public/media/logo/' . $logo_name;

            $data['updated_at'] = Carbon::now();
            DB::table('sitesetting')->where('id', $id)->update($data);

            $flag = 1;
        }


        if ($favicon) {
            $validate = $request->validate([
                'logo' => 'mimes:jpg,jpeg,png',
                'favicon' => 'mimes:jpg,jpeg,png',
            ]);
            unlink($old_favicon);

            $favicon_name = hexdec(uniqid()) . "." . $favicon->getClientOriginalExtension();
            Image::make($favicon)->resize(78, 78)->save('public/media/logo/' . $favicon_name);
            $data['favicon'] = 'public/media/logo/' . $favicon_name;


            $data['updated_at'] = Carbon::now();
            DB::table('sitesetting')->where('id', $id)->update($data);

            $flag = 1;
        }
       

        if ($flag == 1) {
            $notification = array(
                'messege' => 'Logo settings Updated',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.site.setting')->with($notification);
        } else {
            $notification = array(
                'messege' => 'Nothing To Update',
                'alert-type' => 'error'
            );
            return redirect()->route('admin.site.setting')->with($notification);
        }
    }
}
