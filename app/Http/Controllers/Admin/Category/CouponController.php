<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CouponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function Coupon(){
        $coupons = DB::table('coupons')->get();
        return view('admin.coupon.coupon',compact('coupons'));
    }

    public function StoreCoupon(Request $request){
        $validate = $request->validate([
            'coupon' => 'required|unique:coupons|max:255',
            'discount' => 'required|numeric|gt:0|lt:100',
            'image' => 'required|mimes:jpg,jpeg,png'
        ]);

        $data = array();
        $data['coupon'] = strtoupper($request->coupon);
        $data['discount'] = $request->discount;
        $image = $request->file('image');

        if ($image) {
            $image_name = date('dmy_H_i_s');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'public/media/coupon/';
            $image_url = $upload_path . $image_full_name;
            $image->move($upload_path, $image_full_name);

            $data['image'] = $image_url;

            $data['created_at'] = Carbon::now();
            DB::table('coupons')->insert($data);

            $notification = array(
                'messege' => 'Coupon Added Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
        
    }

    public function DeleteCoupon($id){

        $data = DB::table('coupons')->where('id',$id)->first();
        $image = $data->image;
        unlink($image);
        DB::table('coupons')->where('id',$id)->delete();
        $notification = array(
            'messege' => 'Coupon Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function EditCoupon($id){
        $coupon = DB::table('coupons')->where('id',$id)->first();
        return view('admin.coupon.edit_coupon',compact('coupon'));
    }

    public function UpdateCoupon(Request $request, $id){
        $validate = $request->validate([
            'coupon' => 'required|unique:coupons,coupon,'.$id.'|max:255',
            'discount' => 'required|numeric|gt:0|lt:100',
        ]);

        $old_image = $request->old_image;

        $data = array();
        $data['coupon'] = strtoupper($request->coupon);
        $data['discount'] = $request->discount;
        $image = $request->file('image');

        if ($image) {
            $validate = $request->validate([
                'image' => 'required|mimes:jpg,jpeg,png',
            ]);
            unlink($old_image);
            $image_name = date('dmy_H_i_s');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'public/media/coupon/';
            $image_url = $upload_path . $image_full_name;
            $image->move($upload_path, $image_full_name);

            $data['image'] = $image_url;
            $data['updated_at'] = Carbon::now();
            DB::table('coupons')->where('id', $id)->update($data);

            $notification = array(
                'messege' => 'Coupon Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('admin.coupon')->with($notification);
        } else {
            $update = DB::table('coupons')->where('id', $id)->update($data);
            if ($update) {
                $data['updated_at'] = Carbon::now();
                $update = DB::table('coupons')->where('id', $id)->update($data);
                $notification = array(
                    'messege' => 'Coupon Updated Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->route('admin.coupon')->with($notification);
            } else {
                $notification = array(
                    'messege' => 'Nothing to Update',
                    'alert-type' => 'error'
                );

                return redirect()->route('admin.coupon')->with($notification);
            }
        }








        // $update = DB::table('coupons')->where('id',$id)->update($data);

        // if($update){
        //     $data['updated_at'] = Carbon::now();
        //     $update = DB::table('coupons')->where('id',$id)->update($data);
        //     $notification = array(
        //         'messege' => 'Coupon Updated Successfully',
        //         'alert-type' => 'success'
        //     );
        //     return redirect()->route('admin.coupon')->with($notification);
        // }else{
        //     $notification = array(
        //         'messege' => 'Nothing To Update',
        //         'alert-type' => 'error'
        //     );
        //     return redirect()->route('admin.coupon')->with($notification);
        // }
    }
}
