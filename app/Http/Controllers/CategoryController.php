<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    
    /*****************************************
     * FUNCTION TO SHOW THE CATEGORIES PAGE
     *****************************************/
    public function index()
    {
        $categories = Category::all();
        $user = User::find(1);
        return view('admin.pages.blog.categories')
            ->with('categories', $categories)
            ->with('user', $user);
    }

    /************************************
     * FUNCTION TO CREATE A CATEGORY
     ************************************/
    public function store(Request $request)
    {
        // GET THE DATA VALUE
        $data = array(
            "name"=>$request->input("name"),
        );
        $slug = strtolower(str_replace(" ", "-", $data["name"]));

        if(!empty($data)){
            $validate = Validator::make($data, [
                "name" => ['required', 'string', 'max:55'],
            ]);
            if($validate->fails()){
                return redirect('/admin/blog/categories') 
                    -> with('error-validation', '')
                    -> with('error-modal', '')
                    -> withErrors($validate)
                    -> withInput();
            }else{
                $category = new Category();
                $category->name = $data["name"];
                $category->slug = $slug;
                $category->save();    
                return redirect('/admin/blog/categories') -> with('ok-add', '');
            }
        } else {
            return redirect('/admin/blog/categories') -> with('error-validation', '');
        }
    }

    /************************************
     * FUNCTION TO SHOW A CATEGORY
     ************************************/
    public function show($id)
    {
        $category = Category::find($id);
        $user = User::find(1);
        if($category != null){
            return view('admin.pages.blog.category')
                ->with('category', $category)
                ->with('user', $user);
        } else {
            return redirect('/admin/blog/categories');
        }
    }

    /************************************
     * FUNCTION TO UPDATE A CATEGORY
     ************************************/
    public function update($id, Request $request)
    {
        // GET THE DATA VALUE
        $data = array(
            "name"=>$request->input("name"),
            "slug"=>$request->input("slug"),
        );

        if(!empty($data)){
            $validate = Validator::make($data, [
                "name" => ['required', 'string', 'max:55'],
                "slug" => ['required', 'string', 'max:55'],
            ]);
            if($validate->fails()){
                return redirect('/admin/blog/categories/'.$id) 
                    -> with('error-validation', '')
                    -> withErrors($validate)
                    -> withInput();
            }else{
                $slug = strtolower(str_replace(" ", "-", $data["slug"]));
                $data_new = array(
                    "name"=>$data['name'],
                    "slug"=>$slug
                );
                Category::where("id", $id)->update($data_new);
                return redirect('/admin/blog/categories') -> with('ok-update', '');
            }
        } else {
            return redirect('/admin/blog/categories') -> with('error-validation', '');
        }
    }

    /************************************
     * FUNCTION TO DELETE A CATEGORY
     ************************************/
    public function destroy($id, Category $category)
    {
        $validate = Category::where("id", $id)->get();
        if(!empty($validate)){
            $type = $validate[0]['type'];
            Category::where("id", $validate[0]['id'])->delete();
            return redirect('/admin/blog/categories') -> with('ok-delete', '');
        } else {
            return redirect('/admin/blog/categories') -> with('no-delete', '');
        }
    }

}
