@extends('layouts.admin.main')

@section('content')

<div class="container-fluid">

    {{-- Include the alert file --}}
    @include('admin.modules.alert')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{$post->title}}</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- DataTales -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="font-weight-bold text-primary m-0">{{ __('content.edit_post') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{url('/admin/blog/post')}}/{{ $post->id }}" method="POST" class="user" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" name="id" value="{{$post->id}}" />
                                <div class="col-md-6 mb-3">
                                    <label for="title" class="form-label">{{ __('content.title') }}</label>
                                    <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{ $post->title }}" required />
                                    @error('title')
                                        <div class="invalid-feedback">
                                            {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="short_desc" class="form-label">{{ __('content.entry') }}</label>
                                    <input class="form-control @error('short_desc') is-invalid @enderror" type="text" name="short_desc" value="{{ $post->short_desc }}" />
                                    @error('short_desc')
                                        <div class="invalid-feedback">
                                            {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 255.
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="author" class="form-label">{{ __('content.author') }}</label>
                                    <input class="form-control @error('author') is-invalid @enderror" type="text" name="author" value="{{ $post->author }}" required />
                                    @error('author')
                                        <div class="invalid-feedback">
                                            {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="category" class="form-label">{{ __('content.category') }}</label>
                                    <select class="form-select @error('category') is-invalid @enderror" name="category">
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}" @php echo ($category->id == $post->category_id) ? 'selected' : ''; @endphp>{{ $category->name}}</option>
                                        @endforeach
                                    </select>
                                    @error('category')
                                        <div class="invalid-feedback">
                                            {{ __('content.select_not_valid') }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="status" class="form-label">{{ __('content.status') }}</label>
                                    <select class="form-select @error('status') is-invalid @enderror" name="status">
                                        <option value="pending" @php echo ($post->status == 'pending') ? 'selected' : ''; @endphp>{{ __('content.pending') }}</option>
                                        <option value="published" @php echo ($post->status == 'published') ? 'selected' : ''; @endphp>{{ __('content.published') }}</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">
                                            {{ __('content.select_not_valid') }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="slug" class="form-label">{{ __('content.slug') }}</label>
                                    <input class="form-control @error('slug') is-invalid @enderror" type="text" name="slug" value="{{ $post->slug }}" required />
                                    @error('slug')
                                        <div class="invalid-feedback">
                                            {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label for="text" class="form-label">{{ __('content.content') }}</label>
                                    <input type="hidden" name="images_code" value="{{$post->images_code}}" />
                                    <textarea class="form-control summernote @error('text') is-invalid @enderror" name="text" data-folder="uploads/img/temp" data-route="{{url('/')}}" data-code="{{$post->images_code}}">{{ $post->text }}</textarea>
                                    @error('text')
                                        <div class="invalid-feedback">
                                            {{ __('content.text_required') }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12 mb-2">
                                    <hr class="mt-4 mb-5 border-0">
                                    <h4 class="mt-3 mb-2 text-gray-800 fw-bold">{{ __('content.media') }}</h4>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="type" class="form-label">{{ __('content.type') }}</label>
                                    <select class="form-select form-select-visibility @error('type') is-invalid @enderror" name="type">
                                        <option value="standard" data-visibility="image-options" @php echo ($post->type == 'standard') ? 'selected' : ''; @endphp>{{ __('content.standard') }}</option>
                                        <option value="gallery" @php echo ($post->type == 'gallery') ? 'selected' : ''; @endphp>{{ __('content.gallery') }}</option>
                                        <option value="video" data-visibility="video-options" @php echo ($post->type == 'video') ? 'selected' : ''; @endphp>{{ __('content.video') }}</option>
                                        <option value="quote" data-visibility="quote-options" @php echo ($post->type == 'quote') ? 'selected' : ''; @endphp>{{ __('content.quote') }}</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">
                                            {{ __('content.select_not_valid') }}
                                        </div>
                                    @enderror
                                </div>

                                <div class="row row-visibility image-options @php echo ($post->type == 'standard') ? '' : 'd-none'; @endphp">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="image" class="form-label">{{ __('content.image') }}</label>
                                            <div class="d-flex p-3 mb-2 bg-gray-200 justify-content-center">
                                                @php
                                                    if ($post->image != ''):
                                                        $image_link = $post->image;
                                                    else:
                                                        $image_link = 'uploads/img/image_default.png';
                                                    endif;
                                                @endphp
                                                <img src="{{asset('/')}}/@php echo $image_link @endphp" class="img-fluid img-maxsize-200 previewImage_image" />
                                            </div>
                                            <input class="form-control previewImage @error('image') is-invalid @enderror" type="file" name="image" value=""/>
                                            <input type="hidden" name="image_current" value="{{$post->image}}" />
                                            <div class="form-text d-flex justify-content-between">
                                                <span>{{ __('content.image_requirements') }}</span>
                                                <span>{{ __('content.image_size_recommended') }} 900x675px</span>
                                            </div>
                                            @error('image')
                                                <div class="invalid-feedback">
                                                    {{ __('content.error_validation_image') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="row row-visibility video-options @php echo ($post->type == 'video') ? '' : 'd-none'; @endphp">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="video" class="form-label">{{ __('content.video') }}</label>
                                            @php
                                                if ($post->video != null && $post->video != ''){
                                                    $arrayVideo = explode(' ', $post->video);
                                                    $urlVideo = substr($arrayVideo[2], 5, -1);
                                                } else {
                                                    $urlVideo = '';
                                                }
                                            @endphp
                                            <input class="form-control @error('video') is-invalid @enderror" type="text" name="video" value="{{$urlVideo}}" />
                                            <div class="form-text">{{ __('content.video_iframe_requirements') }}<br/> Example: &#60;iframe ... src="<strong>https://www.youtube.com/embed/kn-1D5z3-Cs</strong> ...&#62;&#60;/iframe&#62;</div>
                                            @error('video')
                                                <div class="invalid-feedback">
                                                    {{ __('content.iframe_not_valid') }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="row row-visibility quote-options @php echo ($post->type == 'quote') ? '' : 'd-none'; @endphp">
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="quote_text" class="form-label">{{ __('content.text') }}</label>
                                            <textarea class="form-control @error('quote_text') is-invalid @enderror" name="quote_text" rows="3">{{$post->quote_text}}</textarea>
                                            @error('quote_text')
                                                <div class="invalid-feedback">
                                                    {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 255.
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-2">
                                        <div class="form-group">
                                            <label for="quote_author" class="form-label">{{ __('content.author') }}</label>
                                            <input class="form-control @error('quote_author') is-invalid @enderror" type="text" name="quote_author" value="{{$post->quote_author}}" />
                                            @error('quote_author')
                                                <div class="invalid-feedback">
                                                    {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary check-summernote">
                                {{ __('content.update') }}
                            </button>
                            <a href="{{ url('/') }}/admin/blog/posts">
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
