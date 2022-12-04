<?php

namespace App\Http\Controllers;

use App\Models\General;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class GeneralController extends Controller
{
    
    /*****************************************
     * FUNCTION TO SHOW THE GENERAL OPTIONS
     *****************************************/
    public function index()
    {
        $general = General::find(1);
        $user = User::find(1);
        return view('admin.pages.general')
            ->with('general', $general)
            ->with('user', $user);
    }

    /*****************************************
     * FUNCTION TO UPDATE THE GENERAL OPTIONS
     *****************************************/
    public function update(Request $request, General $general)
    {
        // GET THE DATA VALUE
        $general = General::find(1);
        $data = array(
            "title"=>$request->input("title"),
            "description"=>$request->input("description"),
            "keywords"=>$request->input("keywords"),
            "analytics_code"=>$request->input("analytics_code"),
            "image_favicon"=>$request->file("image_favicon"),
            "image_favicon_current"=>$request->input("image_favicon_current"),
            "image_logo_header_light"=>$request->file("image_logo_header_light"),
            "image_logo_header_light_current"=>$request->input("image_logo_header_light_current"),
            "image_logo_header_dark"=>$request->file("image_logo_header_dark"),
            "image_logo_header_dark_current"=>$request->input("image_logo_header_dark_current"),
            "menu_position"=>$request->input("menu_position"),
            "social_links"=>$request->input("social_links"),
            "loader"=>$request->input("loader"),
            "image_logo_loader"=>$request->file("image_logo_loader"),
            "image_logo_loader_current"=>$request->input("image_logo_loader_current"),
            "loader_scheme_color"=>$request->input("loader_scheme_color"),
            "cookies_enable"=>$request->input("cookies_enable"),
            "cookies_style"=>$request->input("cookies_style"),
            "cookies_color"=>$request->input("cookies_color"),
            "cookies_alignment"=>$request->input("cookies_alignment"),
            "cookies_title"=>$request->input("cookies_title"),
            "cookies_text"=>$request->input("cookies_text"),
        );
        $route_image_favicon = $data['image_favicon_current'];
        $route_image_logo_header_light = $data['image_logo_header_light_current'];
        $route_image_logo_header_dark = $data['image_logo_header_dark_current'];
        $route_image_loader = $data['image_logo_loader_current'];

        if(!empty($data)){ 
            $validate = Validator::make($data, [
                'title' => ['string', 'max:55'],
                'description' => ['string', 'max:255'],
                'keywords' => ['string', 'max:510'],
                'analytics_code' => ['nullable','string', 'max:55'],
                'social_links' => ['string'],
                'cookies_title' => ['nullable', 'string', 'max:55'],
                'cookies_text' => ['string'],
            ]);
            if($validate->fails()){
                return redirect('/admin/general') 
                    -> with('error-validation', '')
                    -> withErrors($validate)
                    -> withInput();
            }else{
                if (!empty($data["image_favicon"])){
                    $validate = Validator::make($data, [
                        'image_favicon' => ['file', 'mimes:png', 'max:1024', 'dimensions:min_width=155,min_height=155'],
                    ]);
                    if($validate->fails()){
                        return redirect('/admin/general') 
                            -> with('error-validation', '')
                            -> withErrors($validate)
                            -> withInput();
                    } else {
                        if ($route_image_favicon != ''){
                            $source = glob("uploads/img/general/favicon/*");
                            foreach ($source as $file){
                                unlink($file);
                            }
                        }
                        $directory = "uploads/img/general/favicon";    
                        if(!file_exists($directory)){  
                            mkdir($directory, 0777);
                        }  
                        $route_image_favicon = $directory."/favicon.".$data["image_favicon"]->guessExtension();
                        list($width, $height) = getimagesize($data["image_favicon"]);
                        $favicon_dimensions = ['96', '57', '72', '76', '114', '120', '144', '152'];
                        $source = imagecreatefrompng($data["image_favicon"]);
                        foreach ($favicon_dimensions as $dimension){
                            if ($dimension == '96'){
                                $route = $directory."/favicon.".$data["image_favicon"]->guessExtension();
                            } else {
                                $route = $directory."/apple-touch-icon-".$dimension."x".$dimension."-precomposed.".$data["image_favicon"]->guessExtension();
                            }
                            $destiny = imagecreatetruecolor($dimension, $dimension);
                            imagealphablending($destiny, FALSE); 
                            imagesavealpha($destiny, TRUE);
                            imagecopyresampled($destiny, $source, 0, 0, 0, 0, $dimension, $dimension, $width, $height);
                            imagepng($destiny, $route);   
                        }
                    }
                }
                if(empty($data["image_favicon"]) && empty($data["image_favicon_current"]) && !empty($general->image_favicon)){
                    $source = glob("uploads/img/general/favicon/*");
                    foreach ($source as $file){
                        unlink($file);
                    }
                }
                if (!empty($data["image_logo_header_light"])){
                    $validate = Validator::make($data, [
                        'image_logo_header_light' => ['file', 'mimes:jpg,jpeg,png', 'max:10240'],
                    ]);
                    if($validate->fails()){
                        return redirect('/admin/general') 
                            -> with('error-validation', '')
                            -> withErrors($validate)
                            -> withInput();
                    } else {
                        if ($route_image_logo_header_light != ''){
                            unlink($route_image_logo_header_light);
                        }
                        $directory = "uploads/img/general";    
                        if(!file_exists($directory)){  
                            mkdir($directory, 0777);
                        }   
                        $route_image_logo_header_light = $directory."/logo_header_light.".$data["image_logo_header_light"]->guessExtension();
                        move_uploaded_file($data["image_logo_header_light"]->getPathName(), $route_image_logo_header_light);
                    }
                }
                if(empty($data["image_logo_header_light"]) && empty($data["image_logo_header_light_current"]) && !empty($general->image_logo_header_light)){
                    unlink($general->image_logo_header_light);
                }
                if (!empty($data["image_logo_header_dark"])){
                    $validate = Validator::make($data, [
                        'image_logo_header_dark' => ['file', 'mimes:jpg,jpeg,png', 'max:10240'],
                    ]);
                    if($validate->fails()){
                        return redirect('/admin/general') 
                            -> with('error-validation', '')
                            -> withErrors($validate)
                            -> withInput();
                    } else {
                        if ($route_image_logo_header_dark != ''){
                            unlink($route_image_logo_header_dark);
                        }
                        $directory = "uploads/img/general";    
                        if(!file_exists($directory)){  
                            mkdir($directory, 0777);
                        }   
                        $route_image_logo_header_dark = $directory."/logo_header_dark.".$data["image_logo_header_dark"]->guessExtension();
                        move_uploaded_file($data["image_logo_header_dark"]->getPathName(), $route_image_logo_header_dark);
                    }
                }
                if(empty($data["image_logo_header_dark"]) && empty($data["image_logo_header_dark_current"]) && !empty($general->image_logo_header_dark)){
                    unlink($general->image_logo_header_dark);
                }
                if (!empty($data["image_logo_loader"])){
                    $validate = Validator::make($data, [
                        'image_logo_loader' => ['file', 'mimes:jpg,jpeg,png', 'max:10240'],
                    ]);
                    if($validate->fails()){
                        return redirect('/admin/general') 
                            -> with('error-validation', '')
                            -> withErrors($validate)
                            -> withInput();
                    } else {
                        if ($route_image_loader != ''){
                            unlink($route_image_loader);
                        }
                        $directory = "uploads/img/general";    
                        if(!file_exists($directory)){  
                            mkdir($directory, 0777);
                        }   
                        $random = mt_rand(100,999);
                        $route_image_loader = $directory."/loader_".$random.".".$data["image_logo_loader"]->guessExtension();
                        move_uploaded_file($data["image_logo_loader"]->getPathName(), $route_image_loader);
                    }
                }
                if(empty($data["image_logo_loader"]) && empty($data["image_logo_loader_current"]) && !empty($general->image_logo_loader)){
                    unlink($general->image_logo_loader);
                }
                $data_new = array(
                    "title"=>$data['title'],
                    "description"=>$data['description'],
                    "keywords"=>$data['keywords'],
                    "analytics_code"=>$data['analytics_code'],
                    "image_favicon"=>$route_image_favicon,
                    "image_logo_header_light"=>$route_image_logo_header_light,
                    "image_logo_header_dark"=>$route_image_logo_header_dark,
                    "menu_position"=>$data['menu_position'],
                    "social_links"=>$data['social_links'],
                    "loader"=>($data['loader'] == 'on') ? 1: 0,
                    "image_logo_loader"=>$route_image_loader,
                    "loader_scheme_color"=>$data['loader_scheme_color'],
                    "cookies_enable"=>($data['cookies_enable'] == 'on') ? 1: 0,
                    "cookies_style"=>$data['cookies_style'],
                    "cookies_color"=>$data['cookies_color'],
                    "cookies_alignment"=>$data['cookies_alignment'],
                    "cookies_title"=>$data['cookies_title'],
                    "cookies_text"=>$data['cookies_text'],
                );
                General::where("id", '1')->update($data_new);
                return redirect('/admin/general') -> with('ok-update', '');
            }
        } else {
            return redirect('/admin/general') -> with('error-validation', '');
        }
    }

}
