<?php

namespace App\Http\Controllers;

use App\Models\Footer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FooterController extends Controller
{
    
    /*****************************************
     * FUNCTION TO SHOW THE FOOTER
     *****************************************/
    public function index()
    {
        $footer = Footer::find(1);
        $user = User::find(1);
        return view('admin.pages.footer')
            ->with('footer', $footer)
            ->with('user', $user);
    }

    /*****************************************
     * FUNCTION TO UPDATE THE FOOTER 
     *****************************************/
    public function update(Request $request, Footer $footer)
    {
        // GET THE DATA VALUE
        $data = array(
            "top_button"=>$request->input("top_button"),
            "copyright"=>$request->input("copyright"),
            "columns"=>$request->input("columns"),
            "column_1_title"=>$request->input("column_1_title"),
            "column_1_subtitle"=>$request->input("column_1_subtitle"),
            "column_1_content"=>$request->input("column_1_content"),
            "column_1_social"=>$request->input("column_1_social"),
            "column_2_title"=>$request->input("column_2_title"),
            "column_2_subtitle"=>$request->input("column_2_subtitle"),
            "column_2_content"=>$request->input("column_2_content"),
            "column_2_social"=>$request->input("column_2_social"),
            "column_3_title"=>$request->input("column_3_title"),
            "column_3_subtitle"=>$request->input("column_3_subtitle"),
            "column_3_content"=>$request->input("column_3_content"),
            "column_3_social"=>$request->input("column_3_social"),
            "column_4_title"=>$request->input("column_4_title"),
            "column_4_subtitle"=>$request->input("column_4_subtitle"),
            "column_4_content"=>$request->input("column_4_content"),
            "column_4_social"=>$request->input("column_4_social"),
        );
        if(!empty($data)){ 
            $validate = Validator::make($data, [
                'copyright' => ['string', 'max:55'],
                
            ]);
            if (($data['columns'] == 2) || ($data['columns'] == 3) || ($data['columns'] == 4)){
                $validate = Validator::make($data, [
                    'column_1_title' => ['string', 'max:55'],
                    'column_1_subtitle' => ['required', 'max:55'],
                    'column_1_content' => ['required', 'max:255'],
                    'column_2_title' => ['string', 'max:55'],
                    'column_2_subtitle' => ['required', 'max:55'],
                    'column_2_content' => ['required', 'max:255'],
                ]);
            }
            if (($data['columns'] == 3) || ($data['columns'] == 4)){
                $validate = Validator::make($data, [
                    'column_3_title' => ['string', 'max:55'],
                    'column_3_subtitle' => ['required', 'max:55'],
                    'column_3_content' => ['required', 'max:255'],
                ]);
            }
            if ($data['columns'] == 4){
                $validate = Validator::make($data, [
                    'column_4_title' => ['string', 'max:55'],
                    'column_4_subtitle' => ['required', 'max:55'],
                    'column_4_content' => ['required', 'max:255'],
                ]);
            }
            if($validate->fails()){
                return redirect('/admin/footer') 
                    -> with('error-validation', '')
                    -> withErrors($validate)
                    -> withInput();
            }else{
                $data_new = array(
                    "top_button"=>($data['top_button'] == 'on') ? 1: 0,
                    "copyright"=>$data['copyright'],
                    "columns"=>$data['columns'],
                    "column_1_title"=>$data['column_1_title'],
                    "column_1_subtitle"=>$data['column_1_subtitle'],
                    "column_1_content"=>$data['column_1_content'],
                    "column_1_social"=>($data['column_1_social'] == 'on') ? 1: 0,
                    "column_2_title"=>$data['column_2_title'],
                    "column_2_subtitle"=>$data['column_2_subtitle'],
                    "column_2_content"=>$data['column_2_content'],
                    "column_2_social"=>($data['column_2_social'] == 'on') ? 1: 0,
                    "column_3_title"=>$data['column_3_title'],
                    "column_3_subtitle"=>$data['column_3_subtitle'],
                    "column_3_content"=>$data['column_3_content'],
                    "column_3_social"=>($data['column_3_social'] == 'on') ? 1: 0,
                    "column_4_title"=>$data['column_4_title'],
                    "column_4_subtitle"=>$data['column_4_subtitle'],
                    "column_4_content"=>$data['column_4_content'],
                    "column_4_social"=>($data['column_4_social'] == 'on') ? 1: 0,
                );
                Footer::where("id", '1')->update($data_new);
                return redirect('/admin/footer') -> with('ok-update', '');
            }
        } else {
            return redirect('/admin/footer') -> with('error-validation', '');
        }
    }

}
