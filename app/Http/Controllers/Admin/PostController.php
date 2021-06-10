<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Image;

class PostController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function BlogCategoryList()
    {
        $blog_categories = DB::table('post_category')->get();
        return view('admin.blog.category.index', compact('blog_categories'));
    }

    public function StoreBlogCategory(Request $request)
    {

        $validate = $request->validate([
            'category_name_english' => 'required|unique:post_category|max:255',
            'category_name_hindi' => 'required|unique:post_category|max:255',
            'category_name_gujarati' => 'required|unique:post_category|max:255',
        ]);
        $data = array();
        $data['category_name_english'] = $request->category_name_english;
        $data['category_name_hindi'] = $request->category_name_hindi;
        $data['category_name_gujarati'] = $request->category_name_gujarati;
        $data['created_at'] = Carbon::now();

        DB::table('post_category')->insert($data);

        $notification = array(
            'messege' => 'Blog Category Added Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function DeleteBlogCategory($id)
    {
        DB::table('post_category')->where('id', $id)->delete();
        $notification = array(
            'messege' => 'Blog Category Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function EditBlogCategory($id)
    {
        $blog_category = DB::table('post_category')->where('id', $id)->first();
        return view('admin.blog.category.edit', compact('blog_category'));
    }

    public function UpdateBlogCategory(Request $request, $id)
    {
        $validate = $request->validate([
            'category_name_english' => 'required|unique:post_category,category_name_english,'.$id.'|max:255',
            'category_name_hindi' => 'required|unique:post_category,category_name_hindi,'.$id.'|max:255',
            'category_name_gujarati' => 'required|unique:post_category,category_name_gujarati,'.$id.'|max:255',
        ]);

        $data = array();
        $data['category_name_english'] = $request->category_name_english;
        $data['category_name_hindi'] = $request->category_name_hindi;
        $data['category_name_gujarati'] = $request->category_name_gujarati;

        $update = DB::table('post_category')->where('id', $id)->update($data);

        if ($update) {
            $data['updated_at'] = Carbon::now();
            $update = DB::table('post_category')->where('id', $id)->update($data);
            $notification = array(
                'messege' => 'Blog Category Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('add.blog.categorylist')->with($notification);
        } else {
            $notification = array(
                'messege' => 'Nothing To Update',
                'alert-type' => 'error'
            );
            return redirect()->route('add.blog.categorylist')->with($notification);
        }
    }

    public function Create()
    {
        $blog_categories = DB::table('post_category')->get();
        return view('admin.blog.create', compact('blog_categories'));
    }

    public function StorePost(Request $request)
    {
        $validate = $request->validate([
            'post_title_english' => 'required|unique:posts,post_title_english,NULL,id,category_id,'.$request->category_id.'|max:255',
            'post_title_hindi' => 'required|unique:posts,post_title_hindi,NULL,id,category_id,'.$request->category_id.'|max:255',
            'post_title_gujarati' => 'required|unique:posts,post_title_gujarati,NULL,id,category_id,'.$request->category_id.'|max:255',
            'deatils_english' => 'required',
            'deatils_hindi' => 'required',
            'deatils_gujarati' => 'required',
            'category_id' => 'required',
            'post_image' => 'required|mimes:jpg,png,jpeg',
        ]);

        $data = array();
        $data['post_title_english'] = $request->post_title_english;
        $data['post_title_hindi'] = $request->post_title_hindi;
        $data['post_title_gujarati'] = $request->post_title_gujarati;
        $data['deatils_english'] = $request->deatils_english;
        $data['deatils_hindi'] = $request->deatils_hindi;
        $data['deatils_gujarati'] = $request->deatils_gujarati;
        $data['category_id'] = $request->category_id;

        $post_image = $request->file('post_image');
        // return response()->json($data);

        if ($post_image) {
            $post_image_name = hexdec(uniqid()) . "." . $post_image->getClientOriginalExtension();
            Image::make($post_image)->resize(400, 200)->save('public/media/post/' . $post_image_name);
            $data['post_image'] = 'public/media/post/' . $post_image_name;


            $data['created_at'] = Carbon::now();
            DB::table('posts')->insert($data);

            $notification = array(
                'messege' => 'Post Added Successfully',
                'alert-type' => 'success'
            );

            return redirect()->route('all.blog.post')->with($notification);
        } 
    }

    public function Index()
    {
        $posts = DB::table('posts')
            ->join('post_category', 'posts.category_id', 'post_category.id')
            ->select('posts.*', 'post_category.category_name_english')
            ->get();

        return view('admin.blog.index', compact('posts'));
    }

    public function DeleteBlogPost($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();
        $post_image = $post->post_image;
        unlink($post_image);

        DB::table('posts')->where('id', $id)->delete();
        $notification = array(
            'messege' => 'Post Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    }

    public function EditPost($id)
    {
        $post = DB::table('posts')->where('id', $id)->first();
        $blog_categories = DB::table('post_category')->get();
        return view('admin.blog.edit', compact('post', 'blog_categories'));
    }

    public function UpdateBlogPost(Request $request, $id)
    {
        $validate = $request->validate([
            'post_title_english' => 'required|unique:posts,post_title_english,'.$id.',id,category_id,'.$request->category_id.'|max:255',
            'post_title_hindi' => 'required|unique:posts,post_title_hindi,'.$id.',id,category_id,'.$request->category_id.'|max:255',
            'post_title_gujarati' => 'required|unique:posts,post_title_gujarati,'.$id.',id,category_id,'.$request->category_id.'|max:255',
            'deatils_english' => 'required',
            'deatils_hindi' => 'required',
            'deatils_gujarati' => 'required',
            'category_id' => 'required',
        ]);

        $data = array();
        $data['post_title_english'] = $request->post_title_english;
        $data['post_title_hindi'] = $request->post_title_hindi;
        $data['post_title_gujarati'] = $request->post_title_gujarati;
        $data['deatils_english'] = $request->deatils_english;
        $data['deatils_hindi'] = $request->deatils_hindi;
        $data['deatils_gujarati'] = $request->deatils_gujarati;
        $data['category_id'] = $request->category_id;

        $post_image = $request->file('post_image');
        $old_post_image = $request->old_post_image;

        if ($post_image) {
            $validate = $request->validate([
                'post_image' => 'required|mimes:jpg,jpeg,png',
            ]);
            unlink($old_post_image);
            $post_image_name = hexdec(uniqid()) . "." . $post_image->getClientOriginalExtension();
            Image::make($post_image)->resize(400, 200)->save('public/media/post/' . $post_image_name);
            $data['post_image'] = 'public/media/post/' . $post_image_name;


            $data['updated_at'] = Carbon::now();
            DB::table('posts')->where('id', $id)->update($data);
            $notification = array(
                'messege' => 'Blog Post Updated Successfully',
                'alert-type' => 'success'
            );
            return redirect()->route('all.blog.post')->with($notification);
        } else {
            $update = DB::table('posts')->where('id', $id)->update($data);
            if ($update) {
                $data['updated_at'] = Carbon::now();
                $update = DB::table('posts')->where('id', $id)->update($data);
                $notification = array(
                    'messege' => 'Blog Post Updated Successfully',
                    'alert-type' => 'success'
                );

                return redirect()->route('all.blog.post')->with($notification);
            } else {
                $notification = array(
                    'messege' => 'Nothing to Update',
                    'alert-type' => 'error'
                );

                return redirect()->route('all.blog.post')->with($notification);
            }
        }
    }
}
