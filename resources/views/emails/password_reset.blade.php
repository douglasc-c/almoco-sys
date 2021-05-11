@extends('emails.layouts.default')

@section('content')
<div class="miro__content-body" style="font-family: Helvetica,Arial,sans-serif;">
  <div class="miro-title-block" style="font-family: Helvetica,Arial,sans-serif; background: no-repeat center / 100% auto; padding: 40px 40px 36px;">
    <div class="miro-title-block__title font-size-42" style="color: #fff; font-family: Helvetica,Arial,sans-serif; font-size: 33px !important; font-stretch: normal; font-style: normal; font-weight: 700; letter-spacing: normal; line-height: 1.24;">Reset Password </div>
    <div class="miro-title-block__subtitle font-size-20 m-top-16" style="color: #fff; font-family: Helvetica,Arial,sans-serif; font-size: 20px !important; font-stretch: normal; font-style: normal; font-weight: 400; letter-spacing: normal; line-height: 1.4; margin-top: 16px; opacity: .6;">You just requested the change of your password! 
          Click on the button below, and you will be redirected to the change screen.</div>
    <a href="{{ url('password/reset/' . $token) }}" target="_blank" class="miro-btn miro-btn--cl-blue miro-btn--br-none f font-size-20 m-top-24 miro-btn--size-156x60" style="background-color: #fff; border-radius: 4px; box-sizing: border-box; color: #1272b3 !important; cursor: pointer; display: inline-block; font-family: Helvetica,Arial,sans-serif; font-size: 20px !important; font-stretch: normal; font-style: normal; font-weight: 400; height: 60px; letter-spacing: normal; line-height: 60px !important; text-align: center; text-decoration: none; white-space: nowrap; width: 156px; margin: 24px 0 0; padding: 0; border: none;"> Reset Password</a>
  </div>
  <table class="spacer" style="border-collapse: collapse; border-spacing: 0; font-family: Helvetica,Arial,sans-serif; text-align: left; vertical-align: top; width: 100%; padding: 0;">
    <tbody style="font-family: Helvetica,Arial,sans-serif;">
      <tr style="font-family: Helvetica,Arial,sans-serif; text-align: left; vertical-align: top; padding: 0;" align="left">
        <td height="12px" style="-moz-hyphens: auto; -webkit-hyphens: auto; border-collapse: collapse !important; color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-size: 12px; font-weight: 400; hyphens: auto; line-height: 12px; mso-line-height-rule: exactly; text-align: left; vertical-align: top; word-wrap: break-word; margin: 0; padding: 0;" align="left" valign="top"> </td>
      </tr>
    </tbody>
  </table>
  
  <table class="spacer" style="border-collapse: collapse; border-spacing: 0; font-family: Helvetica,Arial,sans-serif; text-align: left; vertical-align: top; width: 100%; padding: 0;">
    <tbody style="font-family: Helvetica,Arial,sans-serif;">
      <tr style="font-family: Helvetica,Arial,sans-serif; text-align: left; vertical-align: top; padding: 0;" align="left">
        <td height="44px" style="-moz-hyphens: auto; -webkit-hyphens: auto; border-collapse: collapse !important; color: #0a0a0a; font-family: Helvetica,Arial,sans-serif; font-size: 44px; font-weight: 400; hyphens: auto; line-height: 44px; mso-line-height-rule: exactly; text-align: left; vertical-align: top; word-wrap: break-word; margin: 0; padding: 0;" align="left" valign="top"> </td>
      </tr>
    </tbody>
  </table>
</div>
@endsection
