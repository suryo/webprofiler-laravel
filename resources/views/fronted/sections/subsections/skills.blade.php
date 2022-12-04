<section class="skills back-image pt-8 pb-9 py-5 {{$section->skills_scheme_color}}" 
    data-image="{{!empty($section->skills_background) ? $section->skills_background : 'null'}}">
    <div class="container">
        
        <div class="row">
            <div class="col-12 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
            @if (!empty($section->skills_subtitle))
                <p class="mb-2 text-center accent-color fnt-bold">{{$section->skills_subtitle}}</p>
            @endif
            @if (!empty($section->skills_title))
                <h2 class="m-0 my-3 mt-sm-0 text-center">{{$section->skills_title}}</h2>
            @endif
            </div>
        </div>

        <div class="row">
            
            @if (count($design_skills)>0)
            <div class="col-md-6 mt-4 mt-sm-5">
                <h3 class="d-flex align-items-center mb-4">
                    <i class="fas fa-paint-brush mb-0 me-2 h3 main-color"></i>
                    {{__('content.skills_design')}}
                </h3>
                <div class="skills-design-content">
                    @php $i = 1; @endphp
                    @foreach ($design_skills as $skill)
                    <div class="bar @php echo ($i < count($design_skills)) ? 'mb-3' : ''; $i++; @endphp" data-percentage="{{$skill->percentage}}">
                        <p class="mb-1 css3animate">{{$skill->title}}</p>
                        <p class="bar-percentage css3animate m-0 text-center">{{$skill->percentage}}</p>
                        <div class="bar-graph">
                            <div class="main-layer"></div>
                            <div class="percent-layer general_bg"></div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if (count($dev_skills)>0)
            <div class="col-md-6 mt-4 mt-sm-5">
                <h3 class="d-flex align-items-center mb-4">
                    <i class="fas fa-code mb-0 me-2 h3 main-color"></i>
                    {{__('content.skills_development')}}
                </h3>
                <div class="skills-dev-content pt-2">
                    @php $i = 1; @endphp
                    @foreach ($dev_skills as $skill)
                        @php  
                            $trackcolor = ($section->skills_scheme_color == 'light-scheme') ? $style->light_back_secondary_color : $style->dark_back_secondary_color ;
                            $barcolor = ($section->skills_scheme_color == 'light-scheme') ? $style->light_accent_color : $style->dark_accent_color ;
                        @endphp
                        <div class="pie-chart @php echo ($i < count($dev_skills)) ? 'mb-4 mb-md-5' : ''; $i++; @endphp" data-percent="{{$skill->percentage}}" data-barcolor="{{$barcolor}}" data-trackcolor="{{$trackcolor}}">
                            <h2 class="percentage m-0 css3animate">{{$skill->percentage}}</h2>
                            <p class="percentage-title css3animate fnt-bold m-0">{{$skill->title}}</p>
                        </div>
                    @endforeach
                </div>
            </div>
            @endif

            @if (count($edu_experiences)>0)
            <div class="col-md-5 mt-4 mt-sm-5">
                <h3 class="d-flex align-items-center mb-4">
                    <i class="fas fa-briefcase mb-0 me-2 h3 main-color"></i>
                    {{__('content.education')}}
                </h3>
                <div class="timeline d-flex pt-2">
                    <div class="cards">
                        @php $i = 1; @endphp
                        @foreach ($edu_experiences as $experience)
                        <div class="card p-4 border shadow css3animate @php echo ($i < count($edu_experiences)) ? 'mb-4' : ''; $i++; @endphp">                          
                            <p class="card-date mb-2">{{$experience->period}}</p>
                            <h4 class="mb-2 css3animate">{{$experience->title}}</h4>
                            <p class="card-text mb-0">{{$experience->description}}</p>
                        </div>
                        @endforeach
                    </div>  
                </div>
            </div>
            <div class="col-md-1"></div>
            @endif

            @if (count($emp_experiences)>0)
            <div class="col-md-5 mt-4 mt-sm-5">
                <h3 class="d-flex align-items-center mb-4">
                    <i class="fas fa-graduation-cap mb-0 me-2 h3 main-color"></i>
                    {{__('content.employment')}}
                </h3>
                <div class="timeline d-flex pt-2">
                    <div class="cards">
                        @php $i = 1; @endphp
                        @foreach ($emp_experiences as $experience)
                        <div class="card p-4 border shadow css3animate @php echo ($i < count($emp_experiences)) ? 'mb-4' : ''; $i++; @endphp">                          
                            <p class="card-date mb-2">{{$experience->period}}</p>
                            <h4 class="mb-2 css3animate">{{$experience->title}}</h4>
                            <p class="card-text mb-0">{{$experience->description}}</p>
                        </div>
                        @endforeach
                    </div>  
                </div>
            </div>
            <div class="col-md-1"></div>
            @endif

        </div>
    </div>
</section>