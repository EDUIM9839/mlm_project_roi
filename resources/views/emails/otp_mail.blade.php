<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Your OTP Code</title>
</head>
<body style="margin: 0; padding: 0; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; background-color: #f9f9f9; color: #000;">
  <table width="100%" cellpadding="0" cellspacing="0">
    <tr>
      <td align="center" style="padding: 40px 0;">
        <table width="600" cellpadding="0" cellspacing="0" style="background-color: #fff; border-radius: 12px; box-shadow: 0 0 10px rgba(0,0,0,0.08);">
          <tr>
            <td align="center" style="padding: 30px 40px; border-bottom: 1px solid #eee;">
              <img src="{{ url( Storage::url('app/logo/'). $business->logo ) }}" width="60" alt="Shield Icon" style="margin-bottom: 20px;">
              <h2 style="margin: 0; color: #000;">Your One-Time Password (OTP)</h2>
            </td>
          </tr>
          <tr>
            <td style="padding: 30px 40px; text-align: center;">
              <p style="font-size: 16px; line-height: 24px;">Please use the OTP below to complete your {{ $title }}.</p>
              <div style="margin: 30px 0;">
                <span style="font-size: 28px; font-weight: bold; letter-spacing: 5px; padding: 15px 30px; background-color: #000; color: #fff; border-radius: 10px; display: inline-block;">
                    {{ $otp }}
                </span>
              </div>
              <p style="font-size: 14px; color: #555;">This OTP is valid for the next <strong>10 minutes</strong>. Do not share it with anyone.</p>
            </td>
          </tr>
          <tr>
            <td style="padding: 20px 40px; text-align: center; font-size: 12px; color: #999; border-top: 1px solid #eee;">
              If you did not request this, please ignore this email or contact support.
              <br><br>
              &copy; {{ date('Y') }} {{ $business->business_setup }}. All rights reserved.
            </td>
          </tr>
        </table>
      </td>
    </tr>
  </table>
</body>
</html>
