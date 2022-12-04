@extends('layouts.admin.main')

@section('content')

<div class="container-fluid">

    {{-- Include the alert file --}}
    @include('admin.modules.alert')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('content.sections') }}</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- DataTales -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="font-weight-bold text-primary m-0">{{ __('content.sections') }}</h6>
                </div>
                <div class="card-body">
                    <form class="form-visibility" action="{{ url('/').'/admin/sections' }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">

                                {{-- SLIDER SECTION --}}
                                <div class="col-12 mb-2">
                                    <h4 class="mt-3 mb-2 text-gray-800 fw-bold">{{ __('content.slider_section') }}</h4>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="slider_enable" class="form-label">{{ __('content.enable_section') }}</label>
                                        <div class="form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" name="slider_enable" {{ ($section->slider_enable == 1) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="slider_enable">{{ __('content.enable') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label for="slider_id" class="form-label">{{ __('content.slider') }}</label>
                                        <select class="form-select @error('slider_id') is-invalid @enderror" name="slider_id">
                                        {{$i=1;}}
                                            <option value="null" {{ ($section->slider_id == null) ? 'selected' : '' }}>{{__('content.none')}}</option>
                                        @foreach ($sliders as $slider)
                                            <option value="{{$slider->id}}" {{ ($section->slider_id == $slider->id) ? 'selected' : '' }}>{{$i}}: {{ucfirst($slider->type)}} @if ($slider->type == 'video') {{$slider->video_type}} @endif</option>
                                            {{$i++;}}
                                        @endforeach
                                        </select>
                                    </div>
                                </div>

                                {{-- ABOUT ME SECTION --}}
                                <div class="col-12 mb-2">
                                    <hr class="mt-4 mb-5 border-0">
                                    <h4 class="mt-3 mb-2 text-gray-800 fw-bold">{{ __('content.about_me_section') }}</h4>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label for="about_enable" class="form-label">{{ __('content.enable_section') }}</label>
                                        <div class="form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" data-visibility="about-me-options" name="about_enable" {{ ($section->about_enable == 1) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="about_enable">{{ __('content.enable') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row about-me-options {{ ($section->about_enable == 0) ? 'd-none' : '' }}">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="about_scheme_color" class="form-label">{{ __('content.color_scheme') }}</label>
                                            <select class="form-select @error('about_scheme_color') is-invalid @enderror" name="about_scheme_color">
                                                <option value="light-scheme" @php echo ($section->about_scheme_color == 'light-scheme') ? 'selected' : ''; @endphp>{{ __('content.light_scheme') }}</option>
                                                <option value="dark-scheme" @php echo ($section->about_scheme_color == 'dark-scheme') ? 'selected' : ''; @endphp>{{ __('content.dark_scheme') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="about_menu" class="form-label">{{ __('content.menu') }}</label>
                                            <input class="form-control @error('about_menu') is-invalid @enderror" type="text" name="about_menu" value="{{$section->about_menu}}" />
                                            @error('about_menu')
                                                <div class="invalid-feedback">
                                                    {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                                </div>
                                            @enderror
                                        </div>
                                    </div>

                                    {{-- SKILLS SECTION --}}
                                    <div class="col-12 mb-2">
                                        <h5 class="mt-4 mb-2 text-gray-800 fw-bold">{{ __('content.skills_section') }}</h5>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label for="skills_enable" class="form-label">{{ __('content.enable_section') }}</label>
                                            <div class="form-switch mb-2">
                                                <input class="form-check-input" type="checkbox" data-visibility="skills-options" name="skills_enable" {{ ($section->skills_enable == 1) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="skills_enable">{{ __('content.enable') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row skills-options {{ ($section->skills_enable == 0) ? 'd-none' : '' }}">
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group mb-3">
                                                <label for="skills_scheme_color" class="form-label">{{ __('content.color_scheme') }}</label>
                                                <select class="form-select @error('skills_scheme_color') is-invalid @enderror" name="skills_scheme_color">
                                                    <option value="light-scheme" @php echo ($section->skills_scheme_color == 'light-scheme') ? 'selected' : ''; @endphp>{{ __('content.light_scheme') }}</option>
                                                    <option value="dark-scheme" @php echo ($section->skills_scheme_color == 'dark-scheme') ? 'selected' : ''; @endphp>{{ __('content.dark_scheme') }}</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="skills_title" class="form-label">{{ __('content.title') }}</label>
                                                <input class="form-control @error('skills_title') is-invalid @enderror" type="text" name="skills_title" value="{{$section->skills_title}}" />
                                                @error('skills_title')
                                                    <div class="invalid-feedback">
                                                        {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="skills_subtitle" class="form-label">{{ __('content.subtitle') }}</label>
                                                <input class="form-control @error('skills_subtitle') is-invalid @enderror" type="text" name="skills_subtitle" value="{{$section->skills_subtitle}}" />
                                                @error('skills_subtitle')
                                                    <div class="invalid-feedback">
                                                        {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group">
                                                <label for="skills_background" class="form-label d-flex justify-content-between">
                                                    {{ __('content.background') }}
                                                    <span class="fw-normal fst-italic remove-image text-primary" data-target="skills_background" data-url="{{asset('/')}}"><i class="fas fa-times mr-1"></i>{{ __('content.remove_image') }}</span>
                                                </label>
                                                @php
                                                    $imgSkillsUrl = ($section->skills_background != '') ? $section->skills_background : 'uploads/img/image_default.png';
                                                @endphp
                                                <div class="d-flex p-3 mb-2 bg-gray-200 justify-content-center">
                                                    <img src="{{asset('/')}}/@php echo $imgSkillsUrl; @endphp" class="img-fluid img-maxsize-200 previewImage_skills_background" />
                                                </div>
                                                <input class="form-control previewImage @error('skills_background') is-invalid @enderror" type="file" name="skills_background" value=""/>
                                                <input type="hidden" name="skills_background_current" value="{{$section->skills_background}}" />
                                                <div class="form-text d-flex justify-content-between">
                                                    <span>{{ __('content.image_requirements') }}</span>
                                                    <span>{{ __('content.image_size_recommended') }} 1280x600px</span>
                                                </div>
                                                @error('skills_background')
                                                    <div class="invalid-feedback">
                                                        {{ __('content.error_validation_image') }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> {{-- END SKILLS OPTIONS --}}

                                    {{-- TESTIMONIAL SECTION --}}
                                    <div class="col-12 mb-2">
                                        <h5 class="mt-4 mb-2 text-gray-800 fw-bold">{{ __('content.testimonials_section') }}</h5>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label for="testimonial_enable" class="form-label">{{ __('content.enable_section') }}</label>
                                            <div class="form-switch mb-2">
                                                <input class="form-check-input" type="checkbox" data-visibility="testimonials-options" name="testimonial_enable" {{ ($section->testimonial_enable == 1) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="testimonial_enable">{{ __('content.enable') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row testimonials-options {{ ($section->testimonial_enable == 0) ? 'd-none' : '' }}">
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group mb-4">
                                                <label for="testimonial_scheme_color" class="form-label">{{ __('content.color_scheme') }}</label>
                                                <select class="form-select @error('testimonial_scheme_color') is-invalid @enderror" name="testimonial_scheme_color">
                                                    <option value="light-scheme" @php echo ($section->testimonial_scheme_color == 'light-scheme') ? 'selected' : ''; @endphp>{{ __('content.light_scheme') }}</option>
                                                    <option value="dark-scheme" @php echo ($section->testimonial_scheme_color == 'dark-scheme') ? 'selected' : ''; @endphp>{{ __('content.dark_scheme') }}</option>
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="testimonial_interval" class="form-label">{{ __('content.interval_time') }}</label>
                                                <input class="form-control @error('testimonial_interval') is-invalid @enderror" type="number" min="0" name="testimonial_interval" value="{{$section->testimonial_interval}}" />
                                                @error('testimonial_interval')
                                                    <div class="invalid-feedback">
                                                        {{ __('content.number_not_valid') }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="testimonial_autoplay" class="form-label">{{ __('content.autoplay') }}</label>
                                                <div class="form-switch mb-2">
                                                    <input class="form-check-input" type="checkbox" name="testimonial_autoplay" {{ ($section->testimonial_autoplay == 1) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="testimonial_autoplay">{{ __('content.enable') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group">
                                                <label for="testimonial_background" class="form-label d-flex justify-content-between">
                                                    {{ __('content.background') }}
                                                    <span class="fw-normal fst-italic remove-image text-primary" data-target="testimonial_background" data-url="{{asset('/')}}"><i class="fas fa-times mr-1"></i>{{ __('content.remove_image') }}</span>
                                                </label>
                                                @php
                                                    $imgTestimonialUrl = ($section->testimonial_background != '') ? $section->testimonial_background : 'uploads/img/image_default.png';
                                                @endphp
                                                <div class="d-flex p-3 mb-2 bg-gray-200 justify-content-center">
                                                    <img src="{{asset('/')}}/@php echo $imgTestimonialUrl; @endphp" class="img-fluid img-maxsize-200 previewImage_testimonial_background" />
                                                </div>
                                                <input class="form-control previewImage @error('testimonial_background') is-invalid @enderror" type="file" name="testimonial_background" value=""/>
                                                <input type="hidden" name="testimonial_background_current" value="{{$section->testimonial_background}}" />
                                                <div class="form-text d-flex justify-content-between">
                                                    <span>{{ __('content.image_requirements') }}</span>
                                                    <span>{{ __('content.image_size_recommended') }} 1280x600px</span>
                                                </div>
                                                @error('testimonial_background')
                                                    <div class="invalid-feedback">
                                                        {{ __('content.error_validation_image') }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> {{-- END TESTIMONIALS OPTIONS --}}
                                    
                                    {{-- SERVICES SECTION --}}
                                    <div class="col-12 mb-2">
                                        <h5 class="mt-4 mb-2 text-gray-800 fw-bold">{{ __('content.services_section') }}</h5>
                                    </div>
                                    <div class="col-md-12 mb-2">
                                        <div class="form-group">
                                            <label for="services_enable" class="form-label">{{ __('content.enable_section') }}</label>
                                            <div class="form-switch mb-2">
                                                <input class="form-check-input" type="checkbox" data-visibility="services-options" name="services_enable" {{ ($section->services_enable == 1) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="services_enable">{{ __('content.enable') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row services-options {{ ($section->services_enable == 0) ? 'd-none' : '' }}">
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group mb-3">
                                                <label for="services_scheme_color" class="form-label">{{ __('content.color_scheme') }}</label>
                                                <select class="form-select @error('services_scheme_color') is-invalid @enderror" name="services_scheme_color">
                                                    <option value="light-scheme" @php echo ($section->services_scheme_color == 'light-scheme') ? 'selected' : ''; @endphp>{{ __('content.light_scheme') }}</option>
                                                    <option value="dark-scheme" @php echo ($section->services_scheme_color == 'dark-scheme') ? 'selected' : ''; @endphp>{{ __('content.dark_scheme') }}</option>
                                                </select>
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="services_title" class="form-label">{{ __('content.title') }}</label>
                                                <input class="form-control @error('services_title') is-invalid @enderror" type="text" name="services_title" value="{{$section->services_title}}" />
                                                @error('services_title')
                                                    <div class="invalid-feedback">
                                                        {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group mb-3">
                                                <label for="services_subtitle" class="form-label">{{ __('content.subtitle') }}</label>
                                                <input class="form-control @error('services_subtitle') is-invalid @enderror" type="text" name="services_subtitle" value="{{$section->services_subtitle}}" />
                                                @error('services_subtitle')
                                                    <div class="invalid-feedback">
                                                        {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="services_columns" class="form-label">{{ __('content.columns') }}</label>
                                                <select class="form-select @error('services_columns') is-invalid @enderror" name="services_columns">
                                                    <option value="2" @php echo ($section->services_columns == 2) ? 'selected' : ''; @endphp>2</option>
                                                    <option value="3" @php echo ($section->services_columns == 3) ? 'selected' : ''; @endphp>3</option>
                                                    <option value="4" @php echo ($section->services_columns == 4) ? 'selected' : ''; @endphp>4</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-2">
                                            <div class="form-group">
                                                <label for="services_background" class="form-label d-flex justify-content-between">
                                                    {{ __('content.background') }}
                                                    <span class="fw-normal fst-italic remove-image text-primary" data-target="services_background" data-url="{{asset('/')}}"><i class="fas fa-times mr-1"></i>{{ __('content.remove_image') }}</span>
                                                </label>
                                                @php
                                                    $imgServicesUrl = ($section->services_background != '') ? $section->services_background : 'uploads/img/image_default.png';
                                                @endphp
                                                <div class="d-flex p-3 mb-2 bg-gray-200 justify-content-center">
                                                    <img src="{{asset('/')}}/@php echo $imgServicesUrl; @endphp" class="img-fluid img-maxsize-200 previewImage_services_background" />
                                                </div>
                                                <input class="form-control previewImage @error('services_background') is-invalid @enderror" type="file" name="services_background" value=""/>
                                                <input type="hidden" name="services_background_current" value="{{$section->services_background}}" />
                                                <div class="form-text d-flex justify-content-between">
                                                    <span>{{ __('content.image_requirements') }}</span>
                                                    <span>{{ __('content.image_size_recommended') }} 1280x600px</span>
                                                </div>
                                                @error('services_background')
                                                    <div class="invalid-feedback">
                                                        {{ __('content.error_validation_image') }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div> {{-- END SERVICES OPTIONS --}}

                                </div> {{-- END ABOUT ME OPTIONS --}}

                                {{-- PROJECTS SECTION --}}
                                <div class="col-12 mb-2">
                                    <hr class="mt-4 mb-5 border-0">
                                    <h4 class="mt-3 mb-2 text-gray-800 fw-bold">{{ __('content.projects_section') }}</h4>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label for="projects_enable" class="form-label">{{ __('content.enable_section') }}</label>
                                        <div class="form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" data-visibility="projects-options" name="projects_enable" {{ ($section->projects_enable == 1) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="projects_enable">{{ __('content.enable') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row projects-options {{ ($section->projects_enable == 0) ? 'd-none' : '' }}">
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label for="projects_scheme_color" class="form-label">{{ __('content.color_scheme') }}</label>
                                            <select class="form-select @error('projects_scheme_color') is-invalid @enderror" name="projects_scheme_color">
                                                <option value="light-scheme" @php echo ($section->projects_scheme_color == 'light-scheme') ? 'selected' : ''; @endphp>{{ __('content.light_scheme') }}</option>
                                                <option value="dark-scheme" @php echo ($section->projects_scheme_color == 'dark-scheme') ? 'selected' : ''; @endphp>{{ __('content.dark_scheme') }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="projects_menu" class="form-label">{{ __('content.menu') }}</label>
                                            <input class="form-control @error('projects_menu') is-invalid @enderror" type="text" name="projects_menu" value="{{$section->projects_menu}}"/>
                                            @error('projects_menu')
                                                <div class="invalid-feedback">
                                                    {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="projects_title" class="form-label">{{ __('content.title') }}</label>
                                            <input class="form-control @error('projects_title') is-invalid @enderror" type="text" name="projects_title" value="{{$section->projects_title}}" />
                                            @error('projects_title')
                                                <div class="invalid-feedback">
                                                    {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="projects_subtitle" class="form-label">{{ __('content.subtitle') }}</label>
                                            <input class="form-control @error('projects_subtitle') is-invalid @enderror" type="text" name="projects_subtitle" value="{{$section->projects_subtitle}}" />
                                            @error('projects_subtitle')
                                                <div class="invalid-feedback">
                                                    {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="projects_style" class="form-label">{{ __('content.style') }}</label>
                                            <select class="form-select @error('projects_style') is-invalid @enderror" name="projects_style">
                                                <option value="1" @php echo ($section->projects_style == '1') ? 'selected' : ''; @endphp>{{ __('content.style') }} 1</option>
                                                <option value="2" @php echo ($section->projects_style == '2') ? 'selected' : ''; @endphp>{{ __('content.style') }} 2</option>
                                                <option value="3" @php echo ($section->projects_style == '3') ? 'selected' : ''; @endphp>{{ __('content.style') }} 3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="projects_background" class="form-label d-flex justify-content-between">
                                                {{ __('content.background') }}
                                                <span class="fw-normal fst-italic remove-image text-primary" data-target="projects_background" data-url="{{asset('/')}}"><i class="fas fa-times mr-1"></i>{{ __('content.remove_image') }}</span>
                                            </label>
                                            @php
                                                $imgProjectsUrl = ($section->projects_background != '') ? $section->projects_background : 'uploads/img/image_default.png';
                                            @endphp
                                            <div class="d-flex p-3 mb-2 bg-gray-200 justify-content-center">
                                                <img src="{{asset('/')}}/@php echo $imgProjectsUrl; @endphp" class="img-fluid img-maxsize-200 previewImage_projects_background" />
                                            </div>
                                            <input class="form-control previewImage @error('projects_background') is-invalid @enderror" type="file" name="projects_background" value=""/>
                                            <input type="hidden" name="projects_background_current" value="{{$section->projects_background}}" />
                                            <div class="form-text d-flex justify-content-between">
                                                <span>{{ __('content.image_requirements') }}</span>
                                                <span>{{ __('content.image_size_recommended') }} 1280x600px</span>
                                            </div>
                                            @error('projects_background')
                                                <div class="invalid-feedback">
                                                    {{ __('content.error_validation_image') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div> {{-- END PROJECTS OPTIONS --}}

                                {{-- BLOG SECTION --}}
                                <div class="col-12 mb-2">
                                    <hr class="mt-4 mb-5 border-0">
                                    <h4 class="mt-3 mb-2 text-gray-800 fw-bold">{{ __('content.blog_section') }}</h4>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label for="blog_enable" class="form-label">{{ __('content.enable_section') }}</label>
                                        <div class="form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" data-visibility="blog-options" name="blog_enable" {{ ($section->blog_enable == 1) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="blog_enable">{{ __('content.enable') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row blog-options {{ ($section->blog_enable == 0) ? 'd-none' : '' }}">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group mb-3">
                                            <label for="blog_scheme_color" class="form-label">{{ __('content.color_scheme') }}</label>
                                            <select class="form-select @error('blog_scheme_color') is-invalid @enderror" name="blog_scheme_color">
                                                <option value="light-scheme" @php echo ($section->blog_scheme_color == 'light-scheme') ? 'selected' : ''; @endphp>{{ __('content.light_scheme') }}</option>
                                                <option value="dark-scheme" @php echo ($section->blog_scheme_color == 'dark-scheme') ? 'selected' : ''; @endphp>{{ __('content.dark_scheme') }}</option>
                                            </select>
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="blog_menu" class="form-label">{{ __('content.menu') }}</label>
                                            <input class="form-control @error('blog_menu') is-invalid @enderror" type="text" name="blog_menu" value="{{$section->blog_menu}}" />
                                            @error('blog_menu')
                                                <div class="invalid-feedback">
                                                    {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="blog_title" class="form-label">{{ __('content.title') }}</label>
                                            <input class="form-control @error('blog_title') is-invalid @enderror" type="text" name="blog_title" value="{{$section->blog_title}}" />
                                            @error('blog_title')
                                                <div class="invalid-feedback">
                                                    {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="blog_subtitle" class="form-label">{{ __('content.subtitle') }}</label>
                                            <input class="form-control @error('blog_subtitle') is-invalid @enderror" type="text" name="blog_subtitle" value="{{$section->blog_subtitle}}" />
                                            @error('blog_subtitle')
                                                <div class="invalid-feedback">
                                                    {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-3">
                                            <label for="blog_columns" class="form-label">{{ __('content.columns') }}</label>
                                            <select class="form-select @error('blog_columns') is-invalid @enderror" name="blog_columns">
                                                <option value="2" @php echo ($section->blog_columns == 2) ? 'selected' : ''; @endphp>2</option>
                                                <option value="3" @php echo ($section->blog_columns == 3) ? 'selected' : ''; @endphp>3</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="blog_background" class="form-label d-flex justify-content-between">
                                                {{ __('content.background') }}
                                                <span class="fw-normal fst-italic remove-image text-primary" data-target="blog_background" data-url="{{asset('/')}}"><i class="fas fa-times mr-1"></i>{{ __('content.remove_image') }}</span>
                                            </label>
                                            @php
                                                $imgBlogUrl = ($section->blog_background != '') ? $section->blog_background : 'uploads/img/image_default.png';
                                            @endphp
                                            <div class="d-flex p-3 mb-2 bg-gray-200 justify-content-center">
                                                <img src="{{asset('/')}}/@php echo $imgBlogUrl; @endphp" class="img-fluid img-maxsize-200 previewImage_blog_background" />
                                            </div>
                                            <input class="form-control previewImage @error('blog_background') is-invalid @enderror" type="file" name="blog_background" value=""/>
                                            <input type="hidden" name="blog_background_current" value="{{$section->blog_background}}" />
                                            <div class="form-text d-flex justify-content-between">
                                                <span>{{ __('content.image_requirements') }}</span>
                                                <span>{{ __('content.image_size_recommended') }} 1280x600px</span>
                                            </div>
                                            @error('blog_background')
                                                <div class="invalid-feedback">
                                                    {{ __('content.error_validation_image') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div> {{-- END BLOG OPTIONS --}}

                                {{-- CONTACT SECTION --}}
                                <div class="col-12 mb-2">
                                    <hr class="mt-4 mb-5 border-0">
                                    <h4 class="mt-3 mb-2 text-gray-800 fw-bold">{{ __('content.contact_section') }}</h4>
                                </div>
                                <div class="col-md-12 mb-2">
                                    <div class="form-group">
                                        <label for="contact_enable" class="form-label">{{ __('content.enable_section') }}</label>
                                        <div class="form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" data-visibility="contact-options" name="contact_enable" {{ ($section->contact_enable == 1) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="contact_enable">{{ __('content.enable') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row contact-options {{ ($section->contact_enable == 0) ? 'd-none' : '' }}">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="contact_scheme_color" class="form-label">{{ __('content.color_scheme') }}</label>
                                            <select class="form-select @error('contact_scheme_color') is-invalid @enderror" name="contact_scheme_color">
                                                <option value="light-scheme" @php echo ($section->contact_scheme_color == 'light-scheme') ? 'selected' : ''; @endphp>{{ __('content.light_scheme') }}</option>
                                                <option value="dark-scheme" @php echo ($section->contact_scheme_color == 'dark-scheme') ? 'selected' : ''; @endphp>{{ __('content.dark_scheme') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="contact_menu" class="form-label">{{ __('content.menu') }}</label>
                                            <input class="form-control @error('contact_menu') is-invalid @enderror" type="text" name="contact_menu" value="{{$section->contact_menu}}" />
                                            @error('contact_menu')
                                                <div class="invalid-feedback">
                                                    {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="contact_title" class="form-label">{{ __('content.title') }}</label>
                                            <input class="form-control @error('contact_title') is-invalid @enderror" type="text" name="contact_title" value="{{$section->contact_title}}" />
                                            @error('contact_title')
                                                <div class="invalid-feedback">
                                                    {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="contact_subtitle" class="form-label">{{ __('content.subtitle') }}</label>
                                            <input class="form-control @error('contact_subtitle') is-invalid @enderror" type="text" name="contact_subtitle" value="{{$section->contact_subtitle}}" />
                                            @error('contact_subtitle')
                                                <div class="invalid-feedback">
                                                    {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="contact_text" class="form-label">{{ __('content.text') }}</label>
                                            <textarea class="form-control @error('contact_text') is-invalid @enderror" name="contact_text" rows="5">{{$section->contact_text}}</textarea>
                                            @error('contact_text')
                                                <div class="invalid-feedback">
                                                    {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 255.
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    {{-- MAP SECTION --}}
                                    <div class="col-12 mb-2">
                                        <h5 class="mt-4 mb-2 text-gray-800 fw-bold">{{ __('content.map_section') }}</h5>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="map_enable" class="form-label">{{ __('content.enable_section') }}</label>
                                            <div class="form-switch mb-2">
                                                <input class="form-check-input" type="checkbox" name="map_enable" {{ ($section->map_enable == 1) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="map_enable">{{ __('content.enable') }}</label>
                                            </div>
                                        </div>
                                    </div>
                                </div> {{-- END CONTACT OPTIONS --}}
                                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
                                {{ __('content.update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
