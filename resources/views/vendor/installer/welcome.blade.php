@extends('vendor.installer.layouts.master')

@section('title', trans('installer_messages.welcome.title'))
@section('container')
    <h3 class="my-2 text-center text-gray-900 fw-bold">{{ trans('installer_messages.welcome.title') }}</h3>
    <div class="modal-footer d-flex justify-content-center border-0">
        <a href="{{ route('LaravelInstaller::environment') }}" class="btn btn-primary mt-3">{{ trans('installer_messages.next') }}</a>
    </div>
@stop