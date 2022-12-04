@extends('layouts.admin.main')

@section('content')

<div class="container-fluid">

    {{-- Include the alert file --}}
    @include('admin.modules.alert')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('content.new_project') }}</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- DataTales -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="font-weight-bold text-primary m-0">{{ __('content.new_project') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ url('/') }}/admin/work/project" method="POST" class="user" enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <input type="hidden" name="order" value="@php echo (count($projects) > 0) ? (count($projects)+1) : 1; @endphp" />
                            <div class="row">
                                <div class="col-md-12 mb-4">
                                    <label for="enable_project" class="form-label">{{ __('content.enable') }}</label>
                                    <div class="form-switch mb-3">
                                        <input class="form-check-input" type="checkbox" name="enable_project" checked />
                                        <label class="form-check-label" for="enable_project">{{ __('content.enable') }}</label>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="title" class="form-label">{{ __('content.title') }}</label>
                                        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ old('title') }}" required />
                                        @error('title')
                                            <div class="invalid-feedback">
                                                {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="short_desc" class="form-label">{{ __('content.short_desc') }}</label>
                                        <input class="form-control @error('short_desc') is-invalid @enderror" type="text" name="short_desc" value="{{ old('short_desc') }}" required />
                                        @error('short_desc')
                                            <div class="invalid-feedback">
                                                {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <div class="form-group">
                                            <label for="image" class="form-label">{{ __('content.image') }}</label>
                                            <div class="d-flex p-3 mb-2 bg-gray-200 justify-content-center">
                                                <img src="{{asset('/')}}/uploads/img/image_default.png" class="img-fluid img-maxsize-200 previewImage_image" />
                                            </div>
                                            <input class="form-control previewImage @error('image') is-invalid @enderror" type="file" name="image" value=""/>
                                            <div class="form-text d-flex justify-content-between">
                                                <span>{{ __('content.image_requirements') }}</span>
                                                <span>{{ __('content.image_size_recommended') }} 900x550px</span>
                                            </div>
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{ __('content.error_validation_image') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-4">
                                        <label for="category" class="form-label">{{ __('content.category') }}</label>
                                        <select class="form-select" name="category">
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{ $category->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="info-content mb-3">
                                        <label for="info" class="form-label">{{ __('content.info') }}</label>
                                        <div class="row">
                                            <div class="col-5">
                                                <div class="input-group mb-4">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">{{ __('content.info_min') }}</span>
                                                    </div>
                                                    <input type="text" name="info_label" id="info_label_personal-info" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-5">
                                                <div class="input-group mb-4">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text">{{ __('content.text') }}</span>
                                                    </div>
                                                    <input type="text" name="info_value" id="info_value_personal-info" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col-2">
                                                <button type="button" class="btn btn-success w-100 addInfo" data-target="personal-info">{{ __('content.add') }}</button>
                                            </div>
                                            <div class="invalid-feedback d-none invalid-personal-info">
                                                {{ __('content.characters_not_valid') }}
                                            </div>
                                        </div>
                                        <input type="hidden" name="info" value="" data-target="personal-info" id="personal-info" />
                                        <div class="table-elements p-4">
                                            <table class="table table-personal-info w-100" data-target="personal-info">
                                                <tbody>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 mb-4">
                                    <label for="description" class="form-label">{{ __('content.description') }}</label>
                                    @php
                                        $images_value = mt_rand(10,9999);    
                                    @endphp
                                    <input type="hidden" name="images_code" value="project_@php echo $images_value @endphp" />
                                    <textarea class="form-control summernote @error('description') is-invalid @enderror" name="description" data-folder="uploads/img/temp" data-route="{{url('/')}}" data-code="project_@php echo $images_value; @endphp">{{ old('description') }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback d-none">
                                            {{ __('content.text_not_valid') }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12 mb-3">
                                    <hr class="mt-4 mb-5 border-0">
                                    <h4 class="mt-3 mb-2 text-gray-800 fw-bold">{{ __('content.media') }}</h4>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="type" class="form-label">{{ __('content.type') }}</label>
                                    <select class="form-select form-select-visibility @error('type') is-invalid @enderror" name="type">
                                        <option value="standard">{{ __('content.standard') }}</option>
                                        <option value="gallery">{{ __('content.gallery') }}</option>
                                        <option value="video" data-visibility="video-options">{{ __('content.video') }}</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">
                                            {{ __('content.select_not_valid') }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="row">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="image_more_1" class="form-label d-flex justify-content-between">
                                                {{ __('content.image') }} 1
                                                <span class="fw-normal fst-italic remove-image text-primary" data-target="image_more_1" data-url="{{asset('/')}}"><i class="fas fa-times mr-1"></i>{{ __('content.remove_image') }}</span>
                                            </label>
                                            <div class="d-flex p-3 mb-2 bg-gray-200 justify-content-center">
                                                <img src="{{asset('/')}}/uploads/img/image_default.png" class="img-fluid img-maxsize-200 previewImage_image_more_1" />
                                            </div>
                                            <input class="form-control previewImage @error('image_more_1') is-invalid @enderror" type="file" name="image_more_1" value=""/>
                                            <div class="form-text d-flex justify-content-between">
                                                <span>{{ __('content.image_requirements') }}</span>
                                                <span>{{ __('content.image_size_recommended') }} 900x550px</span>
                                            </div>
                                            @error('image_more_1')
                                                <div class="invalid-feedback">
                                                    {{ __('content.error_validation_image') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="image_more_2" class="form-label d-flex justify-content-between">
                                                {{ __('content.image') }} 2
                                                <span class="fw-normal fst-italic remove-image text-primary" data-target="image_more_2" data-url="{{asset('/')}}"><i class="fas fa-times mr-1"></i>{{ __('content.remove_image') }}</span>
                                            </label>
                                            <div class="d-flex p-3 mb-2 bg-gray-200 justify-content-center">
                                                <img src="{{asset('/')}}/uploads/img/image_default.png" class="img-fluid img-maxsize-200 previewImage_image_more_2" />
                                            </div>
                                            <input class="form-control previewImage @error('image_more_2') is-invalid @enderror" type="file" name="image_more_2" value=""/>
                                            <div class="form-text d-flex justify-content-between">
                                                <span>{{ __('content.image_requirements') }}</span>
                                                <span>{{ __('content.image_size_recommended') }} 900x550px</span>
                                            </div>
                                            @error('image_more_2')
                                                <div class="invalid-feedback">
                                                    {{ __('content.error_validation_image') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-visibility video-options d-none">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="video" class="form-label">{{ __('content.video') }}</label>
                                            <input class="form-control @error('video') is-invalid @enderror" type="text" name="video" {{ old('video') }} />
                                            <div class="form-text">{{ __('content.video_iframe_requirements') }}<br/> Example: &#60;iframe ... src="<strong>https://www.youtube.com/embed/kn-1D5z3-Cs</strong> ...&#62;&#60;/iframe&#62;</div>
                                            @error('video')
                                                <div class="invalid-feedback">
                                                    {{ __('content.iframe_not_valid') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary check-summernote">
                                {{ __('content.add') }}
                            </button>
                            <a href="{{ url('/') }}/admin/work/projects">
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
