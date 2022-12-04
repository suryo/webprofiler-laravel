@extends('layouts.admin.main')

@section('content')

<div class="container-fluid">

    {{-- Include the alert file --}}
    @include('admin.modules.alert')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('content.map') }}</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- DataTales -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="font-weight-bold text-primary m-0">{{ __('content.map') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ url('/').'/admin/map' }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="latitude" class="form-label">{{ __('content.latitude') }}</label>
                                        <input class="form-control @error('latitude') is-invalid @enderror" type="text" name="latitude" value="{{$map->latitude}}" />
                                        @error('latitude')
                                            <div class="invalid-feedback">
                                                {{ __('content.coordinate_not_valid') }} {{ __('content.min') }}: -90. {{ __('content.max') }}: 90.
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="longitude" class="form-label">{{ __('content.longitude') }}</label>
                                        <input class="form-control @error('longitude') is-invalid @enderror" type="text" name="longitude" value="{{$map->longitude}}" />
                                        @error('email')
                                            <div class="invalid-feedback">
                                                {{ __('content.coordinate_not_valid') }} {{ __('content.min') }}: -180. {{ __('content.max') }}: 180.
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="zoom" class="form-label">{{ __('content.zoom') }}</label>
                                        <input class="form-control @error('zoom') is-invalid @enderror" type="number" min="1" max="20" name="zoom" value="{{$map->zoom}}" />
                                        @error('zoom')
                                            <div class="invalid-feedback">
                                                {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="map_style" class="form-label">{{ __('content.map_style') }}</label>
                                        <select class="form-select @error('map_style') is-invalid @enderror" name="map_style">
                                            <option value="defaultstyle" @php echo ($map->map_style == 'defaultstyle') ? 'selected' : ''; @endphp>Default</option>
                                            <option value="lightgrey" @php echo ($map->map_style == 'lightgrey') ? 'selected' : ''; @endphp>Light grey</option>
                                            <option value="darkgrey" @php echo ($map->map_style == 'darkgrey') ? 'selected' : ''; @endphp>Dark grey</option>
                                            <option value="vintage" @php echo ($map->map_style == 'vintage') ? 'selected' : ''; @endphp>Vintage</option>
                                        </select>
                                        <div class="form-text d-flex">
                                            <span>{{ __('content.map_style_desc') }}</span>
                                        </div>
                                        @error('map_style')
                                            <div class="invalid-feedback">
                                                {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="map_text" class="form-label">{{ __('content.map_text') }}</label>
                                        <input class="form-control @error('map_text') is-invalid @enderror" type="text" name="map_text" value="{{$map->map_text}}" />
                                        @error('map_text')
                                            <div class="invalid-feedback">
                                                {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="map_key" class="form-label">{{ __('content.map_key') }}</label>
                                        <input class="form-control @error('map_key') is-invalid @enderror" type="text" name="map_key" value="{{$map->map_key}}" />
                                        <div class="form-text d-flex">
                                            <span>{{ __('content.map_key_desc') }}</span>
                                        </div>
                                        @error('map_key')
                                            <div class="invalid-feedback">
                                                {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="icon_image" class="form-label d-flex justify-content-between">
                                            {{ __('content.map_icon') }}
                                            <span class="fw-normal fst-italic remove-image text-primary" data-target="icon_image" data-url="{{asset('/')}}"><i class="fas fa-times mr-1"></i>{{ __('content.remove_image') }}</span>
                                        </label>
                                        @php
                                            $imgIconUrl = ($map->icon_image != '') ? $map->icon_image : 'uploads/img/image_default.png';
                                        @endphp
                                        <div class="d-flex p-3 mb-2 bg-gray-200 justify-content-center">
                                            <img src="{{asset('/')}}/@php echo $imgIconUrl; @endphp" class="img-fluid img-maxsize-200 previewImage_icon_image" />
                                        </div>
                                        <input class="form-control previewImage @error('icon_image') is-invalid @enderror" type="file" name="icon_image" value=""/>
                                        <input type="hidden" name="icon_image_current" value="{{$map->icon_image}}" />
                                        <div class="form-text d-flex justify-content-between">
                                            <span>{{ __('content.image_requirements') }}</span>
                                            <span>{{ __('content.image_size_recommended') }} 48x48px</span>
                                        </div>
                                        @error('icon_image')
                                            <div class="invalid-feedback">
                                                {{ __('content.error_validation_image') }}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">
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
