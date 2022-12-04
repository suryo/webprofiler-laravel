@extends('layouts.fronted.post_main')

@section('content')

@if ($section->slider_enable == 1)
    <div id="pattern"></div>
@endif

<div class="pt-wrapper">

    {{-- LOADER --}}
    @if ($general->loader == true)
        @include('fronted.sections.loader')
    @endif

    @php
        
    @endphp

    <div class="pt-page blog-post pb-5 {{$section->blog_scheme_color}}" data-overflow="1">
        <section class="container-fluid @if ($post->type == 'standard')back-image post-image @endif"
            @if ($post->type == 'standard')data-image="{{url('/')}}/{{$post->image}}" @endif>
            <div class="row post-title-container pt-5 pt-8 d-flex flex-column">
                <div class="col-12 col-md-8 offset-md-2 col-lg-6 offset-lg-3 text-center">
                    <a href="{{url('/')}}?blog_active=1" class="project-title css3animate post-hide menu-show py-1 px-3" data-style="{{$section->blog_scheme_color}}">
                        <x-icon name="arrow-left" class="css3animate me-1"/> {{(__('content.blog'))}}
                    </a>
                    <h2 class="post-title my-3 my-lg-4">{{$post->title}}</h2>
                    <p class="post-info m-0">
                        {{$post->date_formated}} <span class="mx-2">|</span> {{$post->category_name}}
                    </p>
                </div>
            </div>
        </section>
        <section class="container container-media py-5">
            <div class="row">
                <div class="col-12 col-lg-8 offset-lg-2 post-media">
                    @switch($post->type)
                        @case('gallery')
                            <div class="post-gallery mb-4 mb-lg-5">
                                <div id="gallery-post-{{$post->id}}" class="carousel slide" data-bs-ride="carousel">
                                    <ol class="carousel-indicators">
                                    @for ($i = 0; $i < $post->gallery_image_number; $i++)
                                        <li data-bs-target="#gallery-post-{{$post->id}}" data-bs-slide-to="{{$i}}" @if ($i == 0) class="active" @endif></li>
                                    @endfor
                                    </ol>
                                    <div class="carousel-inner" role="listbox">
                                        @for ($i = 0; $i < $post->gallery_image_number; $i++)
                                            <div class="carousel-item @if ($i == 0) active @endif">
                                                <img src="{{url('/')}}/{{$post->gallery_images[$i + 1]}}" class="d-block w-100" alt="{{$post->title}}" />
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>
                        @break
                        @case('video')
                            <div class="post-video mb-4 mb-lg-5">
                                {!!$post->video!!}
                            </div>
                        @break
                        @case('quote')
                            <div class="post-quote p-4 p-md-5 mb-4 mb-lg-5">
                                <h3 class="mb-3">{{$post->quote_text}}</h3>
                                <p class="m-0">- {{$post->quote_author}}</p>
                            </div>  
                        @break
                    @endswitch
                </div>
                <div class="col-12 col-lg-8 offset-lg-2 post-content content-text">{!!$post->text!!}</div>
            </div>
        </section>
    </div>

    {{-- COOKIES --}}
    @if ($general->cookies_enable == 1)
        @include('fronted.sections.cookies')
    @endif

</div>
<!-- END PT-WRAPPER  -->

@endsection