@extends('layouts.admin.login')

@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-6">
            <div class="card o-hidden border-0 shadow-lg my-5 rounded-0 z-11">
                <div class="card-body p-0">
                    <div class="px-5 py-4">
                        <div class="text-center">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <h1 class="h4 text-gray-900 mb-4">
                                <img src="{{ asset('assets/admin/img/blanco_logo.png') }}" class="img-fluid d-block mb-4 mx-auto" />
                                {{ __('Reset Password') }}
                            </h1>
                        </div>
                        <form method="POST" action="{{ route('password.email') }}" class="user">
                            @csrf
                            <div class="form-group">
                                <input id="email" type="email" class="form-control form-control-user @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter Email Address..." />
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-dark btn-user btn-block css3animate">
                                {{ __('Send Password Reset Link') }}
                            </button>
                        </form>
                        <hr>
                        <div class="text-center">
                            <a class="btn btn-link text-gray-900 small css3animate" href="{{ url('/admin') }}">
                                {{ __('Back to login') }}
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
