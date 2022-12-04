@extends('layouts.admin.main')

@section('content')

<div class="container-fluid">

    {{-- Include the alert file --}}
    @include('admin.modules.alert')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('content.testimonial_of') }}: {{ $testimonial->name }}</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- DataTales -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="font-weight-bold text-primary m-0">{{ __('content.edit_testimonial') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ url('/').'/admin/testimonials' }}/{{ $testimonial->id }}" method="POST" class="user" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" name="order" value="{{ $testimonial->order }}" />
                                <div class="col-md-6 mb-3">
                                    <label for="name" class="form-label">{{ __('content.name') }}</label>
                                    <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" value="{{ $testimonial->name }}" required />
                                    @error('name')
                                        <div class="invalid-feedback">
                                            {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="company" class="form-label">{{ __('content.company') }}</label>
                                    <input class="form-control @error('company') is-invalid @enderror" type="text" name="company" value="{{ $testimonial->company }}" required />
                                    @error('company')
                                        <div class="invalid-feedback">
                                            {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="text" class="form-label">{{ __('content.text') }}</label>
                                    <textarea class="form-control @error('text') is-invalid @enderror" name="text" rows="4" required>{{ $testimonial->text }}</textarea>
                                    @error('text')
                                        <div class="invalid-feedback">
                                            {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 255.
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="image" class="form-label">{{ __('content.image') }}</label>
                                        <div class="d-flex p-3 mb-2 bg-gray-200 justify-content-center">
                                            @php
                                                if ($testimonial->image != ''):
                                                    $image_link = $testimonial->image;
                                                else:
                                                    $image_link = 'uploads/img/image_default.png';
                                                endif;
                                            @endphp
                                            <img src="{{asset('/')}}/@php echo $image_link @endphp" class="img-fluid img-maxsize-200 previewImage_image" />
                                        </div>
                                        <input class="form-control previewImage @error('image') is-invalid @enderror" type="file" name="image" value="" />
                                        <input type="hidden" name="image_current" value="{{$testimonial->image}}" />
                                        <div class="form-text d-flex justify-content-between">
                                            <span>{{ __('content.image_requirements') }}</span>
                                            <span>{{ __('content.image_size_recommended') }} 550x950px</span>
                                        </div>
                                        @error('image')
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
                            <a href="{{ url('/') }}/admin/testimonials">
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
