<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Model\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Model\Admin\SubCategory;

class SubCategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function SubCategory(){
        $categories = DB::table('categories')->get();
        $sub_categories = DB::table('subcategories')->join('categories','subcategories.category_id','categories.id')->select('subcategories.*','categories.category_name')->get();
        return view('admin.category.subcategory',compact('sub_categories','categories'));
    }

    public function StoreSubCategory(Request $request){
        $validate = $request->validate([
            'subcategory_name' => 'required|unique:subcategories,subcategory_name,NULL,id,category_id,'.$request->category_id.'|max:255',
            'category_id' => 'required|',
        ]);

        $data = array();
        $data['subcategory_name'] = $request->subcategory_name;
        $data['category_id'] = $request->category_id;
        $data['created_at'] = Carbon::now();
        DB::table('subcategories')->insert($data);

        $notification = array(
            'messege' => 'SubCategory Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
        
    }

    public function DeleteSubCategory($id){
        DB::table('subcategories')->where('id',$id)->delete();
        $notification = array(
            'messege' => 'SubCategory Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function EditSubCategory($id){
        $categories = DB::table('categories')->get();
        $sub_category = DB::table('subcategories')->where('id',$id)->first();
        return view('admin.category.edit_sub_category',compact('sub_category','categories'));
    }

    public function SubUpdateCategory(Request $request, $id){
        $validate = $request->validate([
            'subcategory_name' => 'required|unique:subcategories,subcategory_name,'.$id.',id,category_id,'.$request->category_id.'|max:255',
            'category_id' => 'required',
        ]);

        $data = array();
        $data['category_id'] = $request->category_id;
        $data['subcategory_name'] = $request->subcategory_name;
        $update = DB::table('subcategories')->where('id',$id)->update($data);

        if($update){
            $data['updated_at'] = Carbon::now();
            $update = DB::table('subcategories')->where('id',$id)->update($data);
            $notification = array(
                'messege' => 'SubCategory Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('sub.categories')->with($notification);
        }else{
            $notification = array(
                'messege' => 'Nothing To Update',
                'alert-type' => 'error'
            );
            return redirect()->route('sub.categories')->with($notification);
        }
    }
}
