<div class="loader {{$general->loader_scheme_color}}">
    <div id="loader-content">
        @if (!empty($general->image_logo_loader))
            <img class="img-fluid loader-image" src="{{ url('/')}}/{{$general->image_logo_loader}}" />
        @else 
            <p class="loader-logo m-0 header-font" data-images="true">
                B
            </p>
        @endif
        @php 
            //$emptyFill = ($general->loader_scheme_color == 'light-scheme') ? 'rgba(0,0,0,.25)' : 'rgba(255,255,255,.5)' ;
            $emptyFill = ($general->loader_scheme_color == 'light-scheme') ? $style->light_back_secondary_color : $style->dark_back_secondary_color ;
            $colorValue = ($general->loader_scheme_color == 'light-scheme') ? $style->light_accent_color : $style->dark_accent_color ;
        @endphp
        <div id="loader-circle" data-emptyFill="{{$emptyFill}}" data-color="{{$colorValue}}"></div>
    </div>
</div>