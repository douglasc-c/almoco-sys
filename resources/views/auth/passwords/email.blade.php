@extends('auth.layouts.default')

@section('title')
Reset Password -
@parent
@stop

@section('content')


                        <div class="header">
                            <h5>Reset Password</h5>
                        </div>

                        <form class="form mt-5" method="POST" action="{{ route('password.email') }}">
                            @csrf

                            @include('partials.flash-messages')
                            @include('partials.error-block')

                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif

                            <div class="form-group mb-1">
                                <div class="input-group">
                                    <input type="text" class="form-control  @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                        <div class="footer mt-3">
                            <button type="submit" class="btn btn-secondary btn-block">RECEIVE INSTRUCTIONS</button>
                        </div>
                        </form>
                        <span>Already have your password? <a href="{{ route('login') }}" class="link">Sign in</a></span>

@endsection
