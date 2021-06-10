<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Model\Admin\Brand;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function Brand()
    {
        $brands = Brand::all();
        return view('admin.category.brand', compact('brands'));
    }

    public function StoreBrand(Request $request)
    {
        $validate = $request->validate([
            'brand_name' => 'required|unique:brands|max:55',
            'brand_logo' => 'required|mimes:jpg,jpeg,png',
        ]);

        $data = array();
        $data['brand_name'] = $request->brand_name;
        $image = $request->file('brand_logo');

        if ($image) {
            $image_name = date('dmy_H_i_s');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'public/media/brand/';
            $image_url = $upload_path . $image_full_name;
            $image->move($upload_path, $image_full_name);

            $data['brand_logo'] = $image_url;

            $data['created_at'] = Carbon::now();
            DB::table('brands')->insert($data);

            $notification = array(
                'messege' => 'Brand Added Successfully',
                'alert-type' => 'success'
            );

            return redirect()->back()->with($notification);
        }
    }

    public function DeleteBrand($id)
    {
        $data = DB::table('brands')->where('id', $id)->first();
        $image = $data->brand_logo;
        unlink($image);
        DB::table('brands')->where('id', $id)->delete();
        $notification = array(
            'messege' => 'Brand Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function EditBrand($id)
    {
        $brand = DB::table('brands')->where('id', $id)->first();
        return view('admin.category.edit_brand', compact('brand'));
    }

    public function UpdateBrand(Request $request, $id)
    {
        $validate = $request->validate([
            'brand_name' => 'required|unique:brands,brand_name,' . $id . '|max:255',
        ]);


        $old_logo = $request->old_logo;

        $data = array();
        $data['brand_name'] = $request->brand_name;
        $image = $request->file('brand_logo');

        if ($image) {
            $validate = $request->validate([
                'brand_logo' => 'required|mimes:jpg,jpeg,png',
            ]);
            unlink($old_logo);
            $image_name = date('dmy_H_i_s');
            $ext = strtolower($image->getClientOriginalExtension());
            $image_full_name = $image_name . '.' . $ext;
            $upload_path = 'public/media/brand/';
            $image_url = $upload_path . $image_full_name;
            $image->move($upload_path, $image_full_name);

            $data['brand_logo'] = $image_url;
            $data['updated_at'] = Carbon::now();
            DB::table('brands')->where('id', $id)->update($data);

            $notification = array(
                'messege' => 'Brand Updated Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('brands')->with($notification);
        } else {
            $update = DB::table('brands')->where('id', $id)->update($data);
            if ($update) {
                $data['updated_at'] = Carbon::now();
                $update = DB::table('brands')->where('id', $id)->update($data);
                $notification = array(
                    'messege' => 'Brand Updated Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->route('brands')->with($notification);
            } else {
                $notification = array(
                    'messege' => 'Nothing to Update',
                    'alert-type' => 'error'
                );

                return redirect()->route('brands')->with($notification);
            }
        }
        
        // $update = DB::table('brands')->where('id', $id)->update($data);

        // if ($update) {

        //     $notification = array(
        //         'messege' => 'Brand Updated Successfully',
        //         'alert-type' => 'success'
        //     );
        //     return redirect()->route('brands')->with($notification);
        // } else {
        //     $notification = array(
        //         'messege' => 'Nothing To Update',
        //         'alert-type' => 'error'
        //     );
        //     return redirect()->route('brands')->with($notification);
        // }
    }
}
