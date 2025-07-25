<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  @php
    $business = DB::table('business_setup')->first();
  @endphp
  <title>Your OTP | {{ env('APP_NAME') }}</title>
  <style>
    body {
      background: #f9fbfd;
      font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
      margin: 0;
      padding: 40px 0;
      color: #333333;
    }
    .container {
      max-width: 620px;
      margin: 0 auto;
      background: #ffffff;
      border-radius: 16px;
      box-shadow: 0 8px 24px rgba(0,0,0,0.08);
      overflow: hidden;
    }
    .header {
      background: linear-gradient(135deg, #2c3e50, #3498db);
      color: #ffffff;
      padding: 60px 10px 30px;
      text-align: center;
    }
    .logo-circle {
      background-color: #ffffff;
      width: 100px;
      height: 100px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 20px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
    }
    .logo-circle img {
      width: 60px;
      height: auto;
      border-radius: 50%;
    }
    .header h1 {
      margin: 0;
      font-size: 24px;
      font-weight: bold;
      color: #ffffff;
    }
    .content {
      padding: 30px 10px;
      text-align: center;
    }
    .content h1 {
      color: #3498db;
      font-size: 28px;
      margin-bottom: 20px;
    }
    .content p {
      font-size: 17px;
      line-height: 1.7;
      margin-bottom: 10px;
    }
    .otp-box {
      display: inline-block;
      background-color: #fff8e7;
      padding: 20px 40px;
      border: 2px dashed #d3a342;
      border-radius: 12px;
      font-size: 28px;
      letter-spacing: 8px;
      font-weight: bold;
      color: #2c3e50;
      margin: 30px 0;
    }
    .footer {
      text-align: center;
      font-size: 13px;
      color: #777777;
      padding: 20px;
      background: #f1f5f9;
    }
    .small-text {
      font-size: 12px;
      color: #999999;
      margin-top: 10px;
    }
  </style>
</head>
<body>

<div class="container">
  <div class="header">
    <div class="logo-circle">
      <img src="{{ url(Storage::url('app/logo/').DB::table('business_setup')->first()->logo) }}"  style="width: 120%; height: auto;" alt="Company Logo">
    </div>
    <h1>{{ $business->business_name ?? 'Your Company' }}</h1>
  </div>

  <div class="content">
    <h1>Your OTP</h1>
    <p>Hello {{ $mailData['email'] ?? 'User' }},</p>
    <p>Use the OTP below to complete your verification:</p>

    <div class="otp-box">
      {{ $mailData['otp'] ?? '000000' }}
    </div>

    <p>This OTP is valid for a limited time only. Please do not share it with anyone.</p>
  </div>

  <div class="footer">
    &copy; 2025 {{ $business->business_name ?? 'Your Company' }}. All rights reserved.
    <div class="small-text">Need help? Contact our support team anytime.</div>
  </div>
</div>

</body>
</html>
