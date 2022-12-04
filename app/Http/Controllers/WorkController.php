<?php

namespace App\Http\Controllers;

use App\Models\Work;
use App\Models\User;
use App\Models\WorkCategory;
use App\Models\WorkGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

class WorkController extends Controller
{
    
    /*****************************************
     * FUNCTION TO SHOW THE PROJECTS PAGE
     *****************************************/
    public function index()
    {
        $user = User::find(1);
        $gallery = WorkGallery::all();
        $categories = WorkCategory::all();
        $projects = DB::table('project')
            ->orderBy('order', 'asc')
            ->get() ;
        return view('admin.pages.work.projects')
            ->with('projects', $projects)
            ->with('categories', $categories)
            ->with('gallery', $gallery)
            ->with('user', $user);
    }

    /*****************************************
     * FUNCTION TO CREATE A NEW PROJECT
     *****************************************/
    public function create()
    {
        $user = User::find(1);
        $categories = WorkCategory::all();
        $projects = Work::all();
        return view('admin.pages.work.project')
            ->with('categories', $categories)
            ->with('projects', $projects)
            ->with('user', $user);
    }

    /***************************************
     * FUNCTION TO CREATE A NEW PROJECT
     ***************************************/
    public function store(Request $request)
    {
        // GET THE DATA VALUE
        $data = array(
            "enable"=>$request->input("enable_project"),
            "title"=>$request->input("title"),
            "category"=>$request->input("category"),
            'images_code' => $request -> input('images_code'),
            "description"=>$request->input("description"),
            "short_desc"=>$request->input("short_desc"),
            "info"=>$request->input("info"),
            "type"=>$request->input("type"),
            "image"=>$request->file("image"),
            "image_more_1"=>$request->file("image_more_1"),
            "image_more_2"=>$request->file("image_more_2"),
            "video"=>$request->input("video"),
            "order"=>$request->input("order"),
        );
        $video = $data["video"];
        $route_image = $data["image"];
        $route_image_more_1 = $data["image_more_1"];
        $route_image_more_2 = $data["image_more_2"];

        if(!empty($data)){ 
            $validate_1 = Validator::make($data, [
                'title' => ['string', 'max:55'],
                'short_desc' => ['string', 'max:110'],
                'description' => ['required'],
                'info' => ['string'],
            ]);
            if($validate_1->fails()){
                return redirect('/admin/work/project') 
                    -> with('error-validation', '')
                    -> withErrors($validate_1)
                    -> withInput();
            }else{
                $validate_2 = Validator::make($data, [
                    'image' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:10240'],
                ]);
                if ($data["type"] == 'standard' || $data["type"] == 'gallery'){
                    if($route_image_more_1 != ''){
                        $validate_2 = Validator::make($data, [
                            'image_more_1' => ['file', 'mimes:jpg,jpeg,png', 'max:10240'],
                        ]);
                    }
                    if($route_image_more_2 != ''){
                        $validate_2 = Validator::make($data, [
                            'image_more_2' => ['file', 'mimes:jpg,jpeg,png', 'max:10240'],
                        ]);
                    }
                } else if ($data["type"] == 'video'){
                    $validate_2 = Validator::make($data, [
                        'video' => ['required', 'url'],
                    ]);
                    $video = '<iframe title="vimeo-player" src="'.$data["video"].'" width="900" height="400" frameborder="0" allowfullscreen></iframe>';
                } else {
                    $validate_2 = null;
                }
                if($validate_2 != null && $validate_2->fails()){
                    return redirect('/admin/work/project') 
                        -> with('error-validation', '')
                        -> withErrors($validate_2)
                        -> withInput();
                } else {

                    $directory = "uploads/img/work";    
                    if(!file_exists($directory)){  
                        mkdir($directory, 0777);
                    }   
                    $random = mt_rand(10,9999);
                    $route_image = $directory."/project_image_".$random.".".$data["image"]->guessExtension();
                    move_uploaded_file($data["image"]->getPathName(), $route_image);

                    if ($data["type"] == 'standard' || $data["type"] == 'gallery'){
                        $directory = "uploads/img/work";    
                        if(!file_exists($directory)){  
                            mkdir($directory, 0777);
                        }   
                        if($route_image_more_1 != ''){
                            $random = mt_rand(10,9999);
                            $route_image_more_1 = $directory."/project_image_".$random.".".$data["image_more_1"]->guessExtension();
                            move_uploaded_file($data["image_more_1"]->getPathName(), $route_image_more_1);
                        }
                        if($route_image_more_2 != ''){
                            $random = mt_rand(10,9999);
                            $route_image_more_2 = $directory."/project_image_".$random.".".$data["image_more_2"]->guessExtension();
                            move_uploaded_file($data["image_more_2"]->getPathName(), $route_image_more_2);
                        }
                    }

                    $source = glob("uploads/img/temp/*");
                    foreach ($source as $file){
                        copy($file, "uploads/img/work/".substr($file, 17));
                        unlink($file);
                    }

                    $project = new Work();
                    $project->enable = ($data['enable'] == 'on') ? 1: 0;
                    $project->title = $data["title"];
                    $project->type = $data["type"];
                    $project->short_desc = $data["short_desc"];
                    $project->images_code = $data["images_code"];
                    $project->description = str_replace('uploads/img/temp','uploads/img/work',$data['description']);
                    $project->image = $route_image;
                    $project->image_more_1 = $route_image_more_1;
                    $project->image_more_2 = $route_image_more_2;
                    $project->video = $video;
                    $project->info = $data["info"];
                    $project->order = $data["order"];
                    $project->category_id = $data["category"];
                    $project->save();    
                    return redirect('/admin/work/projects') -> with('ok-add', '');
                }
            }
        }else{
            return redirect('/admin/work/projects') -> with('error-validation', '');
        } 
    }

    /**********************************************
     * FUNCTION TO SHOW A SINGLE POST TO EDIT IT
     **********************************************/
    public function show($id)
    {
        $project = Work::find($id);
        $user = User::find(1);
        $categories = WorkCategory::all();
        if($project != null){
            return view('admin.pages.work.single')
                ->with('project', $project)
                ->with('categories', $categories)
                ->with('user', $user);
        } else {
            return redirect('/admin/work/projects');
        }
    }

    /***************************************
     * FUNCTION TO UPDATE A PROJECT
     ***************************************/
    public function update($id, Request $request)
    {
        // GET THE DATA VALUE
        $project = Work::find($id);
        $data = array(
            "id"=>$request->input("id"),
            "enable"=>$request->input("enable_project"),
            "title"=>$request->input("title"),
            "category"=>$request->input("category"),
            "description"=>$request->input("description"),
            "short_desc"=>$request->input("short_desc"),
            "info"=>$request->input("info"),
            "type"=>$request->input("type"),
            "image"=>$request->file("image"),
            "image_current"=>$request->input("image_current"),
            "image_more_1"=>$request->file("image_more_1"),
            "image_more_1_current"=>$request->input("image_more_1_current"),
            "image_more_2"=>$request->file("image_more_2"),
            "image_more_2_current"=>$request->input("image_more_2_current"),
            "video"=>$request->input("video"),
        );
        $video = $data["video"];
        $route_image = $data["image"];
        $route_image_current = $data["image_current"];
        $route_image_more_1 = $data["image_more_1"];
        $route_image_more_1_current = $data["image_more_1_current"];
        $route_image_more_2 = $data["image_more_2"];
        $route_image_more_2_current = $data["image_more_2_current"];

        if(!empty($data)){ 
            $validate_1 = Validator::make($data, [
                'title' => ['required', 'string', 'max:55'],
                'short_desc' => ['string', 'max:110'],
                'description' => ['required'],
                'info' => ['string'],
            ]);
            if($validate_1->fails()){
                return redirect('/admin/work/project/'.$data["id"]) 
                    -> with('error-validation', '')
                    -> withErrors($validate_1)
                    -> withInput();
            }else{
                $validate_2 = null;
                if($route_image != ''){
                    $validate_2 = Validator::make($data, [
                        'image' => ['file', 'mimes:jpg,jpeg,png', 'max:10240'],
                    ]);
                }
                if ($data["type"] == 'standard' || $data["type"] == 'gallery'){
                    if($route_image_more_1 != ''){
                        $validate_2 = Validator::make($data, [
                            'image_more_1' => ['file', 'mimes:jpg,jpeg,png', 'max:10240'],
                        ]);
                    }
                    if($route_image_more_2 != ''){
                        $validate_2 = Validator::make($data, [
                            'image_more_2' => ['file', 'mimes:jpg,jpeg,png', 'max:10240'],
                        ]);
                    }
                } else if ($data["type"] == 'video'){
                    $validate_2 = Validator::make($data, [
                        'video' => ['required', 'url'],
                    ]);
                    $video = '<iframe title="vimeo-player" src="'.$data["video"].'" width="900" height="500" frameborder="0" allowfullscreen></iframe>';
                } else {
                    $validate_2 = null;
                }
                if($validate_2 != null && $validate_2->fails()){
                    return redirect('/admin/work/project/'.$data["id"])
                        -> with('error-validation', '')
                        -> withErrors($validate_2)
                        -> withInput();
                } else {
                    if($route_image != ''){
                        if ($route_image_current != ''){
                            unlink($route_image_current);
                        }
                        $directory = "uploads/img/work";    
                        if(!file_exists($directory)){  
                            mkdir($directory, 0777);
                        }   
                        $random = mt_rand(10,9999);
                        $route_image = $directory."/project_image_".$random.".".$data["image"]->guessExtension();
                        move_uploaded_file($data["image"]->getPathName(), $route_image);
                    } else {
                        $route_image = $route_image_current;
                    }
                    if ($data["type"] == 'standard' || $data["type"] == 'gallery'){
                        if($route_image_more_1 != ''){
                            if ($route_image_more_1_current != ''){
                                unlink($route_image_more_1_current);
                            }
                            $directory = "uploads/img/work";    
                            if(!file_exists($directory)){  
                                mkdir($directory, 0777);
                            }   
                            $random = mt_rand(10,9999);
                            $route_image_more_1 = $directory."/project_image_".$random.".".$data["image_more_1"]->guessExtension();
                            move_uploaded_file($data["image_more_1"]->getPathName(), $route_image_more_1);
                        } else {
                            $route_image_more_1 = $route_image_more_1_current;
                        }
                        if($route_image_more_2 != ''){
                            if ($route_image_more_2_current != ''){
                                unlink($route_image_more_2_current);
                            }
                            $directory = "uploads/img/work";    
                            if(!file_exists($directory)){  
                                mkdir($directory, 0777);
                            }   
                            $random = mt_rand(10,9999);
                            $route_image_more_2 = $directory."/project_image_".$random.".".$data["image_more_2"]->guessExtension();
                            move_uploaded_file($data["image_more_2"]->getPathName(), $route_image_more_2);
                        } else {
                            $route_image_more_2 = $route_image_more_2_current;
                        }
                    } else {
                        if ($route_image_more_1_current != ''){
                            unlink($route_image_more_1_current);
                        }
                        if ($route_image_more_2_current != ''){
                            unlink($route_image_more_2_current);
                        }
                    }

                    if(empty($route_image_more_1) && empty($route_image_more_1_current) && !empty($project->image_more_1)){
                        unlink($project->image_more_1);
                    }

                    if(empty($route_image_more_2) && empty($route_image_more_2_current) && !empty($project->image_more_2)){
                        unlink($project->image_more_2);
                    }

                    $source = glob("uploads/img/temp/*");
                    foreach ($source as $file){
                        copy($file, "uploads/img/work/".substr($file, 17));
                        unlink($file);
                    }

                    $data_new = array(
                        "enable"=>($data['enable'] == 'on') ? 1: 0,
                        "title"=>$data['title'],
                        "type"=>$data['type'],
                        "short_desc"=>$data['short_desc'],
                        "description" => str_replace('uploads/img/temp','uploads/img/work',$data['description']),
                        "image"=>$route_image,
                        "image_more_1"=>$route_image_more_1,
                        "image_more_2"=>$route_image_more_2,
                        "video"=>$video,
                        "info"=>$data['info'],
                        "category_id"=>$data['category']
                    );
                    Work::where("id", $id)->update($data_new);
                    return redirect('/admin/work/projects') -> with('ok-update', '');
                }            
            }
        }else{
            return redirect('/admin/work/projects') -> with('error-validation', '');
        } 
    }

    /***************************************************
     * FUNCTION TO UPDATE THE ORDER OF A PROJECT -> UP
     ***************************************************/
    public function orderUp($id)
    {
        $project_1 = Work::where("id", $id)->get();
        $project_2 = DB::table('project')
            ->where('order', '=', $project_1[0]['order']-1)
            ->get() ;
        // UPDATE THE ORDER OF THE ELEMENT SELECTED
        $data_new_1 = array(
            "order"=>$project_2[0]->order,
        );
        Work::where("id", $project_1[0]['id'])->update($data_new_1);
        // UPDATE THE ORDER OF THE PREVIOUS ELEMENT
        $data_new_2 = array(
            "order"=>$project_1[0]['order'],
        );
        Work::where("id", $project_2[0]->id)->update($data_new_2);
        return redirect('/admin/work/projects') -> with('ok-update', '');
    }

    /***************************************************
     * FUNCTION TO UPDATE THE ORDER OF A PROJECT -> DOWN
     ***************************************************/
    public function orderDown($id)
    {
        $project_1 = Work::where("id", $id)->get();
        $project_2 = DB::table('project')
            ->where('order', '=', $project_1[0]['order']+1)
            ->get() ;
        // UPDATE THE ORDER OF THE ELEMENT SELECTED
        $data_new_1 = array(
            "order"=>$project_2[0]->order,
        );
        Work::where("id", $project_1[0]['id'])->update($data_new_1);
        // UPDATE THE ORDER OF THE PREVIOUS ELEMENT
        $data_new_2 = array(
            "order"=>$project_1[0]['order'],
        );
        Work::where("id", $project_2[0]->id)->update($data_new_2);
        return redirect('/admin/work/projects') -> with('ok-update', '');
    }

    /*******************************
     * FUNCTION TO DELETE A PROJECT
     *******************************/
    public function destroy($id, Request $request){
        $validate = Work::where("id", $id)->get();
        if(!empty($validate)){
            $source = glob("uploads/img/work/*");
            foreach ($source as $file){
                $pos = strpos($file, $validate[0]['images_code']);
                if ($pos !== false) {
                    unlink($file);
                } 
            }
            if ($validate[0]['type'] == 'gallery'){
                $images = WorkGallery::where("project_id", $id)->get();
                if (count($images) > 0){
                    foreach ($images as $image) {
                        unlink($image['image']);
                    }
                } 
            }
            unlink($validate[0]['image']);
            if($validate[0]['image_more_1'] != ''){
                unlink($validate[0]['image_more_1']);
            }
            if($validate[0]['image_more_2'] != ''){
                unlink($validate[0]['image_more_2']);
            }
            $project = Work::where("id", $validate[0]['id'])->delete();
            // SET UP THE NEW ORDER FOR THE REST OF THE PROJECTS
            $projects = DB::table('project')
                ->orderBy('order', 'asc')
                ->get() ;
            $i = 1;
            foreach ($projects as $project):
                $data_new = array(
                    "order"=>$i,
                );
                Work::where("id", $project->id)->update($data_new);
                $i++;
            endforeach;
            return redirect('/admin/work/projects') -> with('ok-delete', '');
        } else {
            return redirect('/admin/work/projects') -> with('no-delete', '');
        }
    }

}
