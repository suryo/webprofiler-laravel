<?php

namespace App\Http\Controllers;

use App\Models\WorkGallery;
use App\Models\Work;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class WorkGalleryController extends Controller
{
    
    /***************************************************
     * FUNCTION TO SHOW THE GALLERY IMAGES OF A PROJECT
     ***************************************************/
    public function index($id)
    {
        $gallery_images = WorkGallery::where("project_id", $id)->get();
        $user = User::find(1);
        $project = Work::find($id);
        if(count($gallery_images) > 0){
            return view('admin.pages.work.gallery')
                ->with('gallery_images', $gallery_images)
                ->with('project', $project)
                ->with('user', $user);
        } else {
            return redirect('/admin/work/projects');
        }
    }

    /***************************************************
     * FUNCTION TO ADD AN IMAGE FOR THE GALLERY PROJECT
     ***************************************************/
    public function store(Request $request)
    {
        // GET THE DATA VALUE
        $data = array(
            "image"=>$request->file("gallery_image"),
            "project_id"=>$request->input("project_id"),
        );
        if(!empty($data)){
            $validate = Validator::make($data, [
                'image' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:10240'],
            ]);
            if($validate->fails()){
                return redirect('/admin/work/projects') -> with('error-validation-image', '');
            }else{
                $directory = "uploads/img/work";    
                if(!file_exists($directory)){  
                    mkdir($directory, 0777);
                }   
                $random = mt_rand(100,9999);
                $route_image = $directory."/project_image_".$random.".".$data["image"]->guessExtension();
                move_uploaded_file($data["image"]->getPathName(), $route_image);
                $gallery = new WorkGallery();
                $gallery->image = $route_image;
                $gallery->project_id = $data['project_id'];
                $gallery->save();    
                return redirect('/admin/work/projects') -> with('ok-add', '');
            }
        }else{
            return redirect('/admin/work/projects') -> with('error-validation', '');
        } 
    }

    /*****************************************
     * FUNCTION TO DELETE A GALLERY PROJECT
     *****************************************/
    public function destroy($id, Request $request){
        $validate = WorkGallery::where("id", $id)->get();
        $project_id = $request->input("project_id");
        if(!empty($validate)){
            unlink($validate[0]['image']);
            WorkGallery::where("id", $id)->delete();
            return redirect('/admin/work/gallery/'.$project_id) -> with('ok-delete', '');
        } else {
            return redirect('/admin/work/gallery/'.$project_id) -> with('no-delete', '');
        }
    }

}
