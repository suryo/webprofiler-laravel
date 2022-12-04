<div class="pt-page contact pt-12 pt-7 pb-4 {{$section->contact_scheme_color}}" data-colorScheme="{{$section->contact_scheme_color}}" data-overflow="1">
    <section class="container pb-5">
        <div class="row">
            <div class="col-12 col-md-6">
                @if (!empty($section->contact_subtitle))
                    <p class="mb-2 accent-color fnt-bold text-center text-md-start">{{$section->contact_subtitle}}</p>
                @endif
                @if (!empty($section->contact_title))
                    <h2 class="mb-4 text-center text-md-start">{{$section->contact_title}}</h2>
                @endif
                @if (!empty($section->contact_text))
                    <p class="text-center text-md-start">{{$section->contact_text}}</p>
                @endif
                @if (!empty($section->contact_text))
                    <h3 class="mt-4 mb-0 text-center text-md-start"><a href="mailto:{{ env('MAIL_FROM_ADDRESS') }}" class="p-0 text-decoration-none" title="{{ $general->title }} - {{$section->contact_title}}">{{ env('MAIL_FROM_ADDRESS') }}</a></h3>
                @endif
            </div>
            <div class="col-12 col-md-6">
                <form action="" id="contactform" class="pt-5 pt-md-0" method="POST" data-route="{{ url('/'); }}">
                    @csrf
                    <input type="text" name="name" class="form-control py-3 mb-4 css3animate" placeholder="{{__('content.name')}}" required>
                    <input type="email" name="email" class="form-control py-3 mb-4 css3animate field-email" placeholder="{{__('content.email')}}" required>
                    <div class="invalid-feedback field-email-valid">{{__('content.email_not_valid')}}</div>
                    <textarea name="message" rows="4" class="form-control py-3 mb-5 css3animate" placeholder="{{__('content.message')}}" required></textarea>
                    <button class="btn py-3 px-5 text-uppercase fw-bold" type="submit" value="Send">
                        {{__('content.button_contact')}}
                    </button>
                    <div class="button-loader hidden">
                        <div class="lds-ring"><div></div><div></div><div></div><div></div></div>
                    </div>
                </form>
                <h4 class="form-message-ok hide">{{__('content.email_sent')}}</h4>
            </div>
        </div>
    </section>
    
    {{-- MAP --}}
    @php
        $iconMap = ($map->icon_image != '') ? $map->icon_image : asset('assets/fronted/img/icon-location.png'); 
    @endphp
    @if ($section->map_enable == true)
        <div id="map" 
            data-latitude="{{$map->latitude}}"
            data-longitude="{{$map->longitude}}"
            data-zoom="{{$map->zoom}}"
            data-iconimage="{{$iconMap}}"
            data-style="{{$map->map_style}}"
            data-key="{{$map->map_key}}"
            data-text="{{$map->map_text}}"></div>
    @endif
    
</div>