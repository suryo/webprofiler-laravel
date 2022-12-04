<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Blog;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class GalleryController extends Controller
{
    
    /*****************************************
     * FUNCTION TO SHOW THE GALLERY IMAGES
     *****************************************/
    public function index($id)
    {
        $gallery_images = Gallery::where("blog_id", $id)->get();
        $user = User::find(1);
        $post = Blog::find($id);
        if(count($gallery_images) > 0){
            return view('admin.pages.blog.gallery')
                ->with('gallery_images', $gallery_images)
                ->with('post', $post)
                ->with('user', $user);
        } else {
            return redirect('/admin/blog/posts');
        }
    }

    /**********************************************
     * FUNCTION TO ADD AN IMAGE FOR THE GALLERY
     **********************************************/
    public function store(Request $request)
    {
        // GET THE DATA VALUE
        $data = array(
            "image"=>$request->file("gallery_image"),
            "blog_id"=>$request->input("post_id"),
        );
        if(!empty($data)){
            $validate = Validator::make($data, [
                'image' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:10240'],
            ]);
            if($validate->fails()){
                return redirect('/admin/blog/posts') -> with('error-validation-image', '');
            }else{
                $directory = "uploads/img/blog";    
                if(!file_exists($directory)){  
                    mkdir($directory, 0777);
                }   
                $random = mt_rand(100,9999);
                $route_image = $directory."/gallery_image_".$random.".".$data["image"]->guessExtension();
                move_uploaded_file($data["image"]->getPathName(), $route_image);
                $gallery = new Gallery();
                $gallery->image = $route_image;
                $gallery->blog_id = $data['blog_id'];
                $gallery->save();    
                return redirect('/admin/blog/posts') -> with('ok-add', '');
            }
        }else{
            return redirect('/admin/blog/posts') -> with('error-validation', '');
        } 
    }

    /*****************************************
     * FUNCTION TO DELETE A GALLERY IMAGE
     *****************************************/
    public function destroy($id, Request $request){
        $validate = Gallery::where("id", $id)->get();
        $blog_id = $request->input("post_id");
        if(!empty($validate)){
            unlink($validate[0]['image']);
            Gallery::where("id", $id)->delete();
            return redirect('/admin/blog/gallery/'.$blog_id) -> with('ok-delete', '');
        } else {
            return redirect('/admin/blog/gallery/'.$blog_id) -> with('no-delete', '');
        }
    }

}
