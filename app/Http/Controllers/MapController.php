<?php

namespace App\Http\Controllers;

use App\Models\Map;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;

class MapController extends Controller
{
    
    /*****************************************
     * FUNCTION TO SHOW THE MAP
     *****************************************/
    public function index()
    {
        $map = Map::find(1);
        $user = User::find(1);
        return view('admin.pages.map')
            ->with('map', $map)
            ->with('user', $user);
    }

    /*****************************************
     * FUNCTION TO UPDATE THE MAP 
     *****************************************/
    public function update(Request $request, Map $map)
    {
        // GET THE DATA VALUE
        $map = Map::find(1);
        $data = array(
            "latitude"=>$request->input("latitude"),
            "longitude"=>$request->input("longitude"),
            "zoom"=>$request->input("zoom"),
            "map_style"=>$request->input("map_style"),
            "map_text"=>$request->input("map_text"),
            "map_key"=>$request->input("map_key"),
            "icon_image"=>$request->file("icon_image"),
            "icon_image_current"=>$request->input("icon_image_current"),
        );
        $icon_image = $data['icon_image_current'];

        if(!empty($data)){ 
            $validate = Validator::make($data, [
                'latitude' => ['numeric', 'min:-90', 'max:90'],
                'longitude' => ['string', 'max:55'],
                'zoom' => ['string', 'max:55'],
                'map_style' => ['string', 'max:55'],
                'map_text' => ['string', 'max:55'],
                'map_key' => ['string'],
            ]);
            if($validate->fails()){
                return redirect('/admin/map') 
                    -> with('error-validation', '')
                    -> withErrors($validate)
                    -> withInput();
            }else{
                if (!empty($data["icon_image"])){
                    $validate = Validator::make($data, [
                        'icon_image' => ['file', 'mimes:jpg,jpeg,png', 'max:10240'],
                    ]);
                    if($validate->fails()){
                        return redirect('/admin/map') 
                            -> with('error-validation', '')
                            -> withErrors($validate)
                            -> withInput();
                    } else {
                        if ($icon_image != ''){
                            unlink($icon_image);
                        }
                        $directory = "uploads/img/map";    
                        if(!file_exists($directory)){  
                            mkdir($directory, 0777);
                        }   
                        $icon_image = $directory."/icon_map.".$data["icon_image"]->guessExtension();
                        move_uploaded_file($data["icon_image"]->getPathName(), $icon_image);
                    }
                }
                if(empty($data["icon_image"]) && empty($data["icon_image_current"]) && !empty($map->icon_image)){
                    unlink($map->icon_image);
                    $icon_image = null;
                }
                $data_new = array(
                    "latitude"=>$data['latitude'],
                    "longitude"=>$data['longitude'],
                    "zoom"=>$data['zoom'],
                    "map_style"=>$data['map_style'],
                    "map_text"=>$data['map_text'],
                    "map_key"=>$data['map_key'],
                    "icon_image"=>$icon_image,
                );
                Map::where("id", '1')->update($data_new);
                return redirect('/admin/map') -> with('ok-update', '');
            }
        } else {
            return redirect('/admin/map') -> with('error-validation', '');
        }
    }

}
