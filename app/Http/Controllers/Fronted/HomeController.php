<?php

namespace App\Http\Controllers\Fronted;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\General;
use App\Models\Style;
use App\Models\Section;
use App\Models\Footer;
use App\Models\Slider;
use App\Models\SliderImage;
use App\Models\Personal;
use App\Models\Map;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\Work;
use App\Models\WorkCategory;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index(Request $request){
        //dd("test");
        $blog_active = $request->blog_active;
        $general = General::find(1);
        $style = Style::find(1);
        $section = Section::find(1);
        $slider_images = null;
        if ($section->slider_id != null){
            $slider = Slider::find($section->slider_id);
            if ($slider->type == 'image'){
                $slider_images = SliderImage::where("slider_id", $slider->id)->get();
            }
        } else {
            $slider = null;
        }
        $footer = Footer::find(1);
        $personal = Personal::find(1);
        $design_skills = DB::table('skill')
            ->where('type', '=', 'design')
            ->orderBy('order', 'asc')
            ->get() ;
        $dev_skills = DB::table('skill')
            ->where('type', '=', 'development')
            ->orderBy('order', 'asc')
            ->get();
        $edu_experiences = DB::table('experience')
            ->where('type', '=', 'education')
            ->orderBy('order', 'asc')
            ->get();
        $emp_experiences = DB::table('experience')
            ->where('type', '=', 'employment')
            ->orderBy('order', 'asc')
            ->get();
        $testimonials = DB::table('testimonial')
            ->orderBy('order', 'asc')
            ->get();
        $services = DB::table('service')
            ->orderBy('order', 'asc')
            ->get();
        $map = Map::find(1);
        $gallery = Gallery::all();
        $categories = Category::all();
        $blog = DB::table('blog')
            ->where('status', '=', 'published')
            ->orderBy('order', 'asc')
            ->get() ;
        $projects = DB::table('project')
            ->where('enable', '=', 1)
            ->orderBy('order', 'asc')
            ->get() ;
        $projects_categories = WorkCategory::all();
        $projectsMasonry = [450,575,450,575,575,450];
        $categoriesProjectsList = [];
        foreach($projects_categories as $category){
            foreach($projects as $project){
                if ($project->category_id == $category->id){
                    array_push($categoriesProjectsList, $category->name);
                    break;
                }
            }
        }

        //dd($section);
        return view('fronted.index')
            ->with('style', $style)
            ->with('footer', $footer)
            ->with('section', $section)
            ->with('slider', $slider)
            ->with('slider_images', $slider_images)
            ->with('general', $general)
            ->with('personal', $personal)
            ->with('design_skills', $design_skills)
            ->with('dev_skills', $dev_skills)
            ->with('edu_experiences', $edu_experiences)
            ->with('emp_experiences', $emp_experiences)
            ->with('testimonials', $testimonials)
            ->with('services', $services)
            ->with('map', $map)
            ->with('blog', $blog)
            ->with('categories', $categories)
            ->with('gallery', $gallery)
            ->with('projects', $projects)
            ->with('projects_masonry', $projectsMasonry)
            ->with('projects_categories', $projects_categories)
            ->with('projects_categories_filter', $categoriesProjectsList)
            ->with('blog_active', $blog_active);
    }

    public function post($slug, Request $request){
        $general = General::find(1);
        $style = Style::find(1);
        $post = Blog::where('slug', $slug)->get();
        if(!is_null($post) && (count($post) == 1)){
            $section = Section::find(1);
            $category = Category::find($post[0]->category_id);
            $newDateFormated = date('M d, Y', strtotime($post[0]->created_at));
            $post[0]['category_name'] = $category->name;
            $post[0]['date_formated'] = $newDateFormated;
            if ($post[0]["type"] == 'gallery'){
                $gallery = DB::table('blog_image')
                    ->where('blog_id', '=', $post[0]["id"])
                    ->get() ;
                $post[0]['gallery_image_number'] = count($gallery);
                $i=1;
                $images = [];
                foreach($gallery as $image){
                    $images[$i] = $image->image;
                    $i++;
                }
                $post[0]['gallery_images'] = $images;
            }
            return view('fronted.post')
                ->with('section', $section)
                ->with('style', $style)
                ->with('general', $general)
                ->with('post', $post[0]);
        } else {
            abort(404);
        }
    }

    public function project($id, Request $request){        
        if($request->ajax()){
            $project = Work::find($id);
            $category_project = WorkCategory::find($project->category_id);
            $project['category_name'] = $category_project->name;
            if ($project->type == 'gallery'){
                $gallery = DB::table('project_gallery')
                    ->where('project_id', '=', $id)
                    ->get() ;
                $project['gallery_image_number'] = count($gallery);
                $i=1;
                $images = [];
                foreach($gallery as $image){
                    $images[$i] = $image->image;
                    $i++;
                }
                $project['gallery_images'] = $images;
            }
            return $project;
        } else {
            abort(404);
        }
    }

}

