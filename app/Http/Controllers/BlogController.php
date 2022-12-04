<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    
    /*****************************************
     * FUNCTION TO SHOW THE BLOG PAGE
     *****************************************/
    public function index()
    {
        $user = User::find(1);
        $gallery = Gallery::all();
        $categories = Category::all();
        $blog = DB::table('blog')
            ->orderBy('order', 'asc')
            ->get() ;
        return view('admin.pages.blog.posts')
            ->with('blog', $blog)
            ->with('categories', $categories)
            ->with('gallery', $gallery)
            ->with('user', $user);
    }

    /*****************************************
     * FUNCTION TO CREATE A NEW BLOG POST
     *****************************************/
    public function create()
    {
        $user = User::find(1);
        $categories = Category::all();
        $blog = Blog::all();
        return view('admin.pages.blog.post')
            ->with('categories', $categories)
            ->with('blog', $blog)
            ->with('user', $user);
    }

    /***************************************
     * FUNCTION TO CREATE A NEW BLOG POST
     ***************************************/
    public function store(Request $request)
    {
        // GET THE DATA VALUE
        $data = array(
            "title"=>$request->input("title"),
            "short_desc"=>$request->input("short_desc"),
            "author"=>$request->input("author"),
            "category"=>$request->input("category"),
            "status"=>$request->input("status"),
            'images_code' => $request -> input('images_code'), 
            'text' => $request -> input('text'), 
            "type"=>$request->input("type"),
            "image"=>$request->file("image"),
            "video"=>$request->input("video"),
            "quote_text"=>$request->input("quote_text"),
            "quote_author"=>$request->input("quote_author"),
            "order"=>$request->input("order"),
        );
        $video = $data["video"];
        $route_image = $data["image"];
        $slug_no_spaces = strtolower(str_replace(" ", "-", $data["title"]));
        $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug_no_spaces);

        if(!empty($data)){ 
            $validate_1 = Validator::make($data, [
                'title' => ['string', 'max:55'],
                'short_desc' => ['string', 'max:255'],
                'author' => ['string', 'max:55'],
                'category' => ['string', 'max:55'],
                'status' => ['string', 'max:55'],
                'text' => ['required'],
                'type' => ['string', 'max:55'],
            ]);
            if($validate_1->fails()){
                return redirect('/admin/blog/post') 
                    -> with('error-validation', '')
                    -> withErrors($validate_1)
                    -> withInput();
            }else{
                if ($data["type"] == 'standard'){
                    $validate_2 = Validator::make($data, [
                        'image' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:10240'],
                    ]);
                } else if ($data["type"] == 'video'){
                    $validate_2 = Validator::make($data, [
                        'video' => ['required', 'string', 'max:255'],
                    ]);
                    $video = '<iframe title="vimeo-player" src="'.$data["video"].'" width="900" height="500" frameborder="0" allowfullscreen></iframe>';
                } else if ($data["type"] == 'quote'){
                    $validate_2 = Validator::make($data, [
                        'quote_text' => ['required', 'string', 'max:255'],
                        'quote_author' => ['required', 'string', 'max:55'],
                    ]);
                } else {
                    $validate_2 = null;
                }
                if($validate_2 != null && $validate_2->fails()){
                    return redirect('/admin/blog/post') 
                        -> with('error-validation', '')
                        -> withErrors($validate_2)
                        -> withInput();
                } else {
                    if ($data["type"] == 'standard'){
                        $directory = "uploads/img/blog";    
                        if(!file_exists($directory)){  
                            mkdir($directory, 0777);
                        }   
                        $random = mt_rand(10,9999);
                        $route_image = $directory."/post_image_".$random.".".$data["image"]->guessExtension();
                        move_uploaded_file($data["image"]->getPathName(), $route_image);
                    }

                    $source = glob("uploads/img/temp/*");
                    foreach ($source as $file){
                        copy($file, "uploads/img/blog/".substr($file, 17));
                        unlink($file);
                    }
                    $post = new Blog();
                    $post->title = $data["title"];
                    $post->short_desc = $data["short_desc"];
                    $post->text = str_replace('uploads/img/temp','uploads/img/blog',$data['text']);
                    $post->type = $data["type"];
                    $post->image = $route_image;
                    $post->video = $video;
                    $post->quote_text = $data["quote_text"];
                    $post->quote_author = $data["quote_author"];
                    $post->author = $data["author"];
                    $post->slug = $slug;
                    $post->status = $data["status"];
                    $post->images_code = $data["images_code"];
                    $post->category_id = $data["category"];
                    $post->order = $data["order"];
                    $post->save();    
                    return redirect('/admin/blog/posts') -> with('ok-add', '');
                }            
            }
        }else{
            return redirect('/admin/blog/posts') -> with('error-validation', '');
        } 
    }

    /**********************************************
     * FUNCTION TO SHOW A SINGLE POST TO EDIT IT
     **********************************************/
    public function show($id)
    {
        $post = Blog::find($id);
        $user = User::find(1);
        $categories = Category::all();
        if($post != null){
            return view('admin.pages.blog.single')
                ->with('post', $post)
                ->with('categories', $categories)
                ->with('user', $user);
        } else {
            return redirect('/admin/blog/posts');
        }
    }

    /***************************************
     * FUNCTION TO UPDATE A POST
     ***************************************/
    public function update($id, Request $request)
    {
        // GET THE DATA VALUE
        $data = array(
            "id"=>$request->input("id"),
            "title"=>$request->input("title"),
            "short_desc"=>$request->input("short_desc"),
            "author"=>$request->input("author"),
            "category"=>$request->input("category"),
            "status"=>$request->input("status"),
            "slug"=>$request->input("slug"),
            'text' => $request->input('text'), 
            "type"=>$request->input("type"),
            "image"=>$request->file("image"),
            "image_current"=>$request->input("image_current"),
            "video"=>$request->input("video"),
            "quote_text"=>$request->input("quote_text"),
            "quote_author"=>$request->input("quote_author")
        );
        $video = $data["video"];
        $route_image = $data["image"];
        $route_image_current = $data["image_current"];

        if(!empty($data)){ 
            $validate_1 = Validator::make($data, [
                'title' => ['string', 'max:55'],
                'short_desc' => ['string', 'max:255'],
                'author' => ['string', 'max:55'],
                'category' => ['string', 'max:55'],
                'status' => ['string', 'max:55'],
                "slug" => ['string', 'max:55'],
                'text' => ['required'],
                'type' => ['string', 'max:55'],
            ]);
            if($validate_1->fails()){
                return redirect('/admin/blog/post/'.$data["id"]) 
                    -> with('error-validation', '')
                    -> withErrors($validate_1)
                    -> withInput();
            }else{
                if ($data["type"] == 'standard' && $route_image != ''){
                    $validate_2 = Validator::make($data, [
                        'image' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:10240'],
                    ]);
                } else if ($data["type"] == 'video'){
                    $validate_2 = Validator::make($data, [
                        'video' => ['required', 'string', 'max:255']
                    ]);
                    $video = '<iframe title="vimeo-player" src="'.$data["video"].'" width="900" height="500" frameborder="0" allowfullscreen></iframe>';
                } else if ($data["type"] == 'quote'){
                    $validate_2 = Validator::make($data, [
                        'quote_text' => ['required', 'string', 'max:255'],
                        'quote_author' => ['required', 'string', 'max:55'],
                    ]);
                } else {
                    $validate_2 = null;
                }
                if($validate_2 != null && $validate_2->fails()){
                    return redirect('/admin/blog/post/'.$data["id"])
                        -> with('error-validation', '')
                        -> withErrors($validate_2)
                        -> withInput();
                } else {
                    if ($data["type"] == 'standard'){
                        if($route_image != ''){
                            if ($route_image_current != ''){
                                unlink($route_image_current);
                            }
                            $directory = "uploads/img/blog";    
                            if(!file_exists($directory)){  
                                mkdir($directory, 0777);
                            }   
                            $random = mt_rand(10,9999);
                            $route_image = $directory."/post_image_".$random.".".$data["image"]->guessExtension();
                            move_uploaded_file($data["image"]->getPathName(), $route_image);
                        } else {
                            $route_image = $route_image_current;
                        }
                    } else {
                        if ($route_image_current != ''){
                            unlink($route_image_current);
                        }
                    }

                    $source = glob("uploads/img/temp/*");
                    foreach ($source as $file){
                        copy($file, "uploads/img/blog/".substr($file, 17));
                        unlink($file);
                    }

                    $slug_no_spaces = strtolower(str_replace(" ", "-", $data["slug"]));
                    $slug = preg_replace('/[^A-Za-z0-9\-]/', '', $slug_no_spaces);

                    $data_new = array(
                        "title"=>$data['title'],
                        "short_desc"=>$data['short_desc'],
                        "text" => str_replace('uploads/img/temp','uploads/img/blog',$data['text']),
                        "type"=>$data['type'],
                        "image"=>$route_image,
                        "video"=>$video,
                        "quote_text"=>$data['quote_text'],
                        "quote_author"=>$data['quote_author'],
                        "author"=>$data['author'],
                        "slug"=>$slug,
                        "status"=>$data['status'],
                        "category_id"=>$data['category']
                    );
                    Blog::where("id", $id)->update($data_new);
                    return redirect('/admin/blog/posts') -> with('ok-update', '');
                }            
            }
        }else{
            return redirect('/admin/blog/posts') -> with('error-validation', '');
        } 
    }

    /***************************************************
     * FUNCTION TO UPDATE THE ORDER OF A POST -> UP
     ***************************************************/
    public function orderUp($id)
    {
        $post_1 = Blog::where("id", $id)->get();
        $post_2 = DB::table('blog')
            ->where('order', '=', $post_1[0]['order']-1)
            ->get() ;
        // UPDATE THE ORDER OF THE ELEMENT SELECTED
        $data_new_1 = array(
            "order"=>$post_2[0]->order,
        );
        Blog::where("id", $post_1[0]['id'])->update($data_new_1);
        // UPDATE THE ORDER OF THE PREVIOUS ELEMENT
        $data_new_2 = array(
            "order"=>$post_1[0]['order'],
        );
        Blog::where("id", $post_2[0]->id)->update($data_new_2);
        return redirect('/admin/blog/posts') -> with('ok-update', '');
    }

    /***************************************************
     * FUNCTION TO UPDATE THE ORDER OF A POST -> DOWN
     ***************************************************/
    public function orderDown($id)
    {
        $post_1 = Blog::where("id", $id)->get();
        $post_2 = DB::table('blog')
            ->where('order', '=', $post_1[0]['order']+1)
            ->get() ;
        // UPDATE THE ORDER OF THE ELEMENT SELECTED
        $data_new_1 = array(
            "order"=>$post_2[0]->order,
        );
        Blog::where("id", $post_1[0]['id'])->update($data_new_1);
        // UPDATE THE ORDER OF THE PREVIOUS ELEMENT
        $data_new_2 = array(
            "order"=>$post_1[0]['order'],
        );
        Blog::where("id", $post_2[0]->id)->update($data_new_2);
        return redirect('/admin/blog/posts') -> with('ok-update', '');
    }

    /*******************************
     * FUNCTION TO DELETE A POST
     *******************************/
    public function destroy($id, Request $request){
        $validate = Blog::where("id", $id)->get();
        if(!empty($validate)){
            $source = glob("uploads/img/blog/*");
            foreach ($source as $file){
                $pos = strpos($file, $validate[0]['images_code']);
                if ($pos !== false) {
                    unlink($file);
                } 
            }
            if ($validate[0]['type'] == 'gallery'){
                $images = Gallery::where("blog_id", $id)->get();
                if (count($images) > 0){
                    foreach ($images as $image) {
                        unlink($image['image']);
                    }
                } 
            }
            if ($validate[0]['type'] == 'standard'){
                unlink($validate[0]['image']);
            }
            $blog = Blog::where("id", $validate[0]['id'])->delete();
            // SET UP THE NEW ORDER FOR THE REST OF THE POSTS
            $posts = DB::table('blog')
                ->orderBy('order', 'asc')
                ->get() ;
            $i = 1;
            foreach ($posts as $post):
                $data_new = array(
                    "order"=>$i,
                );
                Blog::where("id", $post->id)->update($data_new);
                $i++;
            endforeach;
            return redirect('/admin/blog/posts') -> with('ok-delete', '');
        } else {
            return redirect('/admin/blog/posts') -> with('no-delete', '');
        }
    }

}
