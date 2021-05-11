
@extends('emails.layouts.default')

@section('content')

			<div class="miro__content-body" style="font-family: Helvetica,Arial,sans-serif;">
      <div class="miro-title-block" style="font-family: Helvetica,Arial,sans-serif; background: no-repeat center / 100% auto; padding: 40px 40px 36px;">
        <div class="miro-title-block__title font-size-42" style="color: #fff; font-family: Helvetica,Arial,sans-serif; font-size: 32px !important; font-stretch: normal; font-style: normal; font-weight: 700; letter-spacing: normal; line-height: 1.24;">Welcome to Neeva Wallet </div>
        <div class="miro-title-block__subtitle font-size-20 m-top-16" style="color: #fff; font-family: Helvetica,Arial,sans-serif; font-size: 20px !important; font-stretch: normal; font-style: normal; font-weight: 400; letter-spacing: normal; line-height: 1.4; margin-top: 16px; opacity: .6;">You now have an account on the official Neeva wallet, where you can keep your ETH, NVA funds.</div>
        <div class="miro-title-block__subtitle font-size-20 m-top-16" style="color: #fff; font-family: Helvetica,Arial,sans-serif; font-size: 20px !important; font-stretch: normal; font-style: normal; font-weight: 400; letter-spacing: normal; line-height: 1.4; margin-top: 16px; opacity: .6;">To validate your account and be able to access all features, click the button below to confirm your email.</div>
        <a href="{{url('/')}}" target="_blank" class="miro-btn miro-btn--cl-blue miro-btn--br-none f font-size-20 m-top-24 miro-btn--size-156x60" style="background-color: #fff; border-radius: 4px; box-sizing: border-box; color: #2463a6 !important; cursor: pointer; display: inline-block; font-family: Helvetica,Arial,sans-serif; font-size: 20px !important; font-stretch: normal; font-style: normal; font-weight: 400; height: 60px; letter-spacing: normal; line-height: 60px !important; text-align: center; text-decoration: none; white-space: nowrap; width: 156px; margin: 24px 0 0; padding: 0; border: none;">Acess Wallet</a>

@endsection
