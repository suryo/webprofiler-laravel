@extends('vendor.installer.layouts.master')

@section('title', trans('installer_messages.requirements.title'))
@section('container')
    <ul class="list p-0 m-0">
        <li class="item px-2 mb-3 {{ $phpSupportInfo['supported'] ? 'success' : 'error' }}">
            @if ($phpSupportInfo['supported'])
                <i class="fa-regular fa-circle-check"></i>
            @else
                <i class="fa-regular fa-circle-xmark"></i>
            @endif
            PHP Version >= {{ $phpSupportInfo['minimum'] }}</li>

        @foreach($requirements['requirements'] as $extention => $enabled)
            <li class="item px-2 mb-3 {{ $enabled ? 'success' : 'error' }}">
                @if ($enabled)
                    <i class="fa-regular fa-circle-check"></i>
                @else
                    <i class="fa-regular fa-circle-xmark"></i>
                @endif
                {{ $extention }}
            </li>
        @endforeach
    </ul>

    @if ( ! isset($requirements['errors']) && $phpSupportInfo['supported'] == 'success')
        <div class="modal-footer d-flex justify-content-center border-0">
            <a class="btn btn-primary" href="{{ route('LaravelInstaller::permissions') }}">
                {{ trans('installer_messages.next') }}
            </a>
        </div>
    @endif
@stop