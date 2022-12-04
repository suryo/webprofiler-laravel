@extends('layouts.admin.main')

@section('content')

<div class="container-fluid">

    {{-- Include the alert file --}}
    @include('admin.modules.alert')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('content.testimonials') }}</h1>
    </div>

    <div class="row">
        
        {{-- TESTIMONIALS TABLE --}}
        <div class="col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="font-weight-bold text-primary m-0">{{ __('content.testimonials') }}</h6>
                    <button type="button" class="btn btn-primary btn-round d-inline" data-bs-toggle="modal" data-bs-target="#testimonialNewModal">
                        <i class="fas fa-plus small"></i>
                        {{ __('content.add_testimonial') }}
                    </button>
                </div>
                <div class="card-body">
                    @if (count($testimonials) > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered datatable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th class="custom-width" scope="col">#</th>
                                        <th class="custom-width-150">{{ __('content.image') }}</th>
                                        <th>{{ __('content.name') }}</th>
                                        <th>{{ __('content.company') }}</th>
                                        <th>{{ __('content.text') }}</th>
                                        <th>{{ __('content.order') }}</th>
                                        <th class="custom-width-action">{{ __('content.action') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php $i = 1; @endphp
                                    @foreach ($testimonials as $testimonial)
                                        <tr>
                                            <td>{{ $i }}</td>
                                            <td class="custom-width-150">
                                                <a href="{{url('/')}}/{{ $testimonial->image }}" class="css3animate popup-content popup-image text-center text-gray-800 d-flex justify-content-between align-items-start w-100">
                                                    <img class="img-fluid" src="{{url('/')}}/{{ $testimonial->image }}" />
                                                    <div class="popup-content-hover css3animate">
                                                        <i class="fas fa-search-plus text-gray-100 css3animate"></i>
                                                    </div>
                                                </a>
                                            </td>
                                            <td>{{ $testimonial->name }}</td>
                                            <td>{{ $testimonial->company }}</td>
                                            <td>{{ $testimonial->text }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    @if ($i < count($testimonials))
                                                        <a href="{{ url('/') }}/admin/testimonials/order-down/{{ $testimonial->id }}" class="btn btn-warning btn-sm mr-1">
                                                            <i class="fas fa-arrow-down"></i>
                                                        </a>
                                                    @endif
                                                    @if ($i != 1)
                                                        <a href="{{ url('/') }}/admin/testimonials/order-up/{{ $testimonial->id }}" class="btn btn-warning btn-sm mr-1">
                                                            <i class="fas fa-arrow-up"></i>
                                                        </a>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group">
                                                    <a href="{{ url('/') }}/admin/testimonials/{{ $testimonial->id }}" class="btn btn-primary btn-sm mr-1">
                                                        <i class="fas fa-pencil-alt"></i>
                                                    </a>
                                                    <form class="d-inline-block" action="{{url('/admin/testimonials')}}/{{ $testimonial->id }}" method="POST">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteTestimonial{{ $testimonial->id }}">
                                                            <i class="far fa-trash-alt"></i>
                                                        </button>
                                                        <div class="modal fade" id="deleteTestimonial{{ $testimonial->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                        @php $i++; @endphp
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        {{ __('content.no_testimonials_created_yet') }}
                    @endif
                </div>
            </div>
        </div>

    </div>
</div>

<!-- MODAL TO CREATE A NEW TESTIMONIAL -->
<div class="modal fade" id="testimonialNewModal" tabindex="-1" role="dialog" aria-labelledby="testimonialNewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('content.new_testimonial') }}</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ url('/').'/admin/testimonials' }}" method="POST" class="user" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="order" value="@php echo (count($testimonials) > 0) ? $i : 1; @endphp" />
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">{{ __('content.name') }}</label>
                            <input class="form-control @error('name') is-invalid @enderror" type="text" name="name" required value="{{old('name')}}" />
                            @error('name')
                                <div class="invalid-feedback">
                                    {{ __('content.text_not_valid') }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="company" class="form-label">{{ __('content.company') }}</label>
                            <input class="form-control @error('company') is-invalid @enderror" type="text" name="company" required value="{{old('company')}}" />
                            @error('company')
                                <div class="invalid-feedback">
                                    {{ __('content.text_not_valid') }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="text" class="form-label">{{ __('content.text') }}</label>
                            <textarea class="form-control @error('text') is-invalid @enderror" name="text" rows="4" required>{{old('text')}}</textarea>
                            @error('text')
                                <div class="invalid-feedback">
                                    {{ __('content.text_not_valid') }}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="image" class="form-label">{{ __('content.image') }}</label>
                            <div class="d-flex p-3 mb-2 bg-gray-200 justify-content-center">
                                <img src="{{asset('/')}}/uploads/img/image_default.png" class="img-fluid img-maxsize-200 previewImage_image" />
                            </div>
                            <input class="form-control previewImage @error('image') is-invalid @enderror" type="file" name="image" value="" required/>
                            <div class="form-text d-flex">
                                <span>{{ __('content.image_requirements') }}</span>
                            </div>
                            <div class="form-text d-flex">
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
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">
                        {{ __('content.add') }}
                    </button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">{{ __('content.close') }}</button>
                </div>
            </form>
        </div>
    </div>
</div>

@if (Session::has('error-modal'))
    <input class="openModal" data-id="testimonialNewModal" type="hidden" val="1" />
@endif

@endsection
