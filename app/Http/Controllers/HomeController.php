<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Blog;
use App\Models\Work;
use App\Models\Category;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = User::find(1);
        $categories = Category::all();
        $gallery = Gallery::all();
        $blog = DB::table('blog')
            ->orderBy('order', 'asc')
            ->get() ;
        $projects = Work::all();
        return view('admin.dashboard')
            ->with('blog', $blog)
            ->with('categories', $categories)
            ->with('gallery', $gallery)
            ->with('projects', $projects)
            ->with('user', $user);
    }
}
