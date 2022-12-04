<?php

namespace App\Http\Controllers;

use App\Models\Style;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class StyleController extends Controller
{
    
    /*****************************************
     * FUNCTION TO SHOW THE STYLE OPTIONS
     *****************************************/
    public function index()
    {
        $style = Style::find(1);
        $user = User::find(1);
        include(app_path() . '/Functions/ArrayGoogleFonts.php');
        include(app_path() . '/Functions/ArrayGoogleFontsHeading.php');
        return view('admin.pages.style')
            ->with('style', $style)
            ->with('fonts', $fonts)
            ->with('fonts_heading', $fonts_heading)
            ->with('user', $user);
    }

    /*****************************************
     * FUNCTION TO UPDATE THE STYLE OPTIONS
     *****************************************/
    public function update(Request $request, Style $style)
    {
        // GET THE DATA VALUE
        $data = array(
            "font_head"=>$request->input("font_head"),
            "font_main"=>$request->input("font_main"),
            "light_head_color"=>$request->input("light_head_color"),
            "light_main_color"=>$request->input("light_main_color"),
            "light_accent_color"=>$request->input("light_accent_color"),
            "light_accent_hover_color"=>$request->input("light_accent_hover_color"),
            "light_back_main_color"=>$request->input("light_back_main_color"),
            "light_back_secondary_color"=>$request->input("light_back_secondary_color"),
            "dark_head_color"=>$request->input("dark_head_color"),
            "dark_main_color"=>$request->input("dark_main_color"),
            "dark_accent_color"=>$request->input("dark_accent_color"),
            "dark_accent_hover_color"=>$request->input("dark_accent_hover_color"),
            "dark_back_main_color"=>$request->input("dark_back_main_color"),
            "dark_back_secondary_color"=>$request->input("dark_back_secondary_color"),
        );
        //dd($data);

        if(!empty($data)){ 
            $data_new = array(
                "font_head"=>$data['font_head'],
                "font_main"=>$data['font_main'],
                "light_head_color"=>$data['light_head_color'],
                "light_main_color"=>$data['light_main_color'],
                "light_accent_color"=>$data['light_accent_color'],
                "light_accent_hover_color"=>$data['light_accent_hover_color'],
                "light_back_main_color"=>$data['light_back_main_color'],
                "light_back_secondary_color"=>$data['light_back_secondary_color'],
                "dark_head_color"=>$data['dark_head_color'],
                "dark_main_color"=>$data['dark_main_color'],
                "dark_accent_color"=>$data['dark_accent_color'],
                "dark_accent_hover_color"=>$data['dark_accent_hover_color'],
                "dark_back_main_color"=>$data['dark_back_main_color'],
                "dark_back_secondary_color"=>$data['dark_back_secondary_color'],
            );
            Style::where("id", '1')->update($data_new);
            return redirect('/admin/styles') -> with('ok-update', '');
        } else {
            return redirect('/admin/styles') -> with('error-validation', '');
        }
    }

}
