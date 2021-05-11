@extends('auth.layouts.default')

@section('title')
Sign Up -
@parent
@stop

@section('content')

                        <div class="header">
                            <h5>Sign Up</h5>
                        </div>

                        <form class="form mt-5" method="POST" action="{{ route('register') }}">
                            @csrf

                            @include('partials.flash-messages')
                            @include('partials.error-block')

                            <?php
                                $reffer = (isset($_GET['reffer'])) ? $_GET['reffer'] : null;
                            ?>

                            <div class="form-group mb-1">
                                <div class="input-group">
                                    @if($reffer)
                                    <input type="text" class="form-control  @error('reffer') is-invalid @enderror" placeholder="Reffer Code" name="reffer" value="{{ $reffer }}" required readonly="">
                                    @else
                                    <input type="text" class="form-control  @error('reffer') is-invalid @enderror" placeholder="Reffer Code" name="reffer" value="{{ old('reffer') }}" required>
                                    @endif
                                </div>
                                @error('reffer')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-1">
                                <div class="input-group">
                                    <input type="text" class="form-control  @error('name') is-invalid @enderror" placeholder="Fullname" name="name" value="{{ old('name') }}" required>
                                </div>
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-1">
                                <div class="input-group">
                                    <input type="email" class="form-control  @error('email') is-invalid @enderror" placeholder="Email" name="email" value="{{ old('email') }}" required>
                                </div>
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group mb-1">
                                <div class="input-group">
                                    <input type="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password" name="password">
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" placeholder="Confirm Password" name="password_confirmation">
                                </div>
                                @error('password_confirmation')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-4">
                                <label class="c_checkbox">
                                    <input type="checkbox" required="">
                                    <span class="checkmark"></span>
                                    <span class="ml-2 font-13"> 
                                        <div class="dropdown">
                                          <button class="btn-terms btn  dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            I read and Agree to the <span style="color: #007bff;">Terms of use</span> 
                                          </button>
                                          <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a class="dropdown-item" target="_blank" href="/assets/images/pdf/terms_of_use-en.pdf">
                                                Terms of use in <img width="20px" src="/assets/images/flags/en.svg">
                                            </a>
                                            <a class="dropdown-item" target="_blank" href="/assets/images/pdf/terms_of_use-es.pdf">
                                                Terms of use in <img width="20px" src="/assets/images/flags/es.svg">
                                            </a>
                                          </div>
                                        </div>
                                    </span>
                                </label>
                            </div>

                        <div class="footer mt-3">
                            <button type="submit" class="btn btn-secondary btn-block">SIGN UP</button>
                        </div>
                        </form>
                        <span>Already have an account? <a href="{{ route('login') }}" class="link">Sign in</a></span>

@endsection
