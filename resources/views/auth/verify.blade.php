@extends('auth.layouts.default')

@section('title')
Login -
@parent
@stop

@section('content')
    <div style="">
        <div class="text-center mb-4">
            {{-- <img src="/assets/theme/images/profile_av.png" class="rounded-circle" alt="User"> --}}
            <h1 class="mt-2">{{Auth::user()->name}}</h1>
            <span class="mb-4">{{Auth::user()->email}}</span>
        </div>

        <div class="mb-5 text-center">
            <h5>{{ __('Verify Your Email Address') }}</h5>
        </div>

        @if (session('resent'))
            <div class="alert alert-success text-center" role="alert">
                {{ __('A fresh verification link has been sent to your email address.') }}
            </div>
        @endif

        <p class="text-center">
            Before proceeding, <u>please check your email</u> for a verification link.
        </p>

        <p class="text-center">
        {{ __('If you did not receive the email') }}.<br /><br />
        </p>

        <a href="{{ route('verification.resend') }}" class="btn btn-secondary btn-block">{{ __('Click here to request another') }}</a>

        <br />

        <div class="row text-center" style="justify-content: center;">
            <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="text-center mt-2"><span>Sign Out</span></a>
        </div>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
            @csrf
        </form>
    </div>

@endsection
@section('styles')

@stop
