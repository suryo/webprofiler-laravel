@extends('vendor.installer.layouts.master')

@section('title', trans('installer_messages.environment.title'))
@section('container')
    <form action="{{ route('LaravelInstaller::environmentSave') }}" id="env-form" method="post" class="row">
        @csrf
        <div class="form-group col-12 col-md-6">
            <label class="control-label">Hostname</label>
            <input type="text" name="hostname" class="form-control" >
        </div>
        <div class="form-group col-12 col-md-6">
            <label class="control-label">Database</label>
            <input type="text" name="database" class="form-control">
        </div>
        <div class="form-group col-12 col-md-6">
            <label class="control-label">Username</label>
            <input type="text" name="username" class="form-control">
        </div>
        <div class="form-group col-12 col-md-6">
            <label class="control-label">Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="modal-footer d-flex justify-content-center border-0">
            <button class="btn btn-primary" onclick="checkEnv();return false">
                {{ trans('installer_messages.next') }}
            </button>
        </div>
    </form>
@stop

@section('scripts')
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/installer.min.js')}}"></script>
    <script>
        function checkEnv() {
            $.easyAjax({
                url: "{!! route('LaravelInstaller::environmentSave') !!}",
                type: "GET",
                data: $("#env-form").serialize(),
                container: "#env-form",
                messagePosition: "inline"
            });
        }
    </script>
@endsection