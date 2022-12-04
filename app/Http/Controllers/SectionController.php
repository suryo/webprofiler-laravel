<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Models\User;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SectionController extends Controller
{
    /*****************************************
     * FUNCTION TO SHOW THE SECTIONS OPTIONS
     *****************************************/
    public function index()
    {
        $section = Section::find(1);
        $sliders = Slider::all();
        $user = User::find(1);
        return view('admin.pages.sections')
            ->with('sliders', $sliders)
            ->with('section', $section)
            ->with('user', $user);
    }

    /*****************************************
     * FUNCTION TO UPDATE THE SECTIONS INFO
     *****************************************/
    public function update(Request $request, Section $section)
    {
        // GET THE DATA VALUE
        $section = Section::find(1);
        $data = array(
            "slider_enable"=>$request->input("slider_enable"),
            "slider_id"=>$request->input("slider_id"),
            "about_enable"=>$request->input("about_enable"),
            "about_scheme_color"=>$request->input("about_scheme_color"),
            "about_menu"=>$request->input("about_menu"),
            "skills_enable"=>$request->input("skills_enable"),
            "skills_scheme_color"=>$request->input("skills_scheme_color"),
            "skills_title"=>$request->input("skills_title"),
            "skills_subtitle"=>$request->input("skills_subtitle"),
            "skills_background"=>$request->file("skills_background"),
            "skills_background_current"=>$request->input("skills_background_current"),
            "testimonial_enable"=>$request->input("testimonial_enable"),
            "testimonial_autoplay"=>$request->input("testimonial_autoplay"),
            "testimonial_scheme_color"=>$request->input("testimonial_scheme_color"),
            "testimonial_interval"=>$request->input("testimonial_interval"),
            "testimonial_background"=>$request->file("testimonial_background"),
            "testimonial_background_current"=>$request->input("testimonial_background_current"),
            "services_enable"=>$request->input("services_enable"),
            "services_scheme_color"=>$request->input("services_scheme_color"),
            "services_title"=>$request->input("services_title"),
            "services_subtitle"=>$request->input("services_subtitle"),
            "services_columns"=>$request->input("services_columns"),
            "services_background"=>$request->file("services_background"),
            "services_background_current"=>$request->input("services_background_current"),
            "projects_enable"=>$request->input("projects_enable"),
            "projects_subtitle"=>$request->input("projects_subtitle"),
            "projects_title"=>$request->input("projects_title"),
            "projects_scheme_color"=>$request->input("projects_scheme_color"),
            "projects_menu"=>$request->input("projects_menu"),
            "projects_style"=>$request->input("projects_style"),
            "projects_background"=>$request->file("projects_background"),
            "projects_background_current"=>$request->input("projects_background_current"),
            "blog_enable"=>$request->input("blog_enable"),
            "blog_subtitle"=>$request->input("blog_subtitle"),
            "blog_title"=>$request->input("blog_title"),
            "blog_scheme_color"=>$request->input("blog_scheme_color"),
            "blog_menu"=>$request->input("blog_menu"),  
            "blog_columns"=>$request->input("blog_columns"), 
            "blog_background"=>$request->file("blog_background"),
            "blog_background_current"=>$request->input("blog_background_current"), 
            "contact_enable"=>$request->input("contact_enable"),
            "contact_subtitle"=>$request->input("contact_subtitle"),
            "contact_title"=>$request->input("contact_title"),
            "contact_scheme_color"=>$request->input("contact_scheme_color"),
            "contact_menu"=>$request->input("contact_menu"),
            "contact_text"=>$request->input("contact_text"),
            "map_enable"=>$request->input("map_enable"),
        );
        $slider_id = ($data['slider_id'] == 'null') ? null : $data['slider_id'];
        $route_image_skills = $data['skills_background_current'];
        $route_image_testimonials = $data['testimonial_background_current'];
        $route_image_services = $data['services_background_current'];
        $route_image_projects = $data['projects_background_current'];
        $route_image_blog = $data['blog_background_current'];

        if(!empty($data)){ 
            $validate = Validator::make($data, [
                'about_menu' => ['string', 'max:55'],
                'skills_title' => ['string', 'max:75'],
                'skills_subtitle' => ['string', 'max:75'],
                'services_title' => ['string', 'max:75'],
                'services_subtitle' => ['string', 'max:75'],
                'projects_title' => ['string', 'max:75'],
                'projects_subtitle' => ['string', 'max:75'],
                'projects_menu' => ['string', 'max:55'],
                'blog_title' => ['string', 'max:75'],
                'blog_subtitle' => ['string', 'max:75'],
                'blog_menu' => ['string', 'max:55'],
                'contact_title' => ['string', 'max:75'],
                'contact_subtitle' => ['string', 'max:75'],
                'contact_menu' => ['string', 'max:55'],
                'contact_text' => ['string', 'max:255'],
                'testimonial_interval' => ['integer', 'min:0']
            ]);
            if($validate->fails()){
                return redirect('/admin/sections') 
                    -> with('error-validation', '')
                    -> withErrors($validate)
                    -> withInput();
            }else{
                if (!empty($data["skills_background"])){
                    $validate = Validator::make($data, [
                        'skills_background' => ['file', 'mimes:jpg,jpeg,png', 'max:10240'],
                    ]);
                    if($validate->fails()){
                        return redirect('/admin/sections') 
                            -> with('error-validation', '')
                            -> withErrors($validate)
                            -> withInput();
                    } else {
                        if ($route_image_skills != ''){
                            unlink($route_image_skills);
                        }
                        $directory = "uploads/img/sections";    
                        if(!file_exists($directory)){  
                            mkdir($directory, 0777);
                        }   
                        $random = mt_rand(100,999);
                        $route_image_skills = $directory."/skills_background.".$data["skills_background"]->guessExtension();
                        move_uploaded_file($data["skills_background"]->getPathName(), $route_image_skills);
                    }
                }
                if(empty($data["skills_background"]) && empty($data["skills_background_current"]) && !empty($section->skills_background)){
                    unlink($section->skills_background);
                }
                if (!empty($data["testimonial_background"])){
                    $validate = Validator::make($data, [
                        'testimonial_background' => ['file', 'mimes:jpg,jpeg,png', 'max:10240'],
                    ]);
                    if($validate->fails()){
                        return redirect('/admin/sections') 
                            -> with('error-validation', '')
                            -> withErrors($validate)
                            -> withInput();
                    } else {
                        if ($route_image_testimonials != ''){
                            unlink($route_image_testimonials);
                        }
                        $directory = "uploads/img/sections";    
                        if(!file_exists($directory)){  
                            mkdir($directory, 0777);
                        }   
                        $random = mt_rand(100,999);
                        $route_image_testimonials = $directory."/testimonials_background.".$data["testimonial_background"]->guessExtension();
                        move_uploaded_file($data["testimonial_background"]->getPathName(), $route_image_testimonials);
                    }
                }
                if(empty($data["testimonial_background"]) && empty($data["testimonial_background_current"]) && !empty($section->testimonial_background)){
                    unlink($section->testimonial_background);
                }
                if (!empty($data["services_background"])){
                    $validate = Validator::make($data, [
                        'services_background' => ['file', 'mimes:jpg,jpeg,png', 'max:10240'],
                    ]);
                    if($validate->fails()){
                        return redirect('/admin/sections') 
                            -> with('error-validation', '')
                            -> withErrors($validate)
                            -> withInput();
                    } else {
                        if ($route_image_services != ''){
                            unlink($route_image_services);
                        }
                        $directory = "uploads/img/sections";    
                        if(!file_exists($directory)){  
                            mkdir($directory, 0777);
                        }   
                        $random = mt_rand(100,999);
                        $route_image_services = $directory."/services_background.".$data["services_background"]->guessExtension();
                        move_uploaded_file($data["services_background"]->getPathName(), $route_image_services);
                    }
                }
                if(empty($data["services_background"]) && empty($data["services_background_current"]) && !empty($section->services_background)){
                    unlink($section->services_background);
                }
                if (!empty($data["projects_background"])){
                    $validate = Validator::make($data, [
                        'projects_background' => ['file', 'mimes:jpg,jpeg,png', 'max:10240'],
                    ]);
                    if($validate->fails()){
                        return redirect('/admin/sections') 
                            -> with('error-validation', '')
                            -> withErrors($validate)
                            -> withInput();
                    } else {
                        if ($route_image_projects != ''){
                            unlink($route_image_projects);
                        }
                        $directory = "uploads/img/sections";    
                        if(!file_exists($directory)){  
                            mkdir($directory, 0777);
                        }   
                        $random = mt_rand(100,999);
                        $route_image_projects = $directory."/projects_background.".$data["projects_background"]->guessExtension();
                        move_uploaded_file($data["projects_background"]->getPathName(), $route_image_projects);
                    }
                }
                if(empty($data["projects_background"]) && empty($data["projects_background_current"]) && !empty($section->projects_background)){
                    unlink($section->projects_background);
                }
                if (!empty($data["blog_background"])){
                    $validate = Validator::make($data, [
                        'blog_background' => ['file', 'mimes:jpg,jpeg,png', 'max:10240'],
                    ]);
                    if($validate->fails()){
                        return redirect('/admin/sections') 
                            -> with('error-validation', '')
                            -> withErrors($validate)
                            -> withInput();
                    } else {
                        if ($route_image_blog != ''){
                            unlink($route_image_blog);
                        }
                        $directory = "uploads/img/sections";    
                        if(!file_exists($directory)){  
                            mkdir($directory, 0777);
                        }   
                        $random = mt_rand(100,999);
                        $route_image_blog = $directory."/blog_background.".$data["blog_background"]->guessExtension();
                        move_uploaded_file($data["blog_background"]->getPathName(), $route_image_blog);
                    }
                }
                if(empty($data["blog_background"]) && empty($data["blog_background_current"]) && !empty($section->blog_background)){
                    unlink($section->blog_background);
                }
                $data_new = array(
                    "slider_enable"=>($data['slider_enable'] == 'on') ? 1: 0,
                    "slider_id"=>$slider_id,
                    "about_enable"=>($data['about_enable'] == 'on') ? 1: 0,
                    "about_scheme_color"=>$data['about_scheme_color'],
                    "about_menu"=>$data['about_menu'],
                    "skills_enable"=>($data['skills_enable'] == 'on') ? 1: 0,
                    "skills_scheme_color"=>$data['skills_scheme_color'],
                    "skills_title"=>$data['skills_title'],
                    "skills_subtitle"=>$data['skills_subtitle'],
                    "skills_background"=>$route_image_skills,
                    "testimonial_enable"=>($data['testimonial_enable'] == 'on') ? 1: 0,
                    "testimonial_autoplay"=>($data['testimonial_autoplay'] == 'on') ? 1: 0,
                    "testimonial_scheme_color"=>$data['testimonial_scheme_color'],
                    "testimonial_background"=>$route_image_testimonials,
                    "testimonial_interval"=>$data['testimonial_interval'],
                    "services_enable"=>($data['services_enable'] == 'on') ? 1: 0,
                    "services_scheme_color"=>$data['services_scheme_color'],
                    "services_title"=>$data['services_title'],
                    "services_subtitle"=>$data['services_subtitle'],
                    "services_columns"=>$data['services_columns'],
                    "services_background"=>$route_image_services,
                    "projects_enable"=>($data['projects_enable'] == 'on') ? 1: 0,
                    "projects_subtitle"=>$data['projects_subtitle'],
                    "projects_title"=>$data['projects_title'],
                    "projects_scheme_color"=>$data['projects_scheme_color'],
                    "projects_style"=>$data['projects_style'],
                    "projects_menu"=>$data['projects_menu'],
                    "projects_background"=>$route_image_projects,
                    "blog_enable"=>($data['blog_enable'] == 'on') ? 1: 0,
                    "blog_subtitle"=>$data['blog_subtitle'],
                    "blog_title"=>$data['blog_title'],
                    "blog_scheme_color"=>$data['blog_scheme_color'],
                    "blog_menu"=>$data['blog_menu'],
                    "blog_columns"=>$data['blog_columns'],
                    "blog_background"=>$route_image_blog,
                    "contact_enable"=>($data['contact_enable'] == 'on') ? 1: 0,
                    "contact_subtitle"=>$data['contact_subtitle'],
                    "contact_title"=>$data['contact_title'],
                    "contact_scheme_color"=>$data['contact_scheme_color'],
                    "contact_menu"=>$data['contact_menu'],
                    "contact_text"=>$data['contact_text'],
                    "map_enable"=>($data['map_enable'] == 'on') ? 1: 0
                );
                Section::where("id", '1')->update($data_new);
                return redirect('/admin/sections') -> with('ok-update', '');
            }
        } else {
            return redirect('/admin/sections') -> with('error-validation', '');
        }
    }

}