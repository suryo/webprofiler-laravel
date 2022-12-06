@extends('layouts.fronted.main')

@section('content')

@if ($section->slider_enable == 1)
    <div id="pattern"></div>
@endif

<div class="pt-wrapper">

    {{-- LOADER --}}
    @if ($general->loader == true)
        @include('fronted.sections.loader')
    @endif

    @if ($section->slider_enable == 1 && $slider != null)
        @if ($slider->type == 'video')      
            <div id="bgimg" data-video="{{$slider->video}}" data-poster="{{$slider->image_video}}"></div>
        @endif
        @if ($slider->type == 'video' && $slider->video_type == 'youtube')  
            <div id="video-content"></div>
            <a id="bgndVideo" data-property="{videoURL:'{{$slider->video}}', containment:'#video-content', autoPlay:true, mute:true, startAt:0, opacity:1, ratio:'auto', addRaster:true}" data-poster="{{$slider->image_video}}"></a>    
        @endif
        @if ($slider->type == 'video' && $slider->video_type == 'vimeo') 
            @php    
                $vimeoArray = explode('/',$slider->video);
                $vimeoCode = $vimeoArray[count($vimeoArray)-1];
            @endphp 
            <div id="video-content"></div>
            <div id="video" class="player" data-property="{videoURL:'{{$vimeoCode}}', containment:'#video-content', align:'bottom,center', showControls:false, autoPlay:true, loop:true, mute:true, startAt:0, addRaster:true}" data-poster="{{$slider->image_video}}"></div>
        @endif
    @endif
    
    {{-- NAVBAR --}}
    @include('fronted.sections.navbar')

    {{-- SLIDER --}}
    @if ($section->slider_enable == 1 && $slider != null)
        @include('fronted.sections.home')
    @endif

    {{-- ABOUT --}}
    @if ($section->about_enable == 1)
        @include('fronted.sections.about')
    @endif

    {{-- PROJECTS --}}
    @if ($section->projects_enable == 1)
        @include('fronted.sections.projects')
    @endif

    {{-- BLOG --}}
    @if ($section->blog_enable == 1)
        @include('fronted.sections.blog')
    @endif

    {{-- CONTACT --}}
    @if ($section->contact_enable == 1)
        @include('fronted.sections.contact')
    @endif

    {{-- COOKIES --}}
    @if ($general->cookies_enable == 1)
        @include('fronted.sections.cookies')
    @endif

    {{-- FOOTER --}}
    @include('fronted.sections.footer')

</div>
<!-- END PT-WRAPPER  -->

@endsection