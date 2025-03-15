<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('subject')</title>
    <style>
        body {
            font-family: 'Tajawal', Arial, sans-serif;
            direction: rtl;
            text-align: right;
            background-color: #f9f9f9;
            padding: 30px;
            margin: 0;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: #ffffff;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            border: 1px solid #e3e3e3;
        }

        .header {
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            color: white;
            padding: 20px;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
            border-radius: 12px 12px 0 0;
            letter-spacing: 1px;
        }

        .content {
            padding: 25px;
            font-size: 16px;
            color: #333;
            line-height: 1.8;
        }

        .footer {
            margin-top: 20px;
            font-size: 14px;
            text-align: center;
            color: #666;
            padding: 15px 0;
            border-top: 1px solid #ddd;
        }

        .btn {
            display: inline-block;
            padding: 14px 24px;
            margin-top: 20px;
            margin-bottom: 15px;
            background: linear-gradient(135deg, #0d6efd, #6610f2);
            color: white;
            text-decoration: none;
            font-size: 16px;
            border-radius: 8px;
            font-weight: bold;
            transition: 0.3s;
            text-align: center;
        }

        .btn:hover {
            background: linear-gradient(135deg, #6610f2, #0d6efd);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .footer a {
            color: #0d6efd;
            text-decoration: none;
            font-weight: bold;
        }

        .footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            {{ config('app.name') }}
        </div>

        <div class="content">
            @yield('content')
        </div>

        @yield('link')

        <div class="footer" style="margin: 10px 0; padding-top: 15px;">
            &copy; {{ date('Y') }} {{ __('All Rights Reserved') }} - <a href="{{ config('app.url') }}">{{ config('app.name') }}</a>
        </div>
    </div>
</body>

</html>
