@extends('auth.layouts.default')

@section('title')
Login -
@parent
@stop

@section('content')

                        <div class="header">
                            <h5>Create Password</h5>
                        </div>

                        <form class="form mt-5" method="POST" action="{{route('password.request')}}">
                            @csrf

                            @include('partials.flash-messages')
                            @include('partials.error-block')

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group mb-1">
                                <div class="input-group">
                                    <input type="text" class="form-control  @error('email') is-invalid @enderror" placeholder="Email / User Name" name="email" value="{{ old('email') }}" required>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password">
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="text" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" name="password_confirmation">
                                </div>
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        <div class="footer mt-3">
                            <button type="submit" class="btn btn-secondary btn-block">SAVE PASSWORD</button>
                        </div>
                        </form>
                        <span>Already have your password? <a href="{{ route('login') }}" class="link">Sign in</a></span>

@endsection
