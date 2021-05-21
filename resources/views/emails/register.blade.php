
@extends('emails.layouts.default')

@section('content')

			<div class="miro__content-body" style="font-family: Helvetica,Arial,sans-serif;">
      <div class="miro-title-block" style="font-family: Helvetica,Arial,sans-serif; background: no-repeat center / 100% auto; padding: 40px 40px 36px;">
        <div class="miro-title-block__title font-size-42" style="color: #fff; font-family: Helvetica,Arial,sans-serif; font-size: 32px !important; font-stretch: normal; font-style: normal; font-weight: 700; letter-spacing: normal; line-height: 1.24;">Bem vindo ao meu almoço </div>

        <div class="miro-title-block__subtitle font-size-20 m-top-16" style="color: #fff; font-family: Helvetica,Arial,sans-serif; font-size: 30px !important; font-stretch: normal; font-style: normal; font-weight: 400; letter-spacing: normal; line-height: 1.4; margin-top: 16px; opacity: .6;">Dados de acesso</div>
      <div class="miro-title-block__subtitle font-size-20 m-top-16" style="color: #fff; font-family: Helvetica,Arial,sans-serif; font-size: 20px !important; font-stretch: normal; font-style: normal; font-weight: 400; letter-spacing: normal; line-height: 1.4; margin-top: 16px; opacity: .6;">Email: {{$user->email}}</div>
      <div class="miro-title-block__subtitle font-size-20 m-top-16" style="color: #fff; font-family: Helvetica,Arial,sans-serif; font-size: 20px !important; font-stretch: normal; font-style: normal; font-weight: 400; letter-spacing: normal; line-height: 1.4; margin-top: 16px; opacity: .6;">Senha: {{$random_password}}</div>

@endsection
