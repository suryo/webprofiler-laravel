@extends('vendor.installer.layouts.master')

@section('title', trans('installer_messages.final.title'))
@section('container')
    <div class="alert alert-success text-center my-3" role="alert">
        <p class="m-0">{{ session('message')['message'] }}</p>
    </div>
    <div class="modal-footer d-flex justify-content-center border-0">
        <a href="{{ url('/') }}" class="btn btn-primary">{{ trans('installer_messages.final.exit') }}</a>
    </div>
@stop