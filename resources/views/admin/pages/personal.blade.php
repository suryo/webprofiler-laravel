@extends('layouts.admin.main')

@section('content')

<div class="container-fluid">

    {{-- Include the alert file --}}
    @include('admin.modules.alert')

    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ __('content.personal_info') }}</h1>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <!-- DataTales -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="font-weight-bold text-primary m-0">{{ __('content.personal_info') }}</h6>
                </div>
                <div class="card-body">
                    <form class="form-visibility" action="{{ url('/').'/admin/personal' }}" method="POST" enctype="multipart/form-data" class="personal-info-form">
                        @csrf
                        @method('PUT')
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="image" class="form-label d-flex justify-content-between">
                                            {{ __('content.image') }}
                                            <span class="fw-normal fst-italic remove-image text-primary" data-target="image_profile" data-url="{{asset('/')}}"><i class="fas fa-times mr-1"></i>{{ __('content.remove_image') }}</span>
                                        </label>
                                        @php
                                            $imgPersonalUrl = ($personal->image != '') ? $personal->image : 'uploads/img/image_default.png';
                                        @endphp
                                        <div class="d-flex p-3 mb-4 bg-gray-200 justify-content-center">
                                            <img src="{{asset('/')}}/@php echo $imgPersonalUrl; @endphp" class="img-fluid img-maxsize-200 previewImage_image_profile" />
                                        </div>
                                        <input class="form-control previewImage @error('image') is-invalid @enderror" type="file" name="image_profile" value=""/>
                                        <input type="hidden" name="image_profile_current" value="{{$personal->image}}" />
                                        <div class="form-text d-flex justify-content-between">
                                            <span>{{ __('content.image_requirements') }}</span>
                                            <span>{{ __('content.image_size_recommended') }} 700x1100px</span>
                                        </div>
                                        @error('title')
                                            <div class="invalid-feedback d-none">
                                                {{ __('content.error_validation_image') }}
                                            </div>
                                        @enderror
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="title" class="form-label">{{ __('content.title') }}</label>
                                        <input class="form-control @error('title') is-invalid @enderror" type="text" name="title" value="{{$personal->title}}" required />
                                        @error('title')
                                            <div class="invalid-feedback">
                                                {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 55.
                                            </div>
                                        @enderror
                                        <div class="form-text">
                                            <span>{{ __('content.line_mark') }}</span>
                                        </div>
                                    </div>
                                    <div class="form-group mb-4">
                                        <label for="description" class="form-label">{{ __('content.description') }}</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" cols="30" rows="10">{{$personal->description}}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">
                                                {{ __('content.text_not_valid') }} {{ __('content.max_characters') }}: 255.
                                            </div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group mb-4">
                                        <label for="cv_enable" class="form-label">{{ __('content.cv_enable') }}</label>
                                        <div class="form-switch mb-4">
                                            <input class="form-check-input" type="checkbox" id="cv_enable" data-visibility="cv-options" name="cv_enable" {{ ($personal->cv_enable == 1) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="cv_enable">{{ __('content.enable') }}</label>
                                        </div>
                                    </div>
                                    <div class="row cv-options {{ ($personal->cv_enable == 0) ? 'd-none' : '' }}">
                                        <div class="form-group mb-4 cv-text-field">
                                            <label for="cv_text" class="form-label">{{ __('content.cv_text') }}</label>
                                            <input class="form-control @error('cv_text') is-invalid @enderror" type="text" name="cv_text" value="{{$personal->cv_text}}" />
                                            @error('cv_text')
                                                <div class="invalid-feedback d-none">
                                                    {{ __('content.text_not_valid') }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="form-group mb-4 cv-file-field">
                                            <label for="cvfile" class="form-label w-100">{{ __('content.cv_file') }}
                                            @if ($personal->cv_file != '')
                                                <span class="float-end fst-italic fw-normal text-success">{{ __('content.current_file') }} {{Str::substr($personal->cv_file, 23)}}</span>
                                            @endif
                                            </label>
                                            <input class="form-control" type="file" name="cvfile" value="" />
                                            <div class="form-text">{{ __('content.file_requirements') }}</div>
                                            <input type="hidden" name="cv_file_current" value="{{$personal->cv_file}}" />
                                        </div>
                                    </div>
                                    <hr class="mt-4 mb-5 border-top-0">
                                    <div class="form-group info-content mb-4">
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
                                        <input type="hidden" name="personal_info" value="{{$personal->info}}" id="personal-info" />
                                        <div class="table-elements p-4">
                                            <table class="table table-personal-info w-100" data-target="personal-info">
                                                <tbody>
                                                    @php
                                                    $info = json_decode($personal->info, true);
                                                    if(!empty($info)):
                                                        foreach($info as $key => $value){
                                                            echo '
                                                            <tr>
                                                                <td class="fw-bold">'.$value["title"].'</td>
                                                                <td>'.$value["text"].'</td>
                                                                <td class="text-right">
                                                                    <button type="button" class="btn btn-outline-danger rounded-circle deleteInfo" data-info="'.$value["title"].'" data-value="'.$value["text"].'">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>                                                            
                                                            </tr>';
                                                        }  
                                                    endif; 
                                                    @endphp
                                                </tbody>
                                            </table>
                                        </div>
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
