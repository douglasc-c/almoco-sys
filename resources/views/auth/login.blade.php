@extends('auth.layouts.default')

@section('title')
Login -
@parent
@stop

@section('content')
    {{-- <h4 class="text-center mb-4">Sign in your account</h4> --}}

    <form method="POST" action="{{route('login')}}" class="mt-4">
        {{ csrf_field() }}
        @include('partials.flash-messages')
		@include('partials.error-block')

		<div class="row">

			<div class="col-12 col-lg-10 mx-auto">

				<div class=" radius-15">
					<div class="row no-gutters">
						<div class="col-lg-12">
							<div class="card-body p-md-5" style="background-color: #9eade6">
							<form method="POST" action="{{route('login')}}">
								{{ csrf_field() }}
								<div class="login-separater text-center"> <span>LOGIN</span>
									<hr/>
								</div>
								<div class="form-group mt-4">
									{{-- <label>email</label> --}}
									{{-- <input type="text" class="form-control"  placeholder="Your Username" name="email" class="input-bordered" value="{{ old('username') }}"> --}}
									<input type="text" class="form-control input-login"  placeholder="Email" name="email" class="input-bordered">
								</div>
								<div class="form-group">
									{{-- <label>Password</label> --}}
									<input type="password" class="form-control input-login"  placeholder="Senha" name="password" class="input-bordered">
								</div>
								<div class="form-row">
									<div class="form-group col">
										<div class="custom-control custom-switch">
											<input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
											<label class="custom-control-label" for="customSwitch1">Remember Me</label>
										</div>
									</div>
									<div class="form-group col text-right">
										<a href="{{ route('password.request') }}"><i class='bx bxs-key mr-2'></i>Forget Password?</a>
									</div>
								</div>
								<div class="btn-group mt-3 w-100">
									<button type="submit" class="btn btn-light btn-block">Log In </button>

									</button>
								</div>
								<hr>
							</div>
							</form>
						</div>
					</div>
					<!--end row-->
				</div>
			</div>
		</div>

    </form>
@endsection