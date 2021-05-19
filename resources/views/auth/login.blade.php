@extends('auth.layouts.default')

@section('title')
Login -
@parent
@stop

@section('content')
    {{-- <h4 class="text-center mb-4">Login</h4> --}}

    <form method="POST" action="{{route('login')}}" class="mt-4">
        {{ csrf_field() }}
        @include('partials.flash-messages')
		@include('partials.error-block')

		<div class="row">
			<div class="col-12 col-lg-12 mx-auto">
				<div class="auth-logo-bloc">
					<!-- <img src="assets/admin-theme/images/global/header-logo.svg"> -->
					<img class="main-logo-pt-1 animated rotateIn" src="assets/admin-theme/images/global/main-logo-pt-1.png">
					<img class="main-logo-pt-2" src="assets/admin-theme/images/global/main-logo-pt-2.png">
				</div>
				<div class="radius-15">
					<div class="row no-gutters">
						<div class="col-lg-12">
							<div class="card-body p-md-5 auth-card">
								<form method="POST" action="{{route('login')}}">
									{{ csrf_field() }}
									<h5 class="auth-card-title">Insira seus dados</h5>
									<img src="">
									<div class="form-row">
										<div class="col-lg-12 auth-bloc">
											<label class="auth-label-bloc">
												<i class="auth-label-icon fas fa-user"></i>
												<input type="text" class="auth-form-control"  placeholder="E-mail" name="email" class="">
											</label>
										</div>
										<div class="col-lg-12 auth-bloc">
											<label class="auth-label-bloc">
												<i class="fas fa-lock auth-label-icon"></i>
												<input type="password" class="auth-form-control"  placeholder="Senha" name="password" class="input-bordered">
											</label>
										</div>
									</div>
									<div class="form-row">
	<!-- 									<div class="form-group col">
											<div class="custom-control custom-switch">
												<input type="checkbox" class="custom-control-input" id="customSwitch1" checked>
												<label class="custom-control-label" for="customSwitch1">Remember Me</label>
											</div>
										</div> -->
									</div>
									<div class="form-row form-row-btn">
										<div class="col-lg-12 auth-btn-custom-bloc">
											<button type="submit">
												<a onclick="this.closest('form').submit();return false;" class="auth-btn-custom">
												  <svg width="277" height="45">
												    <defs>
												        <linearGradient id="grad1">
												            <stop offset="0%" stop-color="#BBC7EF"/>
												            <stop offset="100%" stop-color="#BBC7EF" />
												        </linearGradient>
												    </defs>
												     <rect x="5" y="5" rx="10" fill="none" stroke="url(#grad1)" width="230" height="35"></rect>
												  </svg>
												    <span>Acessar</span>
												</a>
											</button>
										</div>
									</div>
									<div class="form-row text-center">
										<div class="col-12">
											<a class="auth-a-forget" href="{{ route('password.request') }}">Esqueci minha senha</a>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

    </form>
@endsection