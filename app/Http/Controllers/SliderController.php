<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\SliderImage;
use App\Models\User;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SliderController extends Controller
{
    
    /*******************************
     * FUNCTION TO SHOW THE SLIDERS
     *******************************/
    public function index()
    {
        $sliders = Slider::all();
        $slider_images = SliderImage::all();
        $user = User::find(1);
        include(app_path() . '/Functions/ArrayAnimations.php');
        return view('admin.pages.sliders.sliders')
            ->with('sliders', $sliders)
            ->with('animations_in', $animations_in)
            ->with('animations_out', $animations_out)
            ->with('slider_images', $slider_images)
            ->with('user', $user);
    }

    /*******************************
     * FUNCTION TO CREATE A SLIDER
     *******************************/
    public function store(Request $request)
    {
        // GET THE DATA VALUE
        $data = array(
            "slider_type"=>$request->input("slider_type"),
            "slider_overlay_color"=>$request->input("slider_overlay_color"),
            "slider_overlay_type"=>$request->input("slider_overlay_type"),
            "slider_overlay_color_1"=>$request->input("slider_overlay_color_1"),
            "slider_overlay_color_2"=>$request->input("slider_overlay_color_2"),
            "slider_overlay_gradient_type"=>$request->input("slider_overlay_gradient_type"),
            "slider_scheme_color"=>$request->input("slider_scheme_color"),
            "slider_text_rotator"=>$request->input("slider_text_rotator"),
            "slider_interval_rotator"=>$request->input("slider_interval_rotator"),
            "slider_text"=>$request->input("slider_text"),      
            "slider_video_type"=>$request->input("slider_video_type"),
            "slider_server_video"=>$request->file("slider_server_video"),
            "slider_url_video"=>$request->input("slider_url_video"),
            "slider_image_video"=>$request->file("image_video"),
            "slider_text_animation_in"=>$request->input("slider_text_animation_in"),
            "slider_text_animation_out"=>$request->input("slider_text_animation_out"),
        );
        //dd($data);
        $route_video = null;
        $route_image = null;

        if(!empty($data)){ 
            if ($data['slider_type'] == 'video'){ 
                if ($data['slider_video_type'] == 'server'){
                    $validate = Validator::make($data, [
                        "slider_text" => ['string', 'max:255'],
                        "slider_server_video" => "required|file|mimes:mp4,avi|max:10240",
                    ]);
                    if($validate->fails()){
                        return redirect('/admin/sliders') -> with('error-validation-video', '');
                    }else{
                        $directory = "uploads/videos/sliders";    
                        if(!file_exists($directory)){  
                            mkdir($directory, 0777);
                        }  
                        $random = mt_rand(10,9999);
                        $route_video = $directory."/slider_video_".$random.".".$data["slider_server_video"]->guessExtension();
                        move_uploaded_file($data["slider_server_video"]->getPathName(), $route_video);
                    }
                } else {
                    $validate = Validator::make($data, [
                        "slider_text" => ['string', 'max:255'],
                        "slider_url_video" => 'required|url',
                    ]);
                    if($validate->fails()){
                        return redirect('/admin/sliders') -> with('error-validation-video', '');
                    }else{
                        $route_video = $data["slider_url_video"];      
                    }
                }
                if ($route_image != ''){
                    $validate = Validator::make($data, [
                        'slider_image_video' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:10240'],
                    ]);
                    if($validate != null && $validate->fails()){
                        return redirect('/admin/sliders')
                            -> with('error-validation', '')
                            -> withErrors($validate)
                            -> withInput();
                    } else {
                        $directory = "uploads/img/sliders";    
                        if(!file_exists($directory)){  
                            mkdir($directory, 0777);
                        }   
                        $random = mt_rand(10,9999);
                        $route_image = $directory."/poster_image_".$random.".".$data["slider_image_video"]->guessExtension();
                        move_uploaded_file($data["slider_image_video"]->getPathName(), $route_image);
                    }
                }
            }
            $slider = new Slider();
            $slider->type = $data['slider_type'];
            $slider->overlay_color = ($data['slider_overlay_color'] == 'on') ? 1: 0;
            $slider->overlay_type = $data['slider_overlay_type'];
            $slider->color_1 = $data['slider_overlay_color_1'];
            $slider->color_2 = $data['slider_overlay_color_2'];
            $slider->gradient_type = $data['slider_overlay_gradient_type'];
            $slider->video = $route_video;
            $slider->video_type = $data['slider_video_type'];
            $slider->image_video = $route_image;
            $slider->color_scheme = $data['slider_scheme_color'];
            $slider->text_rotator = ($data['slider_text_rotator'] == 'on') ? 1: 0;
            $slider->text_rotator_interval = $data['slider_interval_rotator'];
            $slider->text = $data['slider_text'];
            $slider->animation_in = $data['slider_text_animation_in'];
            $slider->animation_out = $data['slider_text_animation_out'];
            $slider->save();    
            return redirect('/admin/sliders') -> with('ok-add', '');
        }else{
            return redirect('/admin/sliders') -> with('error-validation', '');
        } 
    }

    /*******************************
     * FUNCTION TO SHOW A SLIDER
     *******************************/
    public function show($id)
    {
        $slider = Slider::find($id);
        $user = User::find(1);
        include(app_path() . '/Functions/ArrayAnimations.php');
        if($slider != null){
            return view('admin.pages.sliders.single')
                ->with('slider', $slider)
                ->with('animations_in', $animations_in)
                ->with('animations_out', $animations_out)
                ->with('user', $user);
        } else {
            return redirect('/admin/sliders');
        }
    }

    /*******************************
     * FUNCTION TO UPDATE A SLIDER
     *******************************/
    public function update($id, Request $request)
    {
        // GET THE DATA VALUE
        $slider = Slider::find($id);
        $data = array(
            "slider_type"=>$request->input("slider_type"),
            "slider_overlay_color"=>$request->input("slider_overlay_color"),
            "slider_overlay_type"=>$request->input("slider_overlay_type"),
            "slider_overlay_color_1"=>$request->input("slider_overlay_color_1"),
            "slider_overlay_color_2"=>$request->input("slider_overlay_color_2"),
            "slider_overlay_gradient_type"=>$request->input("slider_overlay_gradient_type"),
            "slider_scheme_color"=>$request->input("slider_scheme_color"),
            "slider_text_rotator"=>$request->input("slider_text_rotator"),
            "slider_interval_rotator"=>$request->input("slider_interval_rotator"),
            "slider_text"=>$request->input("slider_text"),
            "slider_video_type"=>$request->input("slider_video_type"),
            "slider_server_video"=>$request->file("slider_server_video"),
            "slider_server_video_current"=>$request->input("slider_server_video_current"),
            "slider_url_video"=>$request->input("slider_url_video"),
            "slider_image_video"=>$request->file("image_video"),
            "slider_image_video_current"=>$request->input("image_video_current"),
            "slider_text_animation_in"=>$request->input("slider_text_animation_in"),
            "slider_text_animation_out"=>$request->input("slider_text_animation_out")
        );
        //dd($data);
        $route_video = $data['slider_server_video_current'];
        $route_image = $data["slider_image_video"];
        $route_image_current = $data["slider_image_video_current"];

        if(!empty($data)){ 
            if ($data['slider_type'] == 'video'){ 
                if ($data['slider_video_type'] == 'server'){
                    if ($data['slider_server_video'] != null){
                        $validate = Validator::make($data, [
                            "slider_text" => ['string', 'max:255'],
                            "slider_server_video" => "required|file|mimes:mp4,mov,avi|max:10240",
                        ]);
                        if($validate->fails()){
                            return redirect('/admin/sliders/'.$id)
                                -> with('error-validation-video', '')
                                -> withErrors($validate)
                                -> withInput();
                        }else{
                            $directory = "uploads/videos/sliders";    
                            if(!file_exists($directory)){  
                                mkdir($directory, 0777);
                            }  
                            $random = mt_rand(10,9999);
                            $route_video = $directory."/slider_video_".$random.".".$data["slider_server_video"]->guessExtension();
                            move_uploaded_file($data["slider_server_video"]->getPathName(), $route_video);
                        }
                    }else{
                        $validate = Validator::make($data, [
                            "slider_text" => ['string', 'max:255'],
                        ]);
                        if($validate->fails()){
                            return redirect('/admin/sliders/'.$id)
                                -> with('error-validation-video', '')
                                -> withErrors($validate)
                                -> withInput();
                        }
                    }
                } else {
                    $validate = Validator::make($data, [
                        "slider_text" => ['string', 'max:255'],
                        "slider_url_video" => 'required|url',
                    ]);
                    if($validate->fails()){
                        return redirect('/admin/sliders/'.$id)
                            -> with('error-validation-video', '')
                            -> withErrors($validate)
                            -> withInput();
                    }else{
                        $route_video = $data["slider_url_video"];      
                    }
                }
                if ($route_image != ''){
                    $validate = Validator::make($data, [
                        'slider_image_video' => ['required', 'file', 'mimes:jpg,jpeg,png', 'max:10240'],
                    ]);
                    if($validate != null && $validate->fails()){
                        return redirect('/admin/sliders/'.$id)
                            -> with('error-validation-video', '')
                            -> withErrors($validate)
                            -> withInput();
                    } else {
                        if($route_image != ''){
                            if ($route_image_current != ''){
                                unlink($route_image_current);
                            }
                            $directory = "uploads/img/sliders";    
                            if(!file_exists($directory)){  
                                mkdir($directory, 0777);
                            }   
                            $random = mt_rand(10,9999);
                            $route_image = $directory."/poster_image_".$random.".".$data["slider_image_video"]->guessExtension();
                            move_uploaded_file($data["slider_image_video"]->getPathName(), $route_image);
                        } 
                    }
                } else {
                    $route_image = $route_image_current;
                }
            } else{
                $validate = Validator::make($data, [
                    "slider_text" => ['string', 'max:255'],
                ]);
                if($validate->fails()){
                    return redirect('/admin/sliders/'.$id) 
                        -> with('error-validation', '')
                        -> withErrors($validate)
                        -> withInput();
                }
                if (!empty($data["slider_image_video_current"])){
                    $route_image = $route_image_current;
                }
            }
            if(empty($data["slider_image_video"]) && empty($data["slider_image_video_current"]) && !empty($slider->image_video)){
                unlink($slider->image_video);
            }
            $data_new = array(
                "type"=>$data['slider_type'],
                "overlay_color"=>($data['slider_overlay_color'] == 'on') ? 1: 0,
                "overlay_type"=>$data['slider_overlay_type'],
                "color_1"=>$data['slider_overlay_color_1'],
                "color_2"=>$data['slider_overlay_color_2'],
                "gradient_type"=>$data['slider_overlay_gradient_type'],
                "video"=>$route_video,
                "video_type"=>$data['slider_video_type'],
                "image_video"=>$route_image,
                "color_scheme"=>$data['slider_scheme_color'],
                "text_rotator"=>($data['slider_text_rotator'] == 'on') ? 1: 0,
                "text"=>$data['slider_text'],
                "text_rotator_interval"=>$data['slider_interval_rotator'],
                "animation_in"=>$data['slider_text_animation_in'],
                "animation_out"=>$data['slider_text_animation_out'],
            );
            Slider::where("id", $id)->update($data_new);
            return redirect('/admin/sliders') -> with('ok-update', '');
        } else {
            return redirect('/admin/sliders/'.$id) -> with('error-validation', '');
        }

    }

    /*******************************
     * FUNCTION TO DELETE A SLIDER
     *******************************/
    public function destroy($id, Request $request){
        $validate = Slider::where("id", $id)->get();
        $section = Section::find(1);
        if(!empty($validate)){
            if ($validate[0]['type'] == 'image'){
                $images = SliderImage::where("slider_id", $id)->get();
                if (count($images) > 0){
                    foreach ($images as $image) {
                        unlink($image['image']);
                    }
                } 
            }
            if ($validate[0]['video'] != null && $validate[0]['video_type'] == 'server'){
                unlink($validate[0]['video']);
            }
            if ($validate[0]['id'] == $section->slider_id){
                $data_new = array(
                    "slider_id"=>null,
                );
                Section::where("id", '1')->update($data_new);
            }
            $slider = Slider::where("id", $validate[0]['id'])->delete();
            return redirect('/admin/sliders') -> with('ok-delete', '');
        } else {
            return redirect('/admin/sliders') -> with('no-delete', '');
        }
    }
}
