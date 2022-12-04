@extends('layouts.admin.main')

@section('content')

    <div class="container-fluid">

        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
        </div>

        <div class="row">

            <!-- BLOG POSTS CARD -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-primary shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                    {{ __('content.posts')}}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    @php echo count($blog) @endphp
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-comments fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- PROJECTS CARD -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-success shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                    {{ __('content.projects')}}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    @php echo count($projects) @endphp
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-briefcase fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- GENERAL SETTINGS LINK CARD -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-info shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                    {{ __('content.options')}}
                                </div>
                                <div class="row no-gutters align-items-center">
                                    <div class="col-auto">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                            <a href="{{ url('admin/general') }}">{{ __('content.general_settings')}}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-home fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- SECTIONS SETTINGS LINK CARD -->
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="card border-left-warning shadow h-100 py-2">
                    <div class="card-body">
                        <div class="row no-gutters align-items-center">
                            <div class="col mr-2">
                                <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                    {{ __('content.sections')}}
                                </div>
                                <div class="h5 mb-0 font-weight-bold text-gray-800">
                                    <a href="{{ url('admin/sections') }}">{{ __('content.enable_disable')}}</a>
                                </div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-puzzle-piece fa-2x text-gray-300"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
        
            {{-- CATEGORIES TABLE --}}
            <div class="col-lg-12 mb-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3 d-flex justify-content-between align-items-center">
                        <h6 class="font-weight-bold text-primary m-0">{{ __('content.blog') }}</h6>
                        <a href="{{ url('/') }}/admin/blog/post" class="btn btn-primary btn-round d-inline">
                            <i class="fas fa-plus small"></i>
                            {{ __('content.add_post') }}
                        </a>
                    </div>
                    <div class="card-body">
                        @if (count($blog) > 0)
                            <div class="table-responsive">
                                <table class="table table-bordered datatable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th class="custom-width" scope="col">#</th>
                                            <th>{{ __('content.title') }}</th>
                                            <th>{{ __('content.date') }}</th>
                                            <th>{{ __('content.category') }}</th>
                                            <th>{{ __('content.type') }}</th>
                                            <th class="max-w-150">{{ __('content.media') }}</th>
                                            <th>{{ __('content.status') }}</th>
                                            <th>{{ __('content.order') }}</th>
                                            <th class="custom-width-action">{{ __('content.action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php $i = 1; @endphp
                                        @foreach ($blog as $post)
                                            <tr>
                                                <td>{{ $i }}</td>
                                                <td>{{ $post->title }}</td>
                                                <td>{{ Str::replace('-', '/', $post->created_at)}}</td>
                                                <td>
                                                @foreach ($categories as $category )
                                                    @if( $post->category_id == $category->id)
                                                        {{$category->name}}
                                                    @endif
                                                @endforeach
                                                </td>
                                                <td>
                                                    @switch($post->type)
                                                        @case('standard')
                                                            <i class="far fa-image h4 text-black-25" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('content.standard') }}"></i>
                                                            @break
                                                        @case('gallery')
                                                            <i class="far fa-images h4 text-black-25" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('content.gallery') }}"></i>
                                                            @break
                                                        @case('video')
                                                            <i class="fas fa-video h4 text-black-25" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('content.video') }}"></i>
                                                            @break
                                                        @case('quote')
                                                            <i class="fas fa-quote-right h4 text-black-25" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('content.quote') }}"></i>
                                                            @break
                                                    @endswitch
                                                <td>
                                                    @if ($post->type == 'gallery')
                                                        <form class="d-inline-block w-100" action="{{url('/admin/blog/gallery')}}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            <button class="btn btn-success btn-icon-split btn-sm mb-1 justify-content-start w-100 min-w-150" data-bs-toggle="modal" data-bs-target="#addImage{{ $post->id }}">
                                                                <span class="icon text-white-50">
                                                                    <i class="fas fa-plus"></i>
                                                                </span>
                                                                <span class="text">{{ __('content.add_image') }}</span>
                                                            </button>
                                                            <div class="modal fade" id="addImage{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                                                                                        <img src="{{asset('/')}}/uploads/img/image_default.png" class="img-fluid img-maxsize-200 previewImage_gallery_image" />
                                                                                    </div>
                                                                                    <input class="form-control previewImage" type="file" name="gallery_image" required/>
                                                                                    <div class="form-text">{{ __('content.image_requirements') }}</div>
                                                                                    <input type="hidden" name="post_id" value="{{ $post->id }}"/>
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
                                                        @foreach ($gallery as $image)
                                                            @if($image['blog_id'] == $post->id)
                                                                <a href="{{ url('/') }}/admin/blog/gallery/{{ $post->id }}" class="btn btn-info btn-icon-split btn-sm justify-content-start w-100">
                                                                    <span class="icon text-white-50">
                                                                        <i class="far fa-file-image"></i>
                                                                    </span>
                                                                    <span class="text">{{ __('content.images') }}</span>
                                                                </a>
                                                                @break
                                                            @endif
                                                        @endforeach
                                                    @elseif ($post->type == 'video')
                                                        <a href="{{ $post->video }}" class="css3animate popup-content popup-video text-center text-gray-800 d-flex justify-content-between align-items-center w-100">
                                                            <p class="m-0 text-capitalize">{{ __('content.video') }}</p>
                                                            <div class="popup-content-hover css3animate">
                                                                <i class="fas fa-search-plus text-gray-100 css3animate"></i>
                                                            </div>
                                                        </a>
                                                    @elseif ($post->type == 'quote')
                                                        <div class="post-quote p-3 bg-secondary lh-sm">
                                                            <p class="fw-bold text-white mb-2">{{ $post->quote_text }}</p>
                                                            <p class="fst-italic m-0 text-white">{{ $post->quote_author }}</p>
                                                        </div>
                                                    @else
                                                        <a href="{{url('/')}}/{{ $post->image }}" class="css3animate popup-content popup-image text-center text-gray-800 d-flex justify-content-between align-items-center w-100">
                                                            <img class="img-fluid" src="{{url('/')}}/{{ $post->image }}" />
                                                            <div class="popup-content-hover css3animate">
                                                                <i class="fas fa-search-plus text-gray-100 css3animate"></i>
                                                            </div>
                                                        </a>
                                                    @endif
                                                </td>
                                                <td>
                                                    @if ($post->status == 'pending')
                                                        <i class="far fa-clock h4 text-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('content.pending') }}"></i>
                                                    @else
                                                        <i class="far fa-thumbs-up h4 text-success" data-bs-toggle="tooltip" data-bs-placement="bottom" title="{{ __('content.published') }}"></i>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        @if ($i < count($blog))
                                                            <a href="{{ url('/') }}/admin/blog/posts/order-down/{{ $post->id }}" class="btn btn-warning btn-sm mr-1">
                                                                <i class="fas fa-arrow-down"></i>
                                                            </a>
                                                        @endif
                                                        @if ($i != 1)
                                                            <a href="{{ url('/') }}/admin/blog/posts/order-up/{{ $post->id }}" class="btn btn-warning btn-sm mr-1">
                                                                <i class="fas fa-arrow-up"></i>
                                                            </a>
                                                        @endif
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <a href="{{ url('/') }}/admin/blog/post/{{ $post->id }}" class="btn btn-primary btn-sm mr-1">
                                                            <i class="fas fa-pencil-alt"></i>
                                                        </a>
                                                        <form class="d-inline-block" action="{{url('/admin/blog/post')}}/{{ $post->id }}" method="POST">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deletePost{{ $post->id }}">
                                                                <i class="far fa-trash-alt"></i>
                                                            </button>
                                                            <div class="modal fade" id="deletePost{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
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
                            {{ __('content.no_posts_created_yet') }}
                        @endif
                    </div>
                </div>
            </div>
    
        </div>


    </div>
    <!-- /.container-fluid -->

@endsection
