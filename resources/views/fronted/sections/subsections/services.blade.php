<section class="services back-image pt-8 pb-9 py-5 {{$section->services_scheme_color}}" 
    data-image="{{!empty($section->services_background) ? $section->services_background : 'null'}}">
    <div class="container">
            
        <div class="row">
            <div class="col-12 col-md-6">
            @if (!empty($section->services_subtitle))
                <p class="mb-2 accent-color fnt-bold">{{$section->services_subtitle}}</p>
            @endif
            @if (!empty($section->services_title))
                <h2 class="m-0 mt-3 mt-sm-0">{{$section->services_title}}</h2>
            @endif
            </div>
            @if (count($services)>0)
            <div class="col-12 col-md-6 carousel-nav d-flex justify-content-start justify-content-md-end align-items-end mt-4 mt-md-0">
                <button class="rounded-circle me-3 css3animate left-nav">
                    <x-icon name="arrow-left" class="css3animate"/>
                </button>
                <button class="rounded-circle css3animate right-nav">
                    <x-icon name="arrow-right" class="css3animate"/>
                </button>
            </div>
            @endif
        </div>
            
        @if (count($services)>0)
        <div class="row services-content mt-4 mt-sm-5" data-columns="{{$section->services_columns}}">
        
            <div class="owl-carousel owl-theme services-carousel mt-4">
                @foreach ($services as $service)
                <div class="item p-4 p-md-5 css3animate">
                    <i class="{{$service->icon}} css3animate mb-4"></i>
                    <h3 class="mb-4 css3animate">{{$service->title}}</h3>
                    <p class="service-desc css3animate">{{$service->description}}</p>
                    @php
                    $service_info_array = json_decode($service->info);
                    if (!is_null($service_info_array)){
                        echo '<ul class="service-info p-0 m-0">';
                        foreach($service_info_array as $service_info){
                            echo '
                            <li class="css3animate">+ '.$service_info->title.'</li>';
                        }
                        echo '</ul>';
                    }
                    @endphp
                </div>
                @endforeach
            </div>

        </div>
        @endif

    </div>
</section>