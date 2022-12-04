<div class="pt-page aboutme {{$section->about_scheme_color}}" data-colorScheme="{{$section->about_scheme_color}}" data-overflow="1">
    <section class="aboutme-title">
        <div class="container-fluid">
            <div class="row">
                @if ($personal->image != null)
                    <div class="col-12 col-md-6 aboutme-image back-image pt-12 pb-9 background-secondary" data-image="{{$personal->image}}"></div>
                @endif
                <div class="{{$personal->image != null ? 'col-12 col-md-6 pt-12 pb-9 aboutme-texts py-5' : 'col-12 col-md-6 offset-md-3 pt-12 pb-9 text-center py-5b'}}">
                    @if ($personal->title != '')
                        @php
                        $title = str_replace("/*", "<span class='underlined'>", $personal->title);
                        $title = str_replace("*/", "</span>", $title);
                        @endphp
                        <h1 class="mb-4 mb-md-5">{!!$title!!}</h1>
                    @endif
                    @if ($personal->description != '')
                        <h4 class="fw-normal mb-4 mb-md-5">{!!$personal->description!!}</h4>
                    @endif
                    @if ($personal->cv_enable == 1 && $personal->cv_text != '' && $personal->cv_file != null)
                        <a class="btn {{ ($section->about_scheme_color = "dark-scheme") ? 'btn-outline' : ''}} py-3 px-5 text-uppercase fw-bold" href="{{$personal->cv_file}}" title="{{$personal->cv_text}}" target="_blank">{{$personal->cv_text}}</a>    
                    @endif
                </div>
            </div>
        </div>
    </section>

    @if (!empty($personal->info) && ($personal->info != '[]'))
    <section class="py-4b aboutme-info border-top border-bottom">
        <div class="container">
            <div class="row">
                <x-icon name="waves" class="waves waves-1" />
                <x-icon name="waves" class="waves waves-2" />
                @php
                $personal_info = json_decode($personal->info);
                $class_column = (count($personal_info) > 4) ? 'col-md-3' : 'col-md-'.(12/count($personal_info));
                foreach($personal_info as $info){
                    echo '
                    <div class="col-6 '.$class_column.' aboutme-info-content text-center">
                        <h2 class="mb-2">'.$info->text.'</span></h2>
                        <p class="text-uppercase">'.$info->title.'</p>
                    </div>';
                }
                @endphp
            </div>
        </div>
    </section>
    @endif

    {{-- SKILLS --}}
    @if ($section->skills_enable == true)
        @include('fronted.sections.subsections.skills')
    @endif

    {{-- TESTIMONIALS --}}
    @if ($section->testimonial_enable == true)
        @include('fronted.sections.subsections.testimonials')
    @endif

    {{-- SERVICES --}}
    @if ($section->services_enable == true)
        @include('fronted.sections.subsections.services')
    @endif

</div>