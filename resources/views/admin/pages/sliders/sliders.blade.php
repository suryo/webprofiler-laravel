@extends('layouts.admin.main')

@section('content')

<div class="container-fluid">

    {{-- Include the alert file --}}
    @include('admin.modules.alert')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('content.sliders') }}</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- DataTales -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="font-weight-bold text-primary m-0">{{ __('content.sliders') }}</h6>
                    <button type="button" class="btn btn-primary btn-round d-inline" data-bs-toggle="modal" data-bs-target="#sliderNewModal">
                        <i class="fas fa-plus small"></i>
                        {{ __('content.add_slider') }}
                    </button>
                </div>
                <div class="card-body">
                    @if (count($sliders) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered datatable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="custom-width" scope="col">#</th>
                                        <th>{{ __('content.type') }}</th>
                                        <th>{{ __('content.media') }}</th>
                                        <th>{{ __('content.color_scheme') }}</th>
                                        <th>{{ __('content.overlay_color') }}</th>
                                        <th>{{ __('content.text') }}</th>
                                        <th class="custom-width-action">{{ __('content.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($sliders as $slider)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td class="text-capitalize">{{ $slider->type }}</td>
                                            <td>
                                                @if ($slider->type == 'image')
                                                    <form class="d-inline-block w-100" action="{{url('/admin/sliders/images')}}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        <button class="btn btn-success btn-icon-split btn-sm mb-1 justify-content-start w-100 min-w-150" data-bs-toggle="modal" data-bs-target="#addImage{{ $slider->id }}">
                                                            <span class="icon text-white-50">
                                                                <i class="fas fa-plus"></i>
                                                            </span>
                                                            <span class="text">{{ __('content.add_image') }}</span>
                                                        </button>
                                                        <div class="modal fade" id="addImage{{ $slider->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('content.add_image') }}</h5>
                                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="{{ __('content.close') }}">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="col-md-12">
                                                                            <div class="form-group">
                                                                                <label class="form-label">{{ __('content.slider_image') }}</label>
                                                                                <div class="d-flex p-3 mb-3 bg-gray-200 justify-content-center">
                                                                                    <img src="{{asset('/')}}/uploads/img/image_default.png" class="img-fluid img-maxsize-200 previewImage_slider_image" />
                                                                                </div>
                                                                                <input class="form-control previewImage" type="file" name="slider_image" required/>
                                                                                <div class="form-text">{{ __('content.image_requirements') }} 1024x768px</div>
                                                                                <input type="hidden" name="slider_id" value="{{ $slider->id }}"/>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-primary">
                                                                            {{ __('content.add') }}
                                                                        </button>
                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('content.close') }}</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    @foreach ($slider_images as $slider_image)
                                                        @if($slider_image['slider_id'] == $slider->id)
                                                            <a href="{{ url('/') }}/admin/sliders/images/{{ $slider->id }}" class="btn btn-info btn-icon-split btn-sm justify-content-start w-100">
                                                                <span class="icon text-white-50">
                                                                    <i class="far fa-file-image"></i>
                                                                </span>
                                                                <span class="text">{{ __('content.images') }}</span>
                                                            </a>
                                                            @break
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <a href="{{ ($slider->video_type == 'server') ? (url('/').'/'.$slider->video) : ($slider->video) }}" class="css3animate popup-content popup-video text-center text-gray-800 d-flex justify-content-between align-items-center w-100">
                                                        <p class="m-0 text-capitalize">{{ $slider->video_type }} {{ __('content.video') }}</p>
                                                        <div class="popup-content-hover css3animate">
                                                            <i class="fas fa-play-circle text-gray-100 css3animate"></i>
                                                        </div>
                                                    </a>
                                                @endif
                                            </td>
                                            <td class="text-capitalize">{{ $slider->color_scheme }}</td>
                                            <td>
                                                @if ($slider->overlay_color == 1)
                                                    <span class="badge badge-pill badge-success">{{ __('content.enabled') }}</span>
                                                @else
                                                    <span class="badge badge-pill badge-danger">{{ __('content.disabled') }}</span>
                                                @endif
                                            </td>
                                            <td class="line-breaks">{{ $slider->text }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ url('/') }}/admin/sliders/{{ $slider->id }}" class="btn btn-primary btn-sm mr-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <form class="d-inline-block" action="{{url('/admin/sliders')}}/{{ $slider->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteSlider{{ $slider->id }}">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                        <div class="modal fade" id="deleteSlider{{ $slider->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="exampleModalCenterTitle">{{ __('Delete') }}</h5>
                                                                        <button type="button" class="close" data-bs-dismiss="modal" aria-label="{{ __('content.close') }}">
                                                                            <span aria-hidden="true">&times;</span>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body text-center">
                                                                        {{ __('content.sure_delete') }}
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-success">{{ __('content.yes_delete') }}</button>
                                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">{{ __('content.cancel') }}</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        {{ __('content.no_sliders_created_yet') }}
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL TO CREATE A NEW SLIDER -->
<div class="modal fade" id="sliderNewModal" tabindex="-1" role="dialog" aria-labelledby="sliderNewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('content.new_slider') }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/').'/admin/sliders' }}" method="POST" class="slider-new user form-visibility" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    
                    <div class="row">
                                
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="desc" class="form-label">{{ __('content.slider_type') }}</label>
                                <select class="form-select form-select-visibility" id="slider_type" name="slider_type" required>
                                    <option value="image" data-visibility="image-options">{{ __('content.image') }}</option>
                                    <option value="video" data-visibility="video-options">{{ __('content.video') }}</option>
                                </select>
                            </div>
                        </div>
                        
                        {{-- COLOR DESIGN --}}
                        <div class="col-12 mb-2">
                            <hr class="mt-2 mb-4 border-0">
                            <h4 class="mt-3 mb-2 text-gray-800 fw-bold">{{ __('content.design') }}</h4>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="slider_overlay_color" class="form-label">{{ __('content.overlay_color') }}</label>
                            <div class="form-switch mb-3">
                                <input class="form-check-input" type="checkbox" data-visibility="overlay-color-options" name="slider_overlay_color">
                                <label class="form-check-label" for="slider_overlay_color">{{ __('content.enable') }}</label>
                            </div>
                        </div>
                        <div class="row overlay-color-options d-none">
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="desc" class="form-label">{{ __('content.type') }}</label>
                                    <select class="form-select" id="slider_overlay_type" name="slider_overlay_type">
                                        <option value="solid">{{ __('content.solid') }}</option>
                                        <option value="gradient">{{ __('content.gradient') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3">
                                <div class="form-group">
                                    <label for="slider_overlay_color_1" class="form-label">{{ __('content.color') }} 1</label>
                                    <input type="color" class="form-control form-control-color" name="slider_overlay_color_1" value="" title="Choose your color" required />
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 overlay-color-2-options d-none">
                                <div class="form-group">
                                    <label for="slider_overlay_gradient_type" class="form-label">{{ __('content.gradient_type') }}</label>
                                    <select class="form-select" id="slider_overlay_gradient_type" name="slider_overlay_gradient_type">
                                        <option value="0">{{ __('content.0_degree') }}</option>
                                        <option value="45">{{ __('content.45_degree') }}</option>
                                        <option value="90">{{ __('content.90_degree') }}</option>
                                        <option value="-45">{{ __('content.45_degree_b') }}</option>
                                        <option value="radial">{{ __('content.radial') }}</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 mb-3 overlay-color-2-options d-none">
                                <div class="form-group">
                                    <label for="slider_overlay_color_2" class="form-label">{{ __('content.color') }} 2</label>
                                    <input type="color" class="form-control form-control-color" name="slider_overlay_color_2" value="" title="Choose your color" required />
                                </div>
                            </div>
                        </div>

                        {{-- TEXT --}}
                        <div class="col-12 mb-2">
                            <hr class="mt-2 mb-4 border-0">
                            <h4 class="mt-3 mb-2 text-gray-800 fw-bold">{{ __('content.text') }}</h4>
                        </div>
                        <div class="col-md-6 mb-3">
                            <div class="form-group">
                                <label for="desc" class="form-label">{{ __('content.color_scheme') }}</label>
                                <select class="form-select" id="slider_color" name="slider_scheme_color">
                                    <option value="light-scheme">{{ __('content.light') }}</option>
                                    <option value="dark-scheme">{{ __('content.dark') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="slider_text_rotator" class="form-label">{{ __('content.slider_rotator') }}</label>
                            <div class="form-switch mb-3">
                                <input class="form-check-input" type="checkbox" id="slider_text_rotator" name="slider_text_rotator">
                                <label class="form-check-label" for="slider_text_rotator">{{ __('content.enable') }}</label>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 slider-text">
                            <div class="form-group mb-3">
                                <label for="slider_text" class="form-label">{{ __('content.text') }}</label>
                                <textarea class="form-control @error('slider_text') is-invalid @enderror"" id="slider_text" name="slider_text" rows="3" required></textarea>
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
                        <div class="col-md-6 mb-3 slider-text-rotator d-none">
                            <div class="form-group">
                                <label for="slider_interval_rotator" class="form-label">{{ __('content.slider_interval_rotator') }}</label>
                                <input class="form-control @error('number') is-invalid @enderror"" type="number" min="500" max="5000" step="100" id="slider_interval_rotator" name="slider_interval_rotator" value="500" />
                                @error('number')
                                    <div class="invalid-feedback">
                                        {{ __('content.number_not_valid') }}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 slider-text-rotator d-none">
                            <div class="form-group">
                                <label for="slider_text_animation_in" class="form-label">{{ __('content.animation_in') }}</label>
                                <select class="form-select" id="slider_text_animation_in" name="slider_text_animation_in">
                                    @foreach ($animations_in as $animation)
                                        <option value="{{$animation}}">{{Str::substr($animation, 9)}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3 slider-text-rotator d-none">
                            <div class="form-group">
                                <label for="slider_text_animation_out" class="form-label">{{ __('content.animation_out') }}</label>
                                <select class="form-select" id="slider_text_animation_out" name="slider_text_animation_out">
                                    @foreach ($animations_out as $animation)
                                        <option value="{{$animation}}">{{Str::substr($animation, 9)}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>

                    {{-- VIDEO OPTIONS --}}
                    <div class="row row-visibility video-options d-none">
                        <div class="col-12 mb-2">
                            <hr class="mt-2 mb-4 border-0">
                            <h4 class="mt-3 mb-2 text-gray-800 fw-bold">{{ __('content.video') }}</h4>
                        </div>
                        <div class="col-md-6 mb-3 slider-video-type">
                            <div class="form-group">
                                <label for="desc" class="form-label">{{ __('content.slider_video_type') }}</label>
                                <select class="form-select" id="slider_video_type" name="slider_video_type">
                                    <option value="server">{{ __('content.server') }}</option>
                                    <option value="youtube">Youtube</option>
                                    <option value="vimeo">Vimeo</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6"></div>
                        <div class="col-md-6 mb-3 slider-video">
                            <div class="form-group video-server">
                                <label for="slider_server_video" class="form-label w-100">{{ __('content.slider_video_server') }}</label>
                                <input class="form-control" type="file" id="slider_server_video" name="slider_server_video" />
                                <div class="form-text">{{ __('content.video_server_requirements') }}</div>
                                <div class="invalid-feedback d-none">
                                    {{ __('content.required') }}
                                </div>
                            </div>
                            <div class="form-group video-url d-none">
                                <label for="slider_url_video" class="form-label">{{ __('content.slider_video_url') }}</label>
                                <input class="form-control" type="text" id="slider_url_video" name="slider_url_video" value=""/>
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
                                <div class="d-flex p-3 mb-3 bg-gray-200 justify-content-center">
                                    <img src="{{asset('/')}}/uploads/img/image_default.png" class="img-fluid img-maxsize-200 previewImage_image_video" />
                                </div>
                                <input class="form-control previewImage @error('image_video') is-invalid @enderror" type="file" name="image_video" value=""/>
                                <div class="form-text d-flex justify-content-between">
                                    <span>{{ __('content.image_requirements') }}</span>
                                    <span>{{ __('content.image_size_recommended') }} 768x576px</span>
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
                        {{ __('content.add') }}
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('content.close') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>


@endsection
