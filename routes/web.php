<?php

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\RedirectResponse;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes();

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', [App\Http\Controllers\Fronted\HomeController::class, 'index'])->name('home.index');
Route::get('/post/{id}', [App\Http\Controllers\Fronted\HomeController::class, 'post']);
Route::get('/project/{id}', [App\Http\Controllers\Fronted\HomeController::class, 'project']);
Route::post('/sendemail', [App\Http\Controllers\EmailController::class, 'send']);



/************************
 * ADMIN PAGES
 ************************/

// DASHBOARD

Route::middleware('auth')->group(function () {
 
      Route::get('admin', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    
});
// SLIDERS + IMAGES

    Route::get('admin/sliders', [App\Http\Controllers\SliderController::class, 'index']);
    Route::post('admin/sliders', [App\Http\Controllers\SliderController::class, 'store']);
    Route::get('admin/sliders/{id}', [App\Http\Controllers\SliderController::class, 'show']);
    Route::put('admin/sliders/{id}', [App\Http\Controllers\SliderController::class, 'update']);
    Route::delete('admin/sliders/{id}', [App\Http\Controllers\SliderController::class, 'destroy']);


    Route::get('admin/sliders/images/{id}', [App\Http\Controllers\SliderImageController::class, 'index']);
    Route::post('admin/sliders/images', [App\Http\Controllers\SliderImageController::class, 'store']);
    Route::delete('admin/sliders/images/{id}', [App\Http\Controllers\SliderImageController::class, 'destroy']);


// PERSONAL INFO

    Route::get('admin/personal', [App\Http\Controllers\PersonalController::class, 'index']);
    Route::put('admin/personal', [App\Http\Controllers\PersonalController::class, 'update']);


// SKILLS

    Route::get('admin/skills', [App\Http\Controllers\SkillController::class, 'index']);
    Route::post('admin/skills', [App\Http\Controllers\SkillController::class, 'store']);
    Route::get('admin/skills/{id}', [App\Http\Controllers\SkillController::class, 'show']);
    Route::put('admin/skills/{id}', [App\Http\Controllers\SkillController::class, 'update']);
    Route::delete('admin/skills/{id}', [App\Http\Controllers\SkillController::class, 'destroy']);
    Route::get('admin/skills/order-up/{id}', [App\Http\Controllers\SkillController::class, 'orderUp']);
    Route::get('admin/skills/order-down/{id}', [App\Http\Controllers\SkillController::class, 'orderDown']);


// EXPERIENCES

    Route::get('admin/experiences', [App\Http\Controllers\ExperienceController::class, 'index']);
    Route::post('admin/experiences', [App\Http\Controllers\ExperienceController::class, 'store']);
    Route::get('admin/experiences/{id}', [App\Http\Controllers\ExperienceController::class, 'show']);
    Route::put('admin/experiences/{id}', [App\Http\Controllers\ExperienceController::class, 'update']);
    Route::delete('admin/experiences/{id}', [App\Http\Controllers\ExperienceController::class, 'destroy']);
    Route::get('admin/experiences/order-up/{id}', [App\Http\Controllers\ExperienceController::class, 'orderUp']);
    Route::get('admin/experiences/order-down/{id}', [App\Http\Controllers\ExperienceController::class, 'orderDown']);


// TESTIMONIALS

    Route::get('admin/testimonials', [App\Http\Controllers\TestimonialController::class, 'index']);
    Route::post('admin/testimonials', [App\Http\Controllers\TestimonialController::class, 'store']);
    Route::get('admin/testimonials/{id}', [App\Http\Controllers\TestimonialController::class, 'show']);
    Route::put('admin/testimonials/{id}', [App\Http\Controllers\TestimonialController::class, 'update']);
    Route::delete('admin/testimonials/{id}', [App\Http\Controllers\TestimonialController::class, 'destroy']);
    Route::get('admin/testimonials/order-up/{id}', [App\Http\Controllers\TestimonialController::class, 'orderUp']);
    Route::get('admin/testimonials/order-down/{id}', [App\Http\Controllers\TestimonialController::class, 'orderDown']);


// SERVICES

    Route::get('admin/services', [App\Http\Controllers\ServiceController::class, 'index']);
    Route::post('admin/services', [App\Http\Controllers\ServiceController::class, 'store']);
    Route::get('admin/services/{id}', [App\Http\Controllers\ServiceController::class, 'show']);
    Route::put('admin/services/{id}', [App\Http\Controllers\ServiceController::class, 'update']);
    Route::delete('admin/services/{id}', [App\Http\Controllers\ServiceController::class, 'destroy']);
    Route::get('admin/services/order-up/{id}', [App\Http\Controllers\ServiceController::class, 'orderUp']);
    Route::get('admin/services/order-down/{id}', [App\Http\Controllers\ServiceController::class, 'orderDown']);


// MAP

    Route::get('admin/map', [App\Http\Controllers\MapController::class, 'index']);
    Route::put('admin/map', [App\Http\Controllers\MapController::class, 'update']);


// FOOTER

    Route::get('admin/footer', [App\Http\Controllers\FooterController::class, 'index']);
    Route::put('admin/footer', [App\Http\Controllers\FooterController::class, 'update']);


// STYLE

    Route::get('admin/styles', [App\Http\Controllers\StyleController::class, 'index']);
    Route::put('admin/styles', [App\Http\Controllers\StyleController::class, 'update']);


// SECTIONS

    Route::get('admin/sections', [App\Http\Controllers\SectionController::class, 'index']);
    Route::put('admin/sections', [App\Http\Controllers\SectionController::class, 'update']);


// GENERAL

    Route::get('admin/general', [App\Http\Controllers\GeneralController::class, 'index']);
    Route::put('admin/general', [App\Http\Controllers\GeneralController::class, 'update']);


// PROFILE

    Route::get('admin/profile', [App\Http\Controllers\ProfileController::class, 'index']);
    Route::put('admin/profile', [App\Http\Controllers\ProfileController::class, 'update']);


// BLOG CATEGORIES

    Route::get('admin/blog/categories', [App\Http\Controllers\CategoryController::class, 'index']);
    Route::post('admin/blog/categories', [App\Http\Controllers\CategoryController::class, 'store']);
    Route::get('admin/blog/categories/{id}', [App\Http\Controllers\CategoryController::class, 'show']);
    Route::put('admin/blog/categories/{id}', [App\Http\Controllers\CategoryController::class, 'update']);
    Route::delete('admin/blog/categories/{id}', [App\Http\Controllers\CategoryController::class, 'destroy']);


// BLOG + GALLERY IMAGES

    Route::get('admin/blog/posts', [App\Http\Controllers\BlogController::class, 'index']);
    Route::get('admin/blog/post', [App\Http\Controllers\BlogController::class, 'create']);
    Route::post('admin/blog/post', [App\Http\Controllers\BlogController::class, 'store']);
    Route::delete('admin/blog/post/{id}', [App\Http\Controllers\BlogController::class, 'destroy']);
    Route::get('admin/blog/post/{id}', [App\Http\Controllers\BlogController::class, 'show']);
    Route::put('admin/blog/post/{id}', [App\Http\Controllers\BlogController::class, 'update']);
    Route::get('admin/blog/posts/order-up/{id}', [App\Http\Controllers\BlogController::class, 'orderUp']);
    Route::get('admin/blog/posts/order-down/{id}', [App\Http\Controllers\BlogController::class, 'orderDown']);


    Route::get('admin/blog/gallery/{id}', [App\Http\Controllers\GalleryController::class, 'index']);
    Route::post('admin/blog/gallery', [App\Http\Controllers\GalleryController::class, 'store']);
    Route::delete('admin/blog/gallery/{id}', [App\Http\Controllers\GalleryController::class, 'destroy']);


// WORK CATEGORIES

    Route::get('admin/work/categories', [App\Http\Controllers\WorkCategoryController::class, 'index']);
    Route::post('admin/work/categories', [App\Http\Controllers\WorkCategoryController::class, 'store']);
    Route::put('admin/work/categories/{id}', [App\Http\Controllers\WorkCategoryController::class, 'update']);
    Route::delete('admin/work/categories/{id}', [App\Http\Controllers\WorkCategoryController::class, 'destroy']);


// WORK + GALLERY IMAGES

    Route::get('admin/work/projects', [App\Http\Controllers\WorkController::class, 'index']);
    Route::get('admin/work/project', [App\Http\Controllers\WorkController::class, 'create']);
    Route::post('admin/work/project', [App\Http\Controllers\WorkController::class, 'store']);
    Route::delete('admin/work/project/{id}', [App\Http\Controllers\WorkController::class, 'destroy']);
    Route::get('admin/work/project/{id}', [App\Http\Controllers\WorkController::class, 'show']);
    Route::put('admin/work/project/{id}', [App\Http\Controllers\WorkController::class, 'update']);
    Route::get('admin/work/projects/order-up/{id}', [App\Http\Controllers\WorkController::class, 'orderUp']);
    Route::get('admin/work/projects/order-down/{id}', [App\Http\Controllers\WorkController::class, 'orderDown']);


    Route::get('admin/work/gallery/{id}', [App\Http\Controllers\WorkGalleryController::class, 'index']);
    Route::post('admin/work/gallery', [App\Http\Controllers\WorkGalleryController::class, 'store']);
    Route::delete('admin/work/gallery/{id}', [App\Http\Controllers\WorkGalleryController::class, 'destroy']);


// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
