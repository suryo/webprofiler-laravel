<section class="testimonials back-image pt-8 pb-9 py-5 {{$section->testimonial_scheme_color}}" 
    data-image="{{!empty($section->testimonial_background) ? $section->testimonial_background : 'null'}}">
    <div class="container">
        <div class="row">
            @if (count($testimonials)>0)
            <div class="testimonials-messages py-3 py-md-0 px-4 px-md-0" data-interval="{{$section->testimonial_interval}}" data-autoplay="{{$section->testimonial_autoplay}}">
                
                <div class="row d-flex align-items-stretch">
                    <div class="col-6 col-md-4 offset-md-1 py-5 testimonial-images d-none d-md-block">
                        @foreach ($testimonials as $testimonial)
                        <div class="testimonial-image back-image {{ ($section->testimonial_scheme_color == 'light-scheme') ? 'dark-scheme' : 'light-scheme' }}" data-image="{{$testimonial->image}}">
                            <x-icon name="quotes" class="testimonial-images-quotes"/>
                        </div>
                        @endforeach
                    </div> 
                    <div class="col-12 col-md-6">
                        <div class="testimonial-content {{ ($section->testimonial_scheme_color == 'light-scheme') ? 'dark-scheme' : 'light-scheme' }}">
                            <x-icon name="quotes" class="comment-quotes mb-4"/>
                            <x-icon name="waves" class="waves"/>
                            <div class="testimonial-texts">
                                @php $i = 0; @endphp
                                @foreach ($testimonials as $testimonial)
                                <div>
                                    <p class="comment mb-4 header-font">{{$testimonial->text}}</p>
                                    <p class="comment-name text-uppercase pt-2 m-0 fnt-bold">{{$testimonial->name}} | {{$testimonial->company}}</p>
                                    @if ($section->testimonial_autoplay == 0)
                                    <div class="comments-arrows mt-4 mt-md-5">
                                        <button class="border-0 bg-transparent left-arrow me-3" data-index="{{$i-1}}">
                                            <x-icon name="arrow-left" class="css3animate"/>
                                        </button>
                                        <button class="border-0 bg-transparent right-arrow" data-index="{{$i+1}}">
                                            <x-icon name="arrow-right" class="css3animate"/>
                                        </button>
                                    </div>
                                    @endif
                                </div>
                                @php $i++; @endphp                                
                                @endforeach
                            </div>
                        </div>
                    </div>  
                </div>  

            </div>  
            @endif
        </div>
    </div>
</section>
