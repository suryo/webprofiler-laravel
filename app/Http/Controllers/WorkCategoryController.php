<?php

namespace App\Http\Controllers;

use App\Models\WorkCategory;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class WorkCategoryController extends Controller
{
    
    /**********************************************
     * FUNCTION TO SHOW THE WORK CATEGORIES WORK
     **********************************************/
    public function index()
    {
        $categories = WorkCategory::all();
        $user = User::find(1);
        return view('admin.pages.work.categories')
            ->with('categories', $categories)
            ->with('user', $user);
    }

    /************************************
     * FUNCTION TO CREATE A WORK CATEGORY
     ************************************/
    public function store(Request $request)
    {
        // GET THE DATA VALUE
        $data = array(
            "name"=>$request->input("name"),
        );

        if(!empty($data)){
            $validate = Validator::make($data, [
                "name" => ['required', 'string', 'max:55'],
            ]);
            if($validate->fails()){
                return redirect('/admin/work/categories') 
                    -> with('error-validation', '')
                    -> with('error-modal', '')
                    -> withErrors($validate)
                    -> withInput();
            }else{
                $category = new WorkCategory();
                $category->name = $data["name"];
                $category->save();    
                return redirect('/admin/work/categories') -> with('ok-add', '');
            }
        } else {
            return redirect('/admin/work/categories') -> with('error-validation', '');
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
        );

        if(!empty($data)){
            $validate = Validator::make($data, [
                "name" => ['required', 'string', 'max:55'],
            ]);
            if($validate->fails()){
                return redirect('/admin/work/categories/') 
                    -> with('error-validation', '')
                    -> withErrors($validate)
                    -> withInput();
            }else{
                $data_new = array(
                    "name"=>$data['name'],
                );
                WorkCategory::where("id", $id)->update($data_new);
                return redirect('/admin/work/categories') -> with('ok-update', '');
            }
        } else {
            return redirect('/admin/work/categories') -> with('error-validation', '');
        }
    }

    /************************************
     * FUNCTION TO DELETE A CATEGORY
     ************************************/
    public function destroy($id, WorkCategory $workcategory)
    {
        $validate = WorkCategory::where("id", $id)->get();
        if(!empty($validate)){
            $type = $validate[0]['type'];
            WorkCategory::where("id", $validate[0]['id'])->delete();
            return redirect('/admin/work/categories') -> with('ok-delete', '');
        } else {
            return redirect('/admin/work/categories') -> with('no-delete', '');
        }
    }

}
