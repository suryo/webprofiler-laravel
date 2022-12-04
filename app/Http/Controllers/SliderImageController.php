<?php

namespace App\Http\Controllers;

use App\Models\SliderImage;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SliderImageController extends Controller
{
    /*******************************
     * FUNCTION TO SHOW THE IMAGES
     *******************************/
    public function index($id)
    {
        $slider_images = SliderImage::where("slider_id", $id)->get();
        $user = User::find(1);
        if(count($slider_images) > 0){
        return view('admin.pages.sliders.images')
            ->with('slider_images', $slider_images)
            ->with('user', $user);
        } else {
            return redirect('/admin/sliders');
        }
    }

    /*******************************
     * FUNCTION TO CREATE AN IMAGE FOR THE SLIDER
     *******************************/
    public function store(Request $request)
    {
        // GET THE DATA VALUE
        $data = array(
            "slider_image"=>$request->file("slider_image"),
            "slider_id"=>$request->input("slider_id"),
        );
        if(!empty($data)){
            $validate = Validator::make($data, [
                "slider_image" => "required|file|mimes:jpg,jpeg,png|max:10240",
            ]);
            if($validate->fails()){
                return redirect('/admin/sliders') -> with('error-validation-image', '');
            }else{
                $directory = "uploads/img/sliders";    
                if(!file_exists($directory)){  
                    mkdir($directory, 0777);
                }   
                $random = mt_rand(100,999);
                $route_image = $directory."/slider_image_".$random.".".$data["slider_image"]->guessExtension();
                list($width, $height) = getimagesize($data["slider_image"]);
                $newWidth = 1024;
                $newHeight = 768;
                if($data["slider_image"]->guessExtension() == "jpeg" || $data["slider_image"]->guessExtension() == "jpg"){
                    $source = imagecreatefromjpeg($data["slider_image"]);
                    $destiny = imagecreatetruecolor($newWidth, $newHeight);
                    imagecopyresized($destiny, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                    imagejpeg($destiny, $route_image);
                }
                if($data["slider_image"]->guessExtension() == "png"){
                    $source = imagecreatefrompng($data["slider_image"]);
                    $destiny = imagecreatetruecolor($newWidth, $newHeight);
                    imagealphablending($destiny, FALSE); 
                    imagesavealpha($destiny, TRUE);
                    imagecopyresampled($destiny, $source, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
                    imagepng($destiny, $route_image);   
                }
                $slider_image = new SliderImage();
                $slider_image->image = $route_image;
                $slider_image->slider_id = $data['slider_id'];
                $slider_image->save();    
                return redirect('/admin/sliders') -> with('ok-add', '');
            }
        }else{
            return redirect('/admin/sliders') -> with('error-validation', '');
        } 
    }

    /*******************************
     * FUNCTION TO DELETE AN IMAGE
     *******************************/
    public function destroy($id, Request $request){
        $validate = SliderImage::where("id", $id)->get();
        $slider_id = $request->input("slider_id");
        if(!empty($validate)){
            unlink($validate[0]['image']);
            SliderImage::where("id", $id)->delete();
            return redirect('/admin/sliders/images/'.$slider_id) -> with('ok-delete', '');
        } else {
            return redirect('/admin/sliders/images/'.$slider_id) -> with('no-delete', '');
        }
    }

}
