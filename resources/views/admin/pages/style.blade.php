@extends('layouts.admin.main')

@section('content')

<div class="container-fluid">

    {{-- Include the alert file --}}
    @include('admin.modules.alert')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('content.styles') }}</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- DataTales -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="font-weight-bold text-primary m-0">{{ __('content.styles') }}</h6>
                </div>
                <div class="card-body">
                    <form action="{{ url('/').'/admin/styles' }}" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="font_head" class="form-label">{{ __('content.font_head') }}</label>
                                        <select class="form-select" name="font_head" required>
                                            @foreach ($fonts_heading as $key => $value)
                                                <option value="{{$key}}" @php echo ($style->font_head == $key) ? 'selected' : ''; @endphp>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                        <label for="font_main" class="form-label">{{ __('content.font_main') }}</label>
                                        <select class="form-select" name="font_main" required>
                                            @foreach ($fonts as $key => $value)
                                                <option value="{{$key}}" @php echo ($style->font_main == $key) ? 'selected' : ''; @endphp>{{$value}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-12 mb-3">
                                    <hr class="mt-3 mb-4 border-0">
                                    <h5 class="mt-3 mb-2 text-gray-800 fw-bold">{{ __('content.light_scheme') }}</h5>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="light_head_color" class="form-label">{{ __('content.heading') }}</label>
                                        <input type="color" class="form-control form-control-color" name="light_head_color" value="{{$style->light_head_color}}" title="Choose your color" required />
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="light_main_color" class="form-label">{{ __('content.text') }}</label>
                                        <input type="color" class="form-control form-control-color" name="light_main_color" value="{{$style->light_main_color}}" title="Choose your color" required />
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="light_back_main_color" class="form-label">{{ __('content.back_main') }}</label>
                                        <input type="color" class="form-control form-control-color" name="light_back_main_color" value="{{$style->light_back_main_color}}" title="Choose your color" required />
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="light_accent_color" class="form-label">{{ __('content.accent') }}</label>
                                        <input type="color" class="form-control form-control-color" name="light_accent_color" value="{{$style->light_accent_color}}" title="Choose your color" required />
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="light_accent_hover_color" class="form-label">{{ __('content.accent_hover') }}</label>
                                        <input type="color" class="form-control form-control-color" name="light_accent_hover_color" value="{{$style->light_accent_hover_color}}" title="Choose your color" required />
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="light_back_secondary_color" class="form-label">{{ __('content.back_sec') }}</label>
                                        <input type="color" class="form-control form-control-color" name="light_back_secondary_color" value="{{$style->light_back_secondary_color}}" title="Choose your color" required />
                                    </div>
                                </div>

                                <div class="col-12 mb-3">
                                    <hr class="mt-3 mb-4 border-0">
                                    <h5 class="mt-3 mb-2 text-gray-800 fw-bold">{{ __('content.dark_scheme') }}</h5>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="dark_head_color" class="form-label">{{ __('content.heading') }}</label>
                                        <input type="color" class="form-control form-control-color" name="dark_head_color" value="{{$style->dark_head_color}}" title="Choose your color" required />
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="dark_main_color" class="form-label">{{ __('content.text') }}</label>
                                        <input type="color" class="form-control form-control-color" name="dark_main_color" value="{{$style->dark_main_color}}" title="Choose your color" required />
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="dark_back_main_color" class="form-label">{{ __('content.back_main') }}</label>
                                        <input type="color" class="form-control form-control-color" name="dark_back_main_color" value="{{$style->dark_back_main_color}}" title="Choose your color" required />
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="dark_accent_color" class="form-label">{{ __('content.accent') }}</label>
                                        <input type="color" class="form-control form-control-color" name="dark_accent_color" value="{{$style->dark_accent_color}}" title="Choose your color" required />
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="dark_accent_hover_color" class="form-label">{{ __('content.accent_hover') }}</label>
                                        <input type="color" class="form-control form-control-color" name="dark_accent_hover_color" value="{{$style->dark_accent_hover_color}}" title="Choose your color" required />
                                    </div>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <div class="form-group">
                                        <label for="dark_back_secondary_color" class="form-label">{{ __('content.back_sec') }}</label>
                                        <input type="color" class="form-control form-control-color" name="dark_back_secondary_color" value="{{$style->dark_back_secondary_color}}" title="Choose your color" required />
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
