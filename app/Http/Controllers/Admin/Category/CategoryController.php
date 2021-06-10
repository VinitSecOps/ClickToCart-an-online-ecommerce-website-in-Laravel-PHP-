<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;

use App\Model\Admin\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function Category()
    {
        $categories = Category::all();
        return view('admin.category.category', compact('categories'));
    }

    public function StoreCategory(Request $request)
    {
        $validate = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ]);


        $data = array();
        $data['category_name'] = $request->category_name;
        $data['created_at'] = Carbon::now();
        DB::table('categories')->insert($data);

        $notification = array(
            'messege' => 'Category Added Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    }

    public function DeleteCategory($id)
    {
        DB::table('categories')->where('id', $id)->delete();
        $notification = array(
            'messege' => 'Category Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function EditCategory($id)
    {
        $category = DB::table('categories')->where('id', $id)->first();
        return view('admin.category.edit_category', compact('category'));
    }

    public function UpdateCategory(Request $request, $id)
    {
        $validate = $request->validate([
            'category_name' => 'required|unique:categories,category_name,' . $id . '|max:255',
        ]);

        $data = array();
        $data['category_name'] = $request->category_name;
        $update = DB::table('categories')->where('id', $id)->update($data);

        if ($update) {
            $data['updated_at'] = Carbon::now();
            $update = DB::table('categories')->where('id', $id)->update($data);
            $notification = array(
                'messege' => 'Category Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('categories')->with($notification);
        } else {
            $notification = array(
                'messege' => 'Nothing To Update',
                'alert-type' => 'error'
            );
            return redirect()->route('categories')->with($notification);
        }
    }
}
