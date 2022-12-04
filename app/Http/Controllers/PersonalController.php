<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PersonalController extends Controller
{
    /*****************************************
     * FUNCTION TO SHOW THE PERSONAL INFO
     *****************************************/
    public function index()
    {
        $personal = Personal::find(1);
        $user = User::find(1);
        return view('admin.pages.personal')
            ->with('personal', $personal)
            ->with('user', $user);
    }

    /*****************************************
     * FUNCTION TO UPDATE THE PERSONAL INFO
     *****************************************/
    public function update(Request $request, Personal $personal)
    {
        // GET THE DATA VALUE
        $personal = Personal::find(1);
        $data = array(
            "image_current"=>$request->input("image_profile_current"),
            "image"=>$request->file("image_profile"),
            "title"=>$request->input("title"),
            "description"=>$request->input("description"),
            "cv_enable"=>$request->input("cv_enable"),
            "cv_text"=>$request->input("cv_text"),
            "cv_file"=>$request->file("cvfile"),
            "cv_file_current"=>$request->input("cv_file_current"),
            "personal_info"=>$request->input("personal_info"),
        );
        $route_image = $data['image_current'];
        $route_cv = $data['cv_file_current'];

        if(!empty($data)){ 
            $validate = Validator::make($data, [
                'title' => ['string', 'max:75'],
                'description' => ['string', 'max:255'],
                'personal_info' => ['string']
            ]);
            if($validate->fails()){
                return redirect('/admin/personal') 
                    -> with('error-validation', '')
                    -> withErrors($validate)
                    -> withInput();
            }else{
                if ($data["cv_enable"] == 'on' && !empty($data["cv_file"])){
                    $validate = Validator::make($data, [
                        'cv_text' => ['required', 'string', 'max:55'],
                        'cv_file' => ['required', 'file', 'mimes:pdf,doc,docx,png,jpg,jpeg', 'max:10240']
                    ]);
                    if($validate->fails()){
                        return redirect('/admin/personal') 
                            -> with('error-validation-cv', '')
                            -> withErrors($validate)
                            -> withInput();
                    } else {
                        if ($route_cv != ''){
                            unlink($route_cv);
                        }
                        $directory = "uploads/files/personal";    
                        if(!file_exists($directory)){  
                            mkdir($directory, 0777);
                        }   
                        $random = mt_rand(100,999);
                        $route_cv = $directory."/cv_file_".$random.".".$data["cv_file"]->guessExtension();
                        move_uploaded_file($data["cv_file"]->getPathName(), $route_cv);
                    }
                }
                if (!empty($data["image"])){
                    if ($route_image != ''){
                        unlink($route_image);
                    }
                    $directory = "uploads/img/personal";    
                    if(!file_exists($directory)){  
                        mkdir($directory, 0777);
                    }   
                    $random = mt_rand(100,999);
                    $route_image = $directory."/personal_image.".$data["image"]->guessExtension();
                    move_uploaded_file($data["image"]->getPathName(), $route_image);
                }
                if(empty($data["image"]) && empty($data["image_current"]) && !empty($personal->image)){
                    unlink($personal->image);
                }
                $data_new = array(
                    "image"=>$route_image,
                    "title"=>$data['title'],
                    "description"=>$data['description'],
                    "cv_enable"=>($data['cv_enable'] == 'on') ? 1: 0,
                    "cv_text"=>$data['cv_text'],
                    "cv_file"=>$route_cv,
                    "info"=>$data['personal_info']
                );
                Personal::where("id", '1')->update($data_new);
                return redirect('/admin/personal') -> with('ok-update', '');
            }
        } else {
            return redirect('/admin/personal') -> with('error-validation', '');
        }
    }

}
