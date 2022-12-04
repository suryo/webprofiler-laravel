<div class="pt-page back-image blog pt-12 pt-7 pb-4 {{$section->blog_scheme_color}}" data-colorScheme="{{$section->blog_scheme_color}}" data-overflow="1">
    <section class="back-image pb-5" data-image="{{!empty($section->blog_background) ? $section->blog_background : 'null'}}">
        <div class="container">

            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2 col-xl-6 offset-xl-3">
                @if (!empty($section->blog_subtitle))
                    <p class="mb-2 text-center accent-color fnt-bold">{{$section->blog_subtitle}}</p>
                @endif
                @if (!empty($section->blog_title))
                    <h2 class="m-0 my-3 mt-sm-0 text-center">{{$section->blog_title}}</h2>
                @endif
                </div>
            </div>

            @if(count($blog)>0)
            <div class="row blog-content py-4 py-md-5" data-route="{{url('/')}}">
                @foreach($blog as $post)

                    @if ($loop->first)
                        <div class="col-12 {{ ($section->blog_columns == 3) ? 'col-lg-8' : '' }} mb-4 main-post-image">
                    @else 
                        <div class="col-12 col-md-6 col-lg-{{12/$section->blog_columns}} mb-4">
                    @endif

                    <div class="post-content-container shadow-blanco">
                        @switch($post->type)
                            @case('standard')
                                <div class="post-image">
                                    <img src="{{$post->image}}" class="img-fluid w-100" alt="{{$post->title}}"/>
                                </div>
                                @break

                            @case('gallery')
                                <div class="post-gallery">
                                    <div id="gallery-{{$post->id}}" class="carousel slide" data-bs-ride="carousel">
                                        <!-- Indicators -->
                                        <ol class="carousel-indicators">
                                            @php $i = 0 @endphp
                                            @foreach ($gallery as $image)
                                                @if($image->blog_id == $post->id)
                                                    <li data-bs-target="#gallery-{{$post->id}}" data-bs-slide-to="{{$i}}" class="@php echo ($i == 0) ? 'active' : ''; @endphp"></li>
                                                    @php $i++; @endphp
                                                @endif
                                            @endforeach
                                        </ol>
                                        <!-- Wrapper for slides -->
                                        <div class="carousel-inner" role="listbox">
                                            @php $j = 0 @endphp
                                            @foreach ($gallery as $image)
                                                @if($image->blog_id == $post->id)
                                                    <div class="carousel-item @php echo ($j == 0) ? 'active' : ''; @endphp">
                                                        <img src="{{$image->image}}" class="d-block w-100" alt="{{$post->title}}">
                                                    </div>    
                                                    @php $j++; @endphp
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                                @break

                            @case('video')
                                <div class="post-video">
                                    {!!$post->video!!}
                                </div>
                                @break

                            @case('quote')
                                <div class="post-quote px-5 d-flex flex-column justify-content-center">
                                    <h3 class="mb-3">{{$post->quote_text}}</h3>
                                    <p class="m-0">- {{$post->quote_author}}</p>
                                </div>
                                @break

                        @endswitch

                        @if ($loop->first)
                            <a href="{{ url('/post').'/'.$post->slug }}" class="menu-hide main-post {{ ($section->blog_title == 3) ? '' : 'main-post-wide' }} text-decoration-none d-flex flex-column justify-content-center justify-content-lg-start">
                        @else 
                            <div class="post-content">
                        @endif

                            <p class="info-post mb-2 fnt-small">
                                @php
                                    $newtime = strtotime($post->created_at);    
                                    echo date('M d, Y',$newtime);
                                @endphp 
                                <span class="mx-1">|</span>
                                @foreach ($categories as $category)
                                    @if($post->category_id == $category->id)
                                        {{$category->name}}
                                    @endif
                                @endforeach
                            </p>
                            <h4 class="mb-3">{{$post->title}}</h4>
                            <p class="m-0 info-description">{{$post->short_desc}}</p>
                            
                            @if (!$loop->first)
                            <a class="css3animate menu-hide btn btn-outline fnt-small rounded-0 px-4 mt-4" href="{{ url('/post').'/'.$post->slug }}">
                                {{Str::upper(__('content.load_more'))}}
                            </a>
                            @endif

                        @if ($loop->first)
                            </a>
                        @else 
                            </div>
                        @endif
                    </div>
                </div>
                @endforeach
            </div>
            @endif
        
        </div>
    </section>
</div>
