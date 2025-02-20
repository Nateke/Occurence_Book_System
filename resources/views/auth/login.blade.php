@php
  $customizerHidden = 'customizer-hide';
  $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Login')

@section('vendor-style')
  @vite([
    'resources/assets/vendor/libs/@form-validation/form-validation.scss'
  ])
@endsection

@section('page-style')
  @vite([
    'resources/assets/vendor/scss/pages/page-auth.scss'
  ])
@endsection

@section('vendor-script')
  @vite([
    'resources/assets/vendor/libs/@form-validation/popular.js',
    'resources/assets/vendor/libs/@form-validation/bootstrap5.js',
    'resources/assets/vendor/libs/@form-validation/auto-focus.js'
  ])
@endsection

@section('page-script')
  @vite([
    'resources/assets/js/pages-auth.js'
  ])
@endsection

@section('content')
  <div class="authentication-wrapper authentication-cover authentication-bg">
    <div class="authentication-inner row">
      <!-- /Left Text -->
      <div class="d-none d-lg-flex col-lg-7 p-0">
        <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center" style="background:#cdd2de;">
          <img src="{{ asset('images/ob_login_image.png') }}"  alt="auth-login-cover" class="img-fluid my-5 auth-illustration" data-app-light-img="ob_login_image.png" data-app-dark-img="ob_login_image.png">
{{--          <img src="{{ asset('assets/img/illustrations/auth-login-illustration-'.$configData['style'].'.png') }}" alt="auth-login-cover" class="img-fluid my-5 auth-illustration" data-app-light-img="illustrations/auth-login-illustration-light.png" data-app-dark-img="illustrations/auth-login-illustration-dark.png">--}}

          <img src="{{ asset('assets/img/illustrations/bg-shape-image-'.$configData['style'].'.png') }}" alt="auth-login-cover" class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png" data-app-dark-img="illustrations/bg-shape-image-dark.png">
{{--          <img src="{{ asset('assets/img/illustrations/bg-shape-image-'.$configData['style'].'.png') }}" alt="auth-login-cover" class="platform-bg" data-app-light-img="illustrations/bg-shape-image-light.png" data-app-dark-img="illustrations/bg-shape-image-dark.png">--}}
        </div>
      </div>
      <!-- /Left Text -->

      <!-- Login -->
      <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
        <div class="w-px-400 mx-auto">
          <!-- Logo -->
          <div class="app-brand mb-4">
            <a href="{{url('/')}}" class="app-brand-link gap-2 mx-5 px-5">
              <span class="">@include('_partials.macros',["height"=>100, "width"=>100, "withbg"=>'fill: #fff;'])</span>
{{--              <span class=""><img src="{{ asset('images/logo.png') }}" height="90px" width="115px" alt="auth-login-cover"/></span>--}}
            </a>
          </div>
          <!-- /Logo -->
          <h4 class="mb-3" style="color:#1A3258">Jambo, Welcome to <span style="color:#b9550b">{{config('variables.templateName')}}!</span> 👋</h4>
    {{-- <p class="mb-4">Please sign-in to your account and start the adventure</p> --}}
          <form method="POST" action="{{ route('login') }}">
            @csrf
            <div class="row">
              <div class="col-md-12 mb-3">
                <h6>Enter your email and password to login</h6>
              </div>
              <div class="col-md-12">
                <div class="mb-3">
                  <label class="form-label" style="color:#1A3258">Email</label>
                  <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  @error('email')
                  <span class="invalid-feedback" role="alert">
                   <strong>{{ $message }}</strong>
                  </span>
                  @enderror
                </div>
              </div>
              <div class="col-12">
                <div class="mb-4">
                  <label class="form-label" style="color:#1A3258">Password</label>
                  <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">                                            </div>

                @error('password')
                <span class="invalid-feedback" role="alert">
                                                 <strong>{{ $message }}</strong>
                                             </span>
                @enderror
              </div>
              <div class="col-12">
                <div class="mb-3">
                  <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                    <label class="form-check-label" for="remember" style="color:#1A3258">
                      {{ __('Remember Me') }}
                    </label>
                  </div>
                </div>
              </div>

              <div class="col-12">
                <div class="mb-4">
                  <button class="btn bg-blue-950 w-100 primary-color" type="submit" style="background:#1A3258; color: #f5f2f1">SIGN IN</button>

                  <div class="mb-4 mt-3">
                    @if (Route::has('password.request'))
                      <a class="btn btn-link" href="{{ route('password.request') }}">
                        {{ __('Forgot Your Password?') }}
                      </a>
                    @endif
                  </div>
                </div>
              </div>

            </div>
          </form>

        </div>
      </div>
      <!-- /Login -->
    </div>
  </div>
@endsection
