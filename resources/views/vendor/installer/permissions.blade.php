@extends('vendor.installer.layouts.master')

@section('title', trans('installer_messages.permissions.title'))
@section('container')
    @if (isset($permissions['errors']))
        <div class="alert alert-danger">Please fix the below error and the click  {{ trans('installer_messages.checkPermissionAgain') }}</div>
    @endif
    <ul class="list p-0 m-0">
        @foreach($permissions['permissions'] as $permission)
        <li class="item px-2 mb-3 {{ $permission['isSet'] ? 'success' : 'error' }}">
            @if ($permission['isSet'])
                <i class="fa-regular fa-circle-check"></i>
            @else
                <i class="fa-regular fa-circle-xmark"></i>
            @endif
            {{ $permission['folder'] }}<span>{{ $permission['permission'] }}</span>
        </li>
        @endforeach
    </ul>


    <div class="modal-footer d-flex justify-content-center border-0">
        @if ( ! isset($permissions['errors']))
            <a class="btn btn-primary animate" href="{{ route('LaravelInstaller::database') }}" id="permission-button">
                {{ trans('installer_messages.next') }}
            </a>
            <i class="fa-solid fa-spinner spinner-rotate hidden animate" id="permission-spinner"></i>
        @else
            <a class="btn btn-primary" href="javascript:window.location.href='';">
                {{ trans('installer_messages.checkPermissionAgain') }}
            </a>
        @endif
    </div>

@stop


@section('scripts')
    <script src="{{ asset('assets/js/jquery.min.js') }}"></script>
    <script>
        $('#permission-button').on('click', function() {
            $(this).addClass('hidden');
            setTimeout(function() {
                $('#permission-spinner').removeClass('hidden');
            }, 500);
        })
    </script>
@endsection