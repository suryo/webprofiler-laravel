@extends('layouts.admin.main')

@section('content')

<div class="container-fluid">

    {{-- Include the alert file --}}
    @include('admin.modules.alert')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('content.slider') }} {{ $slider->id }}</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- DataTales -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="font-weight-bold text-primary m-0">{{ __('content.edit_slider') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ url('/').'/admin/sliders' }}/{{ $slider->id }}" method="POST" class="slider-new user form-visibility" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="desc" class="form-label">{{ __('content.slider_type') }}</label>
                                        <select class="form-select form-select-visibility" id="slider_type" name="slider_type" required>
                                            <option value="image" {{ ($slider->type == 'image') ? 'selected' : '' }} data-visibility="image-options">{{ __('content.image') }}</option>
                                            <option value="video" {{ ($slider->type == 'video') ? 'selected' : '' }} data-visibility="video-options">{{ __('content.video') }}</option>
                                        </select>
                                    </div>
                                </div>
                                
                                {{-- COLOR DESIGN --}}
                                <div class="col-12 mb-2">
                                    <hr class="mt-4 mb-5 border-0">
                                    <h4 class="mt-3 mb-2 text-gray-800 fw-bold">{{ __('content.design') }}</h4>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="slider_overlay_color" class="form-label">{{ __('content.overlay_color') }}</label>
                                    <div class="form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" data-visibility="overlay-color-options" name="slider_overlay_color" {{ ($slider->overlay_color == 1) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="slider_overlay_color">{{ __('content.enable') }}</label>
                                    </div>
                                </div>
                                <div class="row overlay-color-options {{ ($slider->overlay_color == 0) ? 'd-none' : '' }}">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="desc" class="form-label">{{ __('content.type') }}</label>
                                            <select class="form-select" id="slider_overlay_type" name="slider_overlay_type">
                                                <option value="solid" {{ ($slider->overlay_type == 'solid') ? 'selected' : '' }}>{{ __('content.solid') }}</option>
                                                <option value="gradient" {{ ($slider->overlay_type == 'gradient') ? 'selected' : '' }}>{{ __('content.gradient') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group">
                                            <label for="slider_overlay_color_1" class="form-label">{{ __('content.color') }} 1</label>
                                            <input type="color" class="form-control form-control-color" name="slider_overlay_color_1" value="{{$slider->color_1}}" title="Choose your color" required />
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 overlay-color-2-options {{ ($slider->overlay_type == 'solid') ? 'd-none' : '' }}">
                                        <div class="form-group">
                                            <label for="slider_overlay_gradient_type" class="form-label">{{ __('content.gradient_type') }}</label>
                                            <select class="form-select" id="slider_overlay_gradient_type" name="slider_overlay_gradient_type">
                                                <option value="0" {{ ($slider->gradient_type == '0') ? 'selected' : '' }}>{{ __('content.0_degree') }}</option>
                                                <option value="45" {{ ($slider->gradient_type == '45') ? 'selected' : '' }}>{{ __('content.45_degree') }}</option>
                                                <option value="90" {{ ($slider->gradient_type == '90') ? 'selected' : '' }}>{{ __('content.90_degree') }}</option>
                                                <option value="-45" {{ ($slider->gradient_type == '-45') ? 'selected' : '' }}>{{ __('content.45_degree_b') }}</option>
                                                <option value="radial" {{ ($slider->gradient_type == 'radial') ? 'selected' : '' }}>{{ __('content.radial') }}</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3 overlay-color-2-options {{ ($slider->overlay_type == 'solid') ? 'd-none' : '' }}">
                                        <div class="form-group">
                                            <label for="slider_overlay_color_2" class="form-label">{{ __('content.color') }} 2</label>
                                            <input type="color" class="form-control form-control-color" name="slider_overlay_color_2" value="{{$slider->color_2}}" title="Choose your color" required />
                                        </div>
                                    </div>
                                </div>

                                {{-- TEXT --}}
                                <div class="col-12 mb-2">
                                    <hr class="mt-4 mb-5 border-0">
                                    <h4 class="mt-3 mb-2 text-gray-800 fw-bold">{{ __('content.text') }}</h4>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="desc" class="form-label">{{ __('content.color_scheme') }}</label>
                                        <select class="form-select" id="slider_color" name="slider_scheme_color">
                                            <option value="light-scheme" {{ ($slider->color_scheme == 'light-scheme') ? 'selected' : '' }}>{{ __('content.light') }}</option>
                                            <option value="dark-scheme" {{ ($slider->color_scheme == 'dark-scheme') ? 'selected' : '' }}>{{ __('content.dark') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="slider_text_rotator" class="form-label">{{ __('content.slider_rotator') }}</label>
                                    <div class="form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" id="slider_text_rotator" name="slider_text_rotator" {{ ($slider->text_rotator == 1) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="slider_text_rotator">{{ __('content.enable') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 slider-text">
                                    <div class="form-group mb-3">
                                        <label for="slider_text" class="form-label">{{ __('content.text') }}</label>
                                        <textarea class="form-control @error('slider_text') is-invalid @enderror"" id="slider_text" name="slider_text" rows="3" required>{{$slider->text}}</textarea>
                                        <div class="form-text">
                                            <span>{{ __('content.line_breaks') }}</span>
                                        </div>
                                        <div class="form-text">
                                            <span>{{ __('content.line_jump') }}</span>
                                        </div>
                                        <div class="form-text">
                                            <span>{{ __('content.line_mark') }}</span>
                                        </div>
                                        @error('slider_text')
                                            <div class="invalid-feedback">
                                                {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 255.
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 slider-text-rotator {{ ($slider->text_rotator == 0) ? 'd-none' : '' }}">
                                    <div class="form-group">
                                        <label for="slider_interval_rotator" class="form-label">{{ __('content.slider_interval_rotator') }}</label>
                                        <input class="form-control @error('number') is-invalid @enderror"" type="number" min="500" max="5000" step="100" id="slider_interval_rotator" name="slider_interval_rotator" value="{{$slider->text_rotator_interval }}" />
                                        @error('number')
                                            <div class="invalid-feedback">
                                                {{ __('content.number_not_valid') }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 slider-text-rotator {{ ($slider->text_rotator == 0) ? 'd-none' : '' }}">
                                    <div class="form-group">
                                        <label for="slider_text_animation_in" class="form-label">{{ __('content.animation_in') }}</label>
                                        <select class="form-select" id="slider_text_animation_in" name="slider_text_animation_in">
                                            <option value="none" {{ ($slider->animation_in == "none") ? 'selected' : '' }}>{{ __('content.none') }}</option>
                                            @foreach ($animations_in as $animation)
                                                <option value="{{$animation}}" {{ ($slider->animation_in == $animation) ? 'selected' : '' }}>{{Str::substr($animation, 9)}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3 slider-text-rotator {{ ($slider->text_rotator == 0) ? 'd-none' : '' }}">
                                    <div class="form-group">
                                        <label for="slider_text_animation_out" class="form-label">{{ __('content.animation_out') }}</label>
                                        <select class="form-select" id="slider_text_animation_out" name="slider_text_animation_out">
                                            <option value="none" {{ ($slider->animation_out == "none") ? 'selected' : '' }}>{{ __('content.none') }}</option>
                                            @foreach ($animations_out as $animation)
                                                <option value="{{$animation}}" {{ ($slider->animation_out == $animation) ? 'selected' : '' }}>{{Str::substr($animation, 9)}}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            {{-- VIDEO OPTIONS --}}
                            <div class="row row-visibility video-options @php echo ($slider->type == 'image') ? 'd-none' : ''; @endphp">
                                <div class="col-12 mb-2">
                                    <hr class="mt-4 mb-5 border-0">
                                    <h4 class="mt-3 mb-2 text-gray-800 fw-bold">{{ __('content.video') }}</h4>
                                </div>
                                <div class="col-md-6 mb-3 slider-video-type">
                                    <div class="form-group">
                                        <label for="desc" class="form-label">{{ __('content.slider_video_type') }}</label>
                                        <select class="form-select" id="slider_video_type" name="slider_video_type">
                                            <option value="server" {{ ($slider->video_type == 'server') ? 'selected' : '' }}>{{ __('content.server') }}</option>
                                            <option value="youtube" {{ ($slider->video_type == 'youtube') ? 'selected' : '' }}>Youtube</option>
                                            <option value="vimeo" {{ ($slider->video_type == 'vimeo') ? 'selected' : '' }}>Vimeo</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6"></div>
                                <div class="col-md-6 mb-3 slider-video">
                                    <div class="form-group video-server {{ ($slider->video_type != 'server') ? 'd-none' : '' }}">
                                        <label for="slider_server_video" class="form-label w-100">{{ __('content.slider_video_server') }}
                                        @if ($slider->type == 'video' && $slider->video_type == 'server')
                                            <span class="float-end fst-italic fw-normal text-success">{{ __('content.current_video') }} {{Str::substr($slider->video, 23)}}</span>
                                        @endif
                                        </label>
                                        <input class="form-control" type="file" id="slider_server_video" name="slider_server_video" />
                                        <input type="hidden" name="slider_server_video_current" value="{{$slider->video}}" />
                                        <div class="form-text">{{ __('content.video_server_requirements') }}</div>
                                        <div class="invalid-feedback d-none">
                                            {{ __('content.required') }}
                                        </div>
                                    </div>
                                    <div class="form-group video-url {{ ($slider->video_type == 'server') ? 'd-none' : '' }}">
                                        <label for="slider_url_video" class="form-label">{{ __('content.slider_video_url') }}
                                        </label>
                                        <input class="form-control" type="text" id="slider_url_video" name="slider_url_video" value="{{$slider->video}}"/>
                                        <div class="form-text">{{ __('content.video_url_requirements') }}</div>
                                        <div class="invalid-feedback d-none">
                                            {{ __('content.required') }}
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image_video" class="form-label d-flex justify-content-between">
                                            {{ __('content.image_replaced') }}
                                            <span class="fw-normal fst-italic remove-image text-primary" data-target="image_video" data-url="{{asset('/')}}"><i class="fas fa-times mr-1"></i>{{ __('content.remove_image') }}</span>
                                        </label>
                                        @php
                                            $imgVideoUrl = ($slider->image_video != '') ? $slider->image_video : 'uploads/img/image_default.png';
                                        @endphp
                                        <div class="d-flex p-3 mb-3 bg-gray-200 justify-content-center">
                                            <img src="{{asset('/')}}/@php echo $imgVideoUrl; @endphp" class="img-fluid img-maxsize-200 previewImage_image_video" />
                                        </div>
                                        <input class="form-control previewImage @error('image_video') is-invalid @enderror" type="file" name="image_video" value=""/>
                                        <input type="hidden" name="image_video_current" value="{{$slider->image_video}}" />
                                        <div class="form-text d-flex justify-content-between">
                                            <span>{{ __('content.image_requirements') }}</span>
                                            <span>{{ __('content.image_size_recommended') }} 160x160px</span>
                                        </div>
                                        @error('image_video')
                                            <div class="invalid-feedback">
                                                {{ __('content.error_validation_image') }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary" id="submitSliderBtn">
                                {{ __('content.update') }}
                            </button>
                            <a href="{{ url('/') }}/admin/sliders">
                                <button type="button" class="btn btn-secondary">{{ __('content.cancel') }}</button>
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
