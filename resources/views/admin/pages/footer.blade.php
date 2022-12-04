@extends('layouts.admin.main')

@section('content')

<div class="container-fluid">

    {{-- Include the alert file --}}
    @include('admin.modules.alert')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('content.footer') }}</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- DataTales -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="font-weight-bold text-primary m-0">{{ __('content.footer') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ url('/').'/admin/footer' }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">                           
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label for="top_button" class="form-label">{{ __('content.top_button') }}</label>
                                        <div class="form-switch mb-3">
                                            <input class="form-check-input" type="checkbox" name="top_button" {{ ($footer->top_button == 1) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="cv_enable">{{ __('content.enable') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label for="copyright" class="form-label">{{ __('content.copyright') }}</label>
                                        <input class="form-control @error('copyright') is-invalid @enderror" type="text" name="copyright" value="{{$footer->copyright}}" />
                                        @error('copyright')
                                            <div class="invalid-feedback">
                                                {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2">
                                    <div class="form-group">
                                        <label for="columns" class="form-label">{{ __('content.columns') }}</label>
                                        <select class="form-select select-footer-columns @error('columns') is-invalid @enderror" name="columns">
                                            <option value="0" @php echo ($footer->columns == 0) ? 'selected' : ''; @endphp>0</option>
                                            <option value="2" @php echo ($footer->columns == 2) ? 'selected' : ''; @endphp>2</option>
                                            <option value="3" @php echo ($footer->columns == 3) ? 'selected' : ''; @endphp>3</option>
                                            <option value="4" @php echo ($footer->columns == 4) ? 'selected' : ''; @endphp>4</option>
                                        </select>
                                    </div>
                                </div>
                                
                                {{-- COLUMN 1 SECTION --}}
                                <div class="col-12 mb-2 column_1_2 @php echo ($footer->columns == 0) ? 'd-none' : '' @endphp">
                                    <hr class="mt-4 mb-5 border-0">
                                    <h4 class="mt-3 mb-2 text-gray-800 fw-bold">{{ __('content.column') }} 1</h4>
                                </div>
                                <div class="col-md-6 mb-2 column_1_2 @php echo ($footer->columns == 0) ? 'd-none' : '' @endphp">
                                    <div class="form-group">
                                        <label for="column_1_subtitle" class="form-label">{{ __('content.column') }} 1 -> {{ __('content.subtitle') }}</label>
                                        <input class="form-control @error('column_1_subtitle') is-invalid @enderror" type="text" name="column_1_subtitle" value="{{$footer->column_1_subtitle}}" />
                                        @error('column_1_subtitle')
                                            <div class="invalid-feedback">
                                                {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="column_1_title" class="form-label">{{ __('content.column') }} 1 -> {{ __('content.title') }}</label>
                                        <input class="form-control @error('column_1_title') is-invalid @enderror" type="text" name="column_1_title" value="{{$footer->column_1_title}}" />
                                        @error('column_1_title')
                                            <div class="invalid-feedback">
                                                {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="column_1_social" class="form-label">{{ __('content.social_links') }}</label>
                                        <div class="form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" name="column_1_social" {{ ($footer->column_1_social == 1) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="column_1_social">{{ __('content.enable') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2 column_1_2 @php echo ($footer->columns == 0) ? 'd-none' : '' @endphp">
                                    <div class="form-group">
                                        <label for="column_1_content" class="form-label">{{ __('content.column') }} 1 -> {{ __('content.content') }}</label>
                                        <textarea class="form-control @error('column_1_content') is-invalid @enderror" name="column_1_content" rows="5">{{$footer->column_1_content}}</textarea>
                                        @error('column_1_content')
                                            <div class="invalid-feedback">
                                                {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 255.
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- COLUMN 2 SECTION --}}
                                <div class="col-12 mb-2 column_1_2 @php echo ($footer->columns == 0) ? 'd-none' : '' @endphp">
                                    <hr class="mt-4 mb-5 border-0">
                                    <h4 class="mt-3 mb-2 text-gray-800 fw-bold">{{ __('content.column') }} 2</h4>
                                </div>
                                <div class="col-md-6 mb-2 column_1_2 @php echo ($footer->columns == 0) ? 'd-none' : '' @endphp">
                                    <div class="form-group">
                                        <label for="column_2_subtitle" class="form-label">{{ __('content.column') }} 2 -> {{ __('content.subtitle') }}</label>
                                        <input class="form-control @error('column_2_subtitle') is-invalid @enderror" type="text" name="column_2_subtitle" value="{{$footer->column_2_subtitle}}" />
                                        @error('column_2_subtitle')
                                            <div class="invalid-feedback">
                                                {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="column_2_title" class="form-label">{{ __('content.column') }} 2 -> {{ __('content.title') }}</label>
                                        <input class="form-control @error('column_2_title') is-invalid @enderror" type="text" name="column_2_title" value="{{$footer->column_2_title}}" />
                                        @error('column_2_title')
                                            <div class="invalid-feedback">
                                                {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="column_2_social" class="form-label">{{ __('content.social_links') }}</label>
                                        <div class="form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" name="column_2_social" {{ ($footer->column_2_social == 1) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="column_2_social">{{ __('content.enable') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2 column_1_2 @php echo ($footer->columns == 0) ? 'd-none' : '' @endphp">
                                    <div class="form-group">
                                        <label for="column_2_content" class="form-label">{{ __('content.column') }} 2 -> {{ __('content.content') }}</label>
                                        <textarea class="form-control @error('column_2_content') is-invalid @enderror" name="column_2_content" rows="5">{{$footer->column_2_content}}</textarea>
                                        @error('column_2_content')
                                            <div class="invalid-feedback">
                                                {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 255.
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- COLUMN 3 SECTION --}}
                                <div class="col-12 mb-2 column_3 @php echo ( ($footer->columns == 0) || ($footer->columns == 2) ) ? 'd-none' : '' @endphp">
                                    <hr class="mt-4 mb-5 border-0">
                                    <h4 class="mt-3 mb-2 text-gray-800 fw-bold">{{ __('content.column') }} 3</h4>
                                </div>
                                <div class="col-md-6 mb-2 column_3 @php echo ( ($footer->columns == 0) || ($footer->columns == 2) ) ? 'd-none' : '' @endphp">
                                    <div class="form-group">
                                        <label for="column_3_subtitle" class="form-label">{{ __('content.column') }} 3 -> {{ __('content.subtitle') }}</label>
                                        <input class="form-control @error('column_3_subtitle') is-invalid @enderror" type="text" name="column_3_subtitle" value="{{$footer->column_3_subtitle}}" />
                                        @error('column_3_subtitle')
                                            <div class="invalid-feedback">
                                                {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="column_3_title" class="form-label">{{ __('content.column') }} 3 -> {{ __('content.title') }}</label>
                                        <input class="form-control @error('column_3_title') is-invalid @enderror" type="text" name="column_3_title" value="{{$footer->column_3_title}}" />
                                        @error('column_3_title')
                                            <div class="invalid-feedback">
                                                {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="column_3_social" class="form-label">{{ __('content.social_links') }}</label>
                                        <div class="form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" name="column_3_social" {{ ($footer->column_3_social == 1) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="column_3_social">{{ __('content.enable') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2 column_3 @php echo ( ($footer->columns == 0) || ($footer->columns == 2) ) ? 'd-none' : '' @endphp">
                                    <div class="form-group">
                                        <label for="column_3_content" class="form-label">{{ __('content.column') }} 3 -> {{ __('content.content') }}</label>
                                        <textarea class="form-control @error('column_3_content') is-invalid @enderror" name="column_3_content" rows="5">{{$footer->column_3_content}}</textarea>
                                        @error('column_3_content')
                                            <div class="invalid-feedback">
                                                {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 255.
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                {{-- COLUMN 4 SECTION --}}
                                <div class="col-12 mb-2 column_4 @php echo ( ($footer->columns == 0) || ($footer->columns == 2) || ($footer->columns == 3)) ? 'd-none' : '' @endphp">
                                    <hr class="mt-4 mb-5 border-0">
                                    <h4 class="mt-3 mb-2 text-gray-800 fw-bold">{{ __('content.column') }} 4</h4>
                                </div>
                                <div class="col-md-6 mb-2 column_4 @php echo ( ($footer->columns == 0) || ($footer->columns == 2) || ($footer->columns == 3)) ? 'd-none' : '' @endphp">
                                    <div class="form-group">
                                        <label for="column_4_subtitle" class="form-label">{{ __('content.column') }} 4 -> {{ __('content.subtitle') }}</label>
                                        <input class="form-control @error('column_4_subtitle') is-invalid @enderror" type="text" name="column_4_subtitle" value="{{$footer->column_4_subtitle}}" />
                                        @error('column_4_subtitle')
                                            <div class="invalid-feedback">
                                                {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="column_4_title" class="form-label">{{ __('content.column') }} 4 -> {{ __('content.title') }}</label>
                                        <input class="form-control @error('column_4_title') is-invalid @enderror" type="text" name="column_4_title" value="{{$footer->column_4_title}}" />
                                        @error('column_4_title')
                                            <div class="invalid-feedback">
                                                {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="column_4_social" class="form-label">{{ __('content.social_links') }}</label>
                                        <div class="form-switch mb-2">
                                            <input class="form-check-input" type="checkbox" name="column_4_social" {{ ($footer->column_4_social == 1) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="column_4_social">{{ __('content.enable') }}</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-2 column_4 @php echo ( ($footer->columns == 0) || ($footer->columns == 2) || ($footer->columns == 3)) ? 'd-none' : '' @endphp">
                                    <div class="form-group">
                                        <label for="column_4_content" class="form-label">{{ __('content.column') }} 4 -> {{ __('content.content') }}</label>
                                        <textarea class="form-control @error('column_4_content') is-invalid @enderror" name="column_4_content" rows="5">{{$footer->column_4_content}}</textarea>
                                        @error('column_4_content')
                                            <div class="invalid-feedback">
                                                {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 255.
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
