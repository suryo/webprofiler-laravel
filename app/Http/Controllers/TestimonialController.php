<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TestimonialController extends Controller
{
    
    /************************************
     * FUNCTION TO SHOW THE TESTIMONIALS
     ************************************/
    public function index()
    {
        $testimonials = DB::table('testimonial')
            ->orderBy('order', 'asc')
            ->get() ;
        $user = User::find(1);
        return view('admin.pages.testimonials.testimonials')
            ->with('testimonials', $testimonials)
            ->with('user', $user);
    }

    /************************************
     * FUNCTION TO CREATE A TESTIMONIAL
     ************************************/
    public function store(Request $request)
    {
        // GET THE DATA VALUE
        $data = array(
            "name"=>$request->input("name"),
            "company"=>$request->input("company"),
            "text"=>$request->input("text"),
            "image"=>$request->file("image"),
            "order"=>$request->input("order"),
        );
        $route_image = $data["image"];

        if(!empty($data)){
            $validate = Validator::make($data, [
                "name" => ['required', 'string', 'max:55'],
                "company" => ['required', 'string', 'max:55'],
                "text" => ['required', 'string', 'max:255'],
            ]);
            if($validate->fails()){
                return redirect('/admin/testimonials') 
                    -> with('error-validation', '')
                    -> with('error-modal', '')
                    -> withErrors($validate)
                    -> withInput();
            }else{
                $validate_2 = Validator::make($data, [
                    'image' => ['file', 'mimes:jpg,jpeg,png', 'max:10240'],
                ]);

                if($validate_2->fails()){
                    return redirect('/admin/testimonials') 
                        -> with('error-validation', '')
                        -> withErrors($validate_2)
                        -> withInput();
                } else {

                    $directory = "uploads/img/testimonials";    
                    if(!file_exists($directory)){  
                        mkdir($directory, 0777);
                    }   
                    $random = mt_rand(10,9999);
                    $route_image = $directory."/testimonial_".$random.".".$data["image"]->guessExtension();
                    move_uploaded_file($data["image"]->getPathName(), $route_image);

                    $testimonial = new Testimonial();
                    $testimonial->name = $data["name"];
                    $testimonial->company = $data["company"];
                    $testimonial->text = $data['text'];
                    $testimonial->image = $route_image;
                    $testimonial->order = $data['order'];
                    $testimonial->save();    
                    return redirect('/admin/testimonials') -> with('ok-add', '');
                }
            }
        } else {
            return redirect('/admin/testimonials') -> with('error-validation', '');
        }
    }

    /************************************
     * FUNCTION TO SHOW A TESTIMONIAL
     ************************************/
    public function show($id)
    {
        $testimonial = Testimonial::find($id);
        $user = User::find(1);
        if($testimonial != null){
            return view('admin.pages.testimonials.single')
                ->with('testimonial', $testimonial)
                ->with('user', $user);
        } else {
            return redirect('/admin/testimonials');
        }
    }

    /************************************
     * FUNCTION TO UPDATE A TESTIMONIAL
     ************************************/
    public function update($id, Request $request)
    {
        // GET THE DATA VALUE
        $data = array(
            "name"=>$request->input("name"),
            "company"=>$request->input("company"),
            "text"=>$request->input("text"),
            "image"=>$request->file("image"),
            "image_current"=>$request->input("image_current"),
            "order"=>$request->input("order"),
        );
        $route_image = $data["image"];
        $route_image_current = $data["image_current"];

        if(!empty($data)){
            $validate = Validator::make($data, [
                "name" => ['required', 'string', 'max:55'],
                "company" => ['required', 'string', 'max:55'],
                "text" => ['required', 'string', 'max:255'],
            ]);
            if($validate->fails()){
                return redirect('/admin/testimonials/'.$id) 
                    -> with('error-validation', '')
                    -> withErrors($validate)
                    -> withInput();
            }else{
                if($route_image != ''){
                    $validate_2 = Validator::make($data, [
                        'image' => ['file', 'mimes:jpg,jpeg,png', 'max:10240'],
                    ]);
                    if($validate_2->fails()){
                        return redirect('/admin/testimonials/'.$id) 
                            -> with('error-validation', '')
                            -> withErrors($validate_2)
                            -> withInput();
                    } else {
                        unlink($route_image_current);
                        $directory = "uploads/img/testimonials";    
                        if(!file_exists($directory)){  
                            mkdir($directory, 0777);
                        }   
                        $random = mt_rand(10,9999);
                        $route_image = $directory."/testimonial_".$random.".".$data["image"]->guessExtension();
                        move_uploaded_file($data["image"]->getPathName(), $route_image);
                    }
                } else {
                    $route_image = $route_image_current;
                }
                $data_new = array(
                    "name"=>$data['name'],
                    "company"=>$data['company'],
                    "text"=>$data['text'],
                    "image"=>$route_image,
                    "order"=>$data['order'],
                );
                Testimonial::where("id", $id)->update($data_new);
                return redirect('/admin/testimonials') -> with('ok-update', '');
            }
        } else {
            return redirect('/admin/testimonials') -> with('error-validation', '');
        }
    }

    /********************************************************
     * FUNCTION TO UPDATE THE ORDER OF A TESTIMONIAL -> UP
     ********************************************************/
    public function orderUp($id)
    {
        $testimonial_1 = Testimonial::where("id", $id)->get();
        $testimonial_2 = DB::table('testimonial')
            ->where('order', '=', $testimonial_1[0]['order']-1)
            ->get() ;
        // UPDATE THE ORDER OF THE ELEMENT SELECTED
        $data_new_1 = array(
            "order"=>$testimonial_2[0]->order,
        );
        Testimonial::where("id", $testimonial_1[0]['id'])->update($data_new_1);
        // UPDATE THE ORDER OF THE PREVIOUS ELEMENT
        $data_new_2 = array(
            "order"=>$testimonial_1[0]['order'],
        );
        Testimonial::where("id", $testimonial_2[0]->id)->update($data_new_2);
        return redirect('/admin/testimonials') -> with('ok-update', '');
    }

    /***************************************************
     * FUNCTION TO UPDATE THE ORDER OF A TESTIMONIAL -> DOWN
     ***************************************************/
    public function orderDown($id)
    {
        $testimonial_1 = Testimonial::where("id", $id)->get();
        $testimonial_2 = DB::table('testimonial')
            ->where('order', '=', $testimonial_1[0]['order']+1)
            ->get() ;
        // UPDATE THE ORDER OF THE ELEMENT SELECTED
        $data_new_1 = array(
            "order"=>$testimonial_2[0]->order,
        );
        Testimonial::where("id", $testimonial_1[0]['id'])->update($data_new_1);
        // UPDATE THE ORDER OF THE PREVIOUS ELEMENT
        $data_new_2 = array(
            "order"=>$testimonial_1[0]['order'],
        );
        Testimonial::where("id", $testimonial_2[0]->id)->update($data_new_2);
        return redirect('/admin/testimonials') -> with('ok-update', '');
    }

    /************************************
    * FUNCTION TO DELETE A TESTIMONIAL
    ************************************/
   public function destroy($id, Testimonial $testimonial)
   {
       $validate = Testimonial::where("id", $id)->get();
       if(!empty($validate)){
            unlink($validate[0]['image']);
            Testimonial::where("id", $validate[0]['id'])->delete();
            $testimonials = DB::table('testimonial')
               ->orderBy('order', 'asc')
               ->get() ;
            $i = 1;
            foreach ($testimonials as $testimonial):
               $data_new = array(
                   "order"=>$i,
               );
               Testimonial::where("id", $testimonial->id)->update($data_new);
               $i++;
            endforeach;
            return redirect('/admin/testimonials') -> with('ok-delete', '');
       } else {
            return redirect('/admin/testimonials') -> with('no-delete', '');
       }
   }

}
