@extends('layouts.admin.main')

@section('content')

<div class="container-fluid">

    {{-- Include the alert file --}}
    @include('admin.modules.alert')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('content.general') }}</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- DataTales -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="font-weight-bold text-primary m-0">{{ __('content.general') }}</h6>
                </div>
                <div class="card-body">
                    <form class="form-visibility"  action="{{ url('/').'/admin/general' }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="title" class="form-label">{{ __('content.title') }}</label>
                                        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{$general->title}}" />
                                        @error('title')
                                            <div class="invalid-feedback">
                                                {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="description" class="form-label">{{ __('content.description') }}</label>
                                        <input class="form-control @error('description') is-invalid @enderror" type="text" name="description" value="{{$general->description}}" />
                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 255.
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group info-content mb-4">
                                        <label for="keywords" class="form-label">{{ __('content.keywords') }}</label>
                                        <div class="row">
                                            <div class="col-10">
                                                <div class="input-group mb-3">
                                                    <input type="text" name="keyword_label" id="info_label_keywords-list" class="form-control">
                                                    <input type="hidden" name="keyword_value" id="info_value_keywords-list" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <button type="button" class="btn btn-success w-100 addInfo" data-target="keywords-list">{{ __('content.add') }}</button>
                                            </div>
                                            <div class="invalid-feedback d-none invalid-keywords-list">
                                                {{ __('content.characters_not_valid') }}
                                            </div>
                                        </div>
                                        <input type="hidden" name="keywords" value="{{$general->keywords}}" id="keywords-list" />
                                        <div class="table-elements p-4">
                                            <table class="table table-keywords-list w-100 p-4" data-target="keywords-list">
                                                <tbody>
                                                    @php
                                                    $keywords = json_decode($general->keywords, true);
                                                    if(!empty($keywords)):
                                                        foreach($keywords as $key => $value){
                                                            echo '
                                                            <tr>
                                                                <td class="fw-bold">'.$value["title"].'</td>
                                                                <td>'.$value["text"].'</td>
                                                                <td class="text-right">
                                                                    <button type="button" class="btn btn-outline-danger btn-sm rounded-circle deleteInfo" data-info="'.$value["title"].'" data-value="'.$value["text"].'">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>                                                            
                                                            </tr>';
                                                        }  
                                                    endif; 
                                                    @endphp
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="analytics_code" class="form-label">{{ __('content.analytics_code') }}</label>
                                        <input class="form-control @error('analytics_code') is-invalid @enderror" type="text" name="analytics_code" value="{{$general->analytics_code}}" />
                                        <div class="form-text d-flex">
                                            <span>{{ __('content.analytics_code_desc') }}</span>
                                        </div>
                                        @error('analytics_code')
                                            <div class="invalid-feedback">
                                                {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 255.
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group mb-5">
                                        <label for="image_favicon" class="form-label d-flex justify-content-between">
                                            {{ __('content.image_favicon') }}
                                            <span class="fw-normal fst-italic remove-image text-primary" data-target="image_favicon" data-url="{{asset('/')}}"><i class="fas fa-times mr-1"></i>{{ __('content.remove_image') }}</span>
                                        </label>
                                        @php
                                            $imgFaviconUrl = ($general->image_favicon != '') ? $general->image_favicon : 'uploads/img/image_default.png';
                                        @endphp
                                        <div class="d-flex p-3 mb-3 bg-gray-200 justify-content-center">
                                            <img src="{{asset('/')}}/@php echo $imgFaviconUrl; @endphp" class="img-fluid img-maxsize-200 previewImage_image_favicon" />
                                        </div>
                                        <input class="form-control previewImage @error('image_favicon') is-invalid @enderror" type="file" name="image_favicon" value=""/>
                                        <input type="hidden" name="image_favicon_current" value="{{$general->image_favicon}}" />
                                        <div class="form-text d-flex justify-content-between">
                                            <span>{{ __('content.image_requirements_png') }}</span>
                                            <span>{{ __('content.image_size_min') }} 155x155px</span>
                                        </div>
                                        @error('image_favicon')
                                            <div class="invalid-feedback">
                                                {{ __('content.error_validation_image') }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-5">
                                        <label for="image_logo_header_dark" class="form-label d-flex justify-content-between">
                                            {{ __('content.image_logo_header_dark') }}
                                            <span class="fw-normal fst-italic remove-image text-primary" data-target="image_logo_header_dark" data-url="{{asset('/')}}"><i class="fas fa-times mr-1"></i>{{ __('content.remove_image') }}</span>
                                        </label>
                                        @php
                                            $imgHeaderUrl = ($general->image_logo_header_dark != '') ? $general->image_logo_header_dark : 'uploads/img/image_default.png';
                                        @endphp
                                        <div class="d-flex p-3 mb-3 bg-gray-200 justify-content-center">
                                            <img src="{{asset('/')}}/@php echo $imgHeaderUrl; @endphp" class="img-fluid img-maxsize-200 previewImage_image_logo_header_dark" />
                                        </div>
                                        <input class="form-control previewImage @error('image_logo_header_dark') is-invalid @enderror" type="file" name="image_logo_header_dark" value=""/>
                                        <input type="hidden" name="image_logo_header_dark_current" value="{{$general->image_logo_header_dark}}" />
                                        <div class="form-text d-flex justify-content-between">
                                            <span>{{ __('content.image_requirements') }}</span>
                                            <span>{{ __('content.image_size_recommended') }} 150x60px</span>
                                        </div>
                                        @error('image_logo_header_dark')
                                            <div class="invalid-feedback">
                                                {{ __('content.error_validation_image') }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-5">
                                        <label for="image_logo_header_light" class="form-label d-flex justify-content-between">
                                            {{ __('content.image_logo_header_light') }}
                                            <span class="fw-normal fst-italic remove-image text-primary" data-target="image_logo_header_light" data-url="{{asset('/')}}"><i class="fas fa-times mr-1"></i>{{ __('content.remove_image') }}</span>
                                        </label>
                                        @php
                                            $imgHeaderUrl = ($general->image_logo_header_light != '') ? $general->image_logo_header_light : 'uploads/img/image_default.png';
                                        @endphp
                                        <div class="d-flex p-3 mb-3 bg-gray-200 justify-content-center">
                                            <img src="{{asset('/')}}/@php echo $imgHeaderUrl; @endphp" class="img-fluid img-maxsize-200 previewImage_image_logo_header_light" />
                                        </div>
                                        <input class="form-control previewImage @error('image_logo_header_light') is-invalid @enderror" type="file" name="image_logo_header_light" value=""/>
                                        <input type="hidden" name="image_logo_header_light_current" value="{{$general->image_logo_header_light}}" />
                                        <div class="form-text d-flex justify-content-between">
                                            <span>{{ __('content.image_requirements') }}</span>
                                            <span>{{ __('content.image_size_recommended') }} 150x60px</span>
                                        </div>
                                        @error('image_logoimage_logo_header_light_header')
                                            <div class="invalid-feedback">
                                                {{ __('content.error_validation_image') }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-5">
                                        <label for="menu_position" class="form-label w-100">{{ __('content.menu_position') }}</label>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="menu_position" value="left" {{ ($general->menu_position == "left") ? 'checked' : '' }}>
                                            <label class="form-check-label">{{ __('content.left') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="menu_position" value="center" {{ ($general->menu_position == "center") ? 'checked' : '' }}>
                                            <label class="form-check-label">{{ __('content.center') }}</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="menu_position" value="right" {{ ($general->menu_position == "right") ? 'checked' : '' }}>
                                            <label class="form-check-label">{{ __('content.right') }}</label>
                                        </div>
                                    </div>
                                    <div class="form-group info-content">
                                        <label for="social_links" class="form-label">{{ __('content.social_links') }}</label>
                                        <div class="row">
                                            <div class="col-3">
                                                <div class="input-group mb-3">
                                                    <select class="form-select select-social" name="social_network" id="info_label_personal-info">
                                                        <option value="fab fa-facebook-f">Facebok</option>
                                                        <option value="fab fa-twitter">Twitter</option>
                                                        <option value="fab fa-instagram">Instagram</option>
                                                        <option value="fab fa-linkedin-in">Linkedin</option>
                                                        <option value="fab fa-github">GitHub</option>
                                                        <option value="fab fa-pinterest-p">Pinterest</option>
                                                        <option value="fab fa-reddit-alien">Reddit</option>
                                                        <option value="fab fa-snapchat-ghost">Snapchat</option>
                                                        <option value="fab fa-telegram-plane">Telegram</option>
                                                        <option value="fab fa-twitch">Twitch</option>
                                                        <option value="fab fa-vimeo-v">Vimeo</option>
                                                        <option value="fab fa-youtube">Youtube</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-7">
                                                <div class="input-group mb-3">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">{{ __('content.link') }}</span>
                                                    </div>
                                                    <input type="text" name="social_links" id="info_value_personal-info" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <button type="button" class="btn btn-success w-100 addInfo" data-target="personal-info">{{ __('content.add') }}</button>
                                            </div>
                                            <div class="invalid-feedback d-none invalid-personal-info">
                                                {{ __('content.characters_not_valid') }}
                                            </div>
                                        </div>
                                        <input type="hidden" name="social_links" value="{{$general->social_links}}" id="personal-info" />
                                        <div class="table-elements p-4">
                                            <table class="table table-personal-info w-100" data-target="personal-info">
                                                <tbody>
                                                    @php
                                                    $social_links = json_decode($general->social_links, true);
                                                    if(!empty($social_links)):
                                                        foreach($social_links as $key => $value){
                                                            echo '
                                                            <tr>
                                                                <td class="fw-bold"><span class="'.$value["title"].'"></span></td>
                                                                <td>'.$value["text"].'</td>
                                                                <td class="text-right">
                                                                    <button type="button" class="btn btn-outline-danger btn-sm rounded-circle deleteInfo" data-info="'.$value["title"].'" data-value="'.$value["text"].'">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>                                                            
                                                            </tr>';
                                                        }  
                                                    endif; 
                                                    @endphp
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <hr class="mt-4 mb-5 border-0">
                                    <h4 class="mt-3 mb-2 text-gray-800 fw-bold mb-3">{{ __('content.loader') }}</h4>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="loader" class="form-label">{{ __('content.loader') }}</label>
                                        <div class="form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" data-visibility="loader-options" name="loader" {{ ($general->loader == 1) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="loader">{{ __('content.enable') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row loader-options {{ ($general->loader == 0) ? 'd-none' : '' }}">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="loader_scheme_color" class="form-label">{{ __('content.color_scheme') }}</label>
                                        <select class="form-select @error('loader_scheme_color') is-invalid @enderror" name="loader_scheme_color">
                                            <option value="light-scheme" @php echo ($general->loader_scheme_color == 'light-scheme') ? 'selected' : ''; @endphp>{{ __('content.light_scheme') }}</option>
                                            <option value="dark-scheme" @php echo ($general->loader_scheme_color == 'dark-scheme') ? 'selected' : ''; @endphp>{{ __('content.dark_scheme') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image_logo_loader" class="form-label d-flex justify-content-between">
                                            {{ __('content.image_logo_loader') }}
                                            <span class="fw-normal fst-italic remove-image text-primary" data-target="image_logo_loader" data-url="{{asset('/')}}"><i class="fas fa-times mr-1"></i>{{ __('content.remove_image') }}</span>
                                        </label>
                                        @php
                                            $imgLoaderUrl = ($general->image_logo_loader != '') ? $general->image_logo_loader : 'uploads/img/image_default.png';
                                        @endphp
                                        <div class="d-flex p-3 mb-3 bg-gray-200 justify-content-center">
                                            <img src="{{asset('/')}}/@php echo $imgLoaderUrl; @endphp" class="img-fluid img-maxsize-200 previewImage_image_logo_loader" />
                                        </div>
                                        <input class="form-control previewImage @error('image_logo_loader') is-invalid @enderror" type="file" name="image_logo_loader" value=""/>
                                        <input type="hidden" name="image_logo_loader_current" value="{{$general->image_logo_loader}}" />
                                        <div class="form-text d-flex justify-content-between">
                                            <span>{{ __('content.image_requirements') }}</span>
                                            <span>{{ __('content.image_size_recommended') }} 160x160px</span>
                                        </div>
                                        @error('image_logo_loader')
                                            <div class="invalid-feedback">
                                                {{ __('content.error_validation_image') }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <hr class="mt-4 mb-5 border-0">
                                    <h4 class="mt-3 mb-2 text-gray-800 fw-bold mb-3">{{ __('content.cookies') }}</h4>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="cookies_enable" class="form-label">{{ __('content.cookies') }}</label>
                                        <div class="form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" data-visibility="cookies-options" name="cookies_enable" {{ ($general->cookies_enable == 1) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="cookies_enable">{{ __('content.enable') }}</label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row cookies-options {{ ($general->cookies_enable == 0) ? 'd-none' : '' }}">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="cookies_color" class="form-label">{{ __('content.color_scheme') }}</label>
                                        <select class="form-select @error('loader_scheme_color') is-invalid @enderror" name="cookies_color">
                                            <option value="light-scheme" @php echo ($general->cookies_color == 'light-scheme') ? 'selected' : ''; @endphp>{{ __('content.light_scheme') }}</option>
                                            <option value="dark-scheme" @php echo ($general->cookies_color == 'dark-scheme') ? 'selected' : ''; @endphp>{{ __('content.dark_scheme') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="cookies_style" class="form-label">{{ __('content.style') }}</label>
                                        <select class="form-select @error('cookies_style') is-invalid @enderror" name="cookies_style">
                                            <option value="boxed-left" @php echo ($general->cookies_style == 'boxed-left') ? 'selected' : ''; @endphp>{{ __('content.boxed_left') }}</option>
                                            <option value="boxed-right" @php echo ($general->cookies_style == 'boxed-right') ? 'selected' : ''; @endphp>{{ __('content.boxed_right') }}</option>
                                            <option value="wide" @php echo ($general->cookies_style == 'wide') ? 'selected' : ''; @endphp>{{ __('content.wide') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="cookies_alignment" class="form-label">{{ __('content.text_alignment') }}</label>
                                        <select class="form-select @error('cookies_alignment') is-invalid @enderror" name="cookies_alignment">
                                            <option value="start" @php echo ($general->cookies_alignment == 'start') ? 'selected' : ''; @endphp>{{ __('content.left') }}</option>
                                            <option value="center" @php echo ($general->cookies_alignment == 'center') ? 'selected' : ''; @endphp>{{ __('content.center') }}</option>
                                            <option value="end" @php echo ($general->cookies_alignment == 'end') ? 'selected' : ''; @endphp>{{ __('content.right') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="title" class="form-label">{{ __('content.title') }}</label>
                                        <input class="form-control @error('cookies_title') is-invalid @enderror" type="text" name="cookies_title" value="{{$general->cookies_title}}" />
                                        @error('cookies_title')
                                            <div class="invalid-feedback">
                                                {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <label for="cookies_text" class="form-label">{{ __('content.text') }}</label>
                                    <textarea class="form-control summernote-simple @error('cookies_text') is-invalid @enderror" name="cookies_text">{{$general->cookies_text}}</textarea>
                                    @error('cookies_text')
                                        <div class="invalid-feedback d-none">
                                            {{ __('content.text_not_valid') }}
                                        </div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary check-summernote">
                                {{ __('content.update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
