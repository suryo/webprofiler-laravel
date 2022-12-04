<div class="pt-page back-image work pt-12 pt-7 pb-4 {{$section->projects_scheme_color}}" data-colorScheme="{{$section->projects_scheme_color}}" data-overflow="1">
    <section class="back-image pb-8 pb-5" data-image="{{!empty($section->projects_background) ? $section->projects_background : 'null'}}">
        <div class="container">

            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3 mb-4">
                @if (!empty($section->projects_subtitle))
                    <p class="mb-2 text-center accent-color fnt-bold">{{$section->projects_subtitle}}</p>
                @endif
                @if (!empty($section->projects_title))
                    <h2 class="m-0 my-3 mt-sm-0 text-center">{{$section->projects_title}}</h2>
                @endif
                </div>
            </div>

            @if(count($projects)>0)
            <div class="row">
                    
                <div class="col-12 mt-4">
                    <div id="filters" class="text-center">
                        <button class="btn btn-outline-secondary css3animate checked rounded-0 py-2 px-4 mx-1 mb-2" data-filter="*">{{ __('content.all')}}</button>
                        @foreach ($projects_categories_filter as $filter)
                        <button class="btn btn-outline-secondary css3animate rounded-0 py-2 px-4 mx-1 mb-2" data-filter=".{{$filter}}">{{Str::upper($filter)}}</button>
                        @endforeach
                    </div>
                </div>

                <div class="col-12 my-4 projects-content" data-route="{{url('/')}}" data-style="{{$section->projects_style}}">
                    <div id="gallery">
                        <div class="grid-sizer"></div>
                        @php $i = 0; @endphp
                        @foreach ($projects as $project)
                            @foreach ($projects_categories as $category)
                                @if($project->category_id == $category->id)
                                <div class="item {{$category->name}}">
                                @endif
                            @endforeach
                            <a class="pt-trigger css3animate menu-hide project-call text-decoration-none p-0" href="#" data-id="{{$project->id}}" data-animation="19" data-goto="" data-image="{{$project->image}}" data-height="{{$projects_masonry[$i]}}">
                                <img src="{{url('/')}}/{{$project->image}}" alt="{{$project->title}}" />
                                <div class="project-text p-4 p-lg-5 style-{{$section->projects_style}}">
                                    <h3 class="css3animate mb-3 text-white">{{$project->title}}</h3>
                                    <p class="css3animate m-0 text-white">{{$project->short_desc}}</p>
                                </div>
                            </a>
                        </div>
                        @php
                        if ($i < 5) {
                            $i++;    
                        } else {
                            $i = 0;
                        } @endphp
                        @endforeach
                    </div>
                </div>

            </div>
            @endif

        </div>
    </section>
</div>

<div class="pt-page work-project py-5 {{$section->projects_scheme_color}}" data-overflow="1">
    <section class="container py-3 py-lg-5 mt-lg-4">
        <div class="row project-title-container d-flex align-items-center flex-column-reverse flex-lg-row">
            <div class="col-12 col-lg-6 mb-4 mb-lg-5">
                <h2 class="project-title pe-lg-5 m-0 text-center text-lg-start hide-element"></h2>
            </div>
            <div class="col-12 col-lg-6 d-flex justify-content-center justify-content-lg-end mb-3 mb-lg-5">
                <button class="pt-trigger css3animate rounded-circle menu-show project-hide" data-animation="20" data-goto="" data-style="{{$section->projects_scheme_color}}">
                    <span class="d-block"></span>
                    <span class="d-block"></span>
                </button>
            </div>
        </div>
        <div class="row project-media hide-element mt-4"></div>

        <div class="row mt-4 mt-lg-5 flex-column-reverse flex-lg-row">
            <div class="col-12 col-lg-8 project-content content-text hide-element mt-4"></div>
            <div class="col-12 col-lg-4 project-information hide-element mt-2 mt-lg-4"></div>
        </div>

        <div class="row mt-4 mt-lg-5 project-gallery hide-element" data-title="{{ __('content.gallery')}}"></div>

        <div class="work-script"></div>

    </section>
</div>