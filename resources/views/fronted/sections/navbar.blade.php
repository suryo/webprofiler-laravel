@php
$page_number = ($section->slider_enable == 1 && $slider != null) ? 2 : 1;
switch ($general->menu_position) {
    case 'left':
        $margin_css = "me-auto ms-5";
        break;
    case 'right':
        $margin_css = "ms-auto me-5";
        break;
    default:
        $margin_css = "";
        break;
}
@endphp

<nav id="mainNav" class="navbar navbar-expand-lg align-items-center css3animate fnt-bold" role="navigation">
    <div class="pt-trigger-container px-3 px-md-5 d-flex justify-content-between align-items-center w-100">
        <h1 class="m-0">
            <button class="navbar-brand pt-trigger css3animate bg-transparent border-0 p-0 m-0" data-animation="22" data-goto="1" data-style="">
                @if(!empty($general->image_logo_header_dark) || !empty($general->image_logo_header_light))
                    @if(!empty($general->image_logo_header_dark))
                        <img src="{{url('/')}}/{{$general->image_logo_header_dark}}" alt="{{$general->title}}" class="img-fluid logo-header-dark" />
                    @endif
                    @if(!empty($general->image_logo_header_light))
                        <img src="{{url('/')}}/{{$general->image_logo_header_light}}" alt="{{$general->title}}" class="img-fluid logo-header-light" />
                    @endif
                @else
                    {{$general->title}}
                @endif
            </button>
        </h1>
        <ul class="nav navbar-nav d-none d-lg-flex {{$margin_css}}">
            
            {{-- ABOUT BUTTON --}}
            @if($section->about_enable == true)
            <li class="nav-item">
                <button class="p-0 pt-trigger css3animate" data-animation="22" data-goto="@php echo $page_number++; @endphp" data-style="{{$section->about_scheme_color}}">
                    {{Str::upper($section->about_menu)}}
                </button>
            </li>
            @endif

            {{-- PROJECTS BUTTON --}}
            @if ($section->projects_enable == 1)
            <li class="nav-item">
                <button class="p-0 pt-trigger work-menu css3animate" data-animation="22" data-goto="@php echo $page_number++; $page_number++; @endphp" data-style="{{$section->projects_scheme_color}}">
                    {{Str::upper($section->projects_menu)}}
                </button>
            </li>
            @endif

            {{-- BLOG BUTTON --}}
            @if ($section->blog_enable == 1)
            <li class="nav-item">
                <button class="p-0 pt-trigger blog-menu css3animate" data-animation="22" data-goto="@php echo $page_number++; @endphp" data-style="{{$section->blog_scheme_color}}">
                    {{Str::upper($section->blog_menu)}}
                </button>
            </li>
            @endif

            {{-- CONTACT BUTTON --}}
            @if ($section->contact_enable == 1)
            <li class="nav-item">
                <button class="p-0 pt-trigger work-menu css3animate" data-animation="22" data-goto="@php echo $page_number++; @endphp" data-style="{{$section->contact_scheme_color}}">
                    {{Str::upper($section->contact_menu)}}
                </button>
            </li>
            @endif
        
        </ul>

        {{-- SOCIAL ICONS --}}
        @if (!empty($general->social_links) && ($general->social_links != '[]'))
        <ul class="d-none d-lg-flex m-0">
            <li class="social-icons d-flex align-items-center">
                @php
                $social_links = json_decode($general->social_links);
                foreach($social_links as $key){
                    $title = explode("-",substr($key->title, 7));
                    echo '<a href="'.$key->text.'" class="css3animate p-0" title="'.ucfirst($title[0]).'" data-bs-toggle="tooltip" data-bs-placement="bottom"><i class="'.$key->title.'"></i></a>';
                }
                @endphp
            </li>
        </ul>
        @endif

        <button id="mobile-menu-open" class="burger css3animate d-flex d-lg-none bg-transparent border-0">
			<span></span>
            <span></span>
            <span></span>
		</button>

    </div>
</nav>

@php
$page_number_mobile = ($section->slider_enable == 1 && $slider != null) ? 2 : 1;
@endphp

<nav class="mobile-nav">
    <ul class="w-100 py-3 px-0">
        <li class="py-3 text-end">
            <button id="mobile-menu-close" class="close-mobile-nav bg-transparent border-0">
                <span class="d-block"></span>
                <span class="d-block"></span>
            </button>
        </li>      
        
        @if ($section->about_enable == 1)
        <li class="py-3 text-end">
            <button class="pt-trigger bg-transparent border-0" data-animation="22" data-goto="@php echo $page_number_mobile++; @endphp" data-style="{{$section->about_scheme_color}}">
                {{$section->about_menu}}
            </button>
        </li>
        @endif

        @if ($section->projects_enable == 1)
        <li class="py-3 text-end">
            <button class="pt-trigger bg-transparent border-0" data-animation="22" data-goto="@php echo $page_number_mobile++; $page_number_mobile++; @endphp" data-style="{{$section->projects_scheme_color}}">
                {{$section->projects_menu}}
            </button>
        </li>
        @endif

        @if ($section->blog_enable == 1)
        <li class="py-3 text-end">
            <button id="blogButton"  class="pt-trigger bg-transparent border-0" data-animation="22" data-goto="@php echo $page_number_mobile++; @endphp" data-style="{{$section->blog_scheme_color}}">
                {{$section->blog_menu}}
            </button>
        </li>
        @endif

        @if ($section->contact_enable == 1)
        <li class="py-3 text-end">
            <button class="pt-trigger bg-transparent border-0" data-animation="22" data-goto="@php echo $page_number_mobile++; @endphp" data-style="{{$section->contact_scheme_color}}">
                {{$section->contact_menu}}
            </button>
        </li>
        @endif

        @if (!empty($general->social_links) && ($general->social_links != '[]'))
            <li class="py-3 text-end social-icons">
                @php
                $social_links = json_decode($general->social_links);
                foreach($social_links as $key){
                    $title = explode("-",substr($key->title, 7));
                    echo '<a class="mx-3" href="'.$key->text.'" class="css3animate p-0" title="'.ucfirst($title[0]).'" data-bs-toggle="tooltip" data-bs-placement="bottom"><i class="'.$key->title.'"></i></a>';
                }
                @endphp
            </li>
        @endif
    </ul>
</nav>