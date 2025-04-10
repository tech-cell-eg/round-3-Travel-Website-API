<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <title>New Article: {{ $article->title }}</title>
    <style>
        @media only screen and (max-width: 600px) {
            .inner-body {
                width: 100% !important;
            }
            .footer {
                width: 100% !important;
            }
        }

        @media only screen and (max-width: 500px) {
            .button {
                width: 100% !important;
            }
        }

        /* Base */
        body, body *:not(html):not(style):not(br):not(tr):not(code) {
            box-sizing: border-box;
            font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif;
            position: relative;
        }

        body {
            -webkit-text-size-adjust: none;
            background-color: #f8f9fa;
            color: #4a5568;
            height: 100%;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            width: 100% !important;
        }

        /* Layout */
        .wrapper {
            background-color: #f8f9fa;
            margin: 0;
            padding: 30px 0;
            width: 100%;
        }

        .content {
            margin: 0;
            padding: 0;
        }

        /* Logo */
        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            height: 75px;
        }

        /* Header */
        .header {
            padding: 25px 0;
            text-align: center;
        }

        /* Body */
        .body {
            background-color: #ffffff;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.05);
            margin: 0 auto;
            padding: 0;
            width: 570px;
        }

        .inner-body {
            background-color: #ffffff;
            border-radius: 8px;
            margin: 0 auto;
            padding: 30px;
            width: 100%;
        }

        /* Article */
        .article-title {
            color: #2d3748;
            font-size: 24px;
            font-weight: bold;
            margin-top: 0;
            margin-bottom: 15px;
            text-align: center;
        }

        .article-image {
            border-radius: 6px;
            display: block;
            margin: 15px auto;
            max-width: 100%;
            height: auto;
        }

        .article-description {
            color: #4a5568;
            font-size: 16px;
            line-height: 1.6;
            margin-top: 15px;
        }

        /* Button */
        .button-container {
            margin-top: 30px;
            margin-bottom: 15px;
            text-align: center;
        }

        .button {
            border-radius: 4px;
            color: #ffffff;
            display: inline-block;
            font-weight: bold;
            margin: 0;
            padding: 12px 24px;
            text-decoration: none;
            transition: background-color 0.2s;
        }

        .button-primary {
            background-color: #4299e1;
        }

        .button-primary:hover {
            background-color: #3182ce;
        }

        /* Footer */
        .footer {
            margin: 0 auto;
            padding: 0;
            text-align: center;
            width: 570px;
        }

        .footer p {
            color: #718096;
            font-size: 12px;
            line-height: 1.5;
            margin-top: 20px;
        }

        .social-icons {
            margin-top: 20px;
        }

        .social-icons a {
            display: inline-block;
            margin: 0 10px;
            text-decoration: none;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="content">
            <div class="logo">  
                <img src="{{ asset('logo.png') }}" alt="{{ config('app.name') }}">
            </div>
            
            <div class="body">
                <div class="inner-body">
                    <div class="header">
                        <h1 style="color: #2d3748; font-size: 28px; font-weight: bold; margin: 0;">New Article Published!</h1>
                        <p style="color: #718096; margin-top: 10px;">Stay updated with our latest content</p>
                    </div>
                    
                    <hr style="border: none; border-top: 1px solid #e2e8f0; margin: 25px 0;">
                    
                    <h2 class="article-title">{{ $article->title }}</h2>
                    
                    @if($article->image)
                        <img class="article-image" src="{{ asset($article->image) }}" alt="{{ $article->title }}">
                    @endif
                    
                    <p class="article-description">
                        {{ \Illuminate\Support\Str::limit($article->description, 200) }}
                    </p>
                    
                    {{-- <div class="button-container">
                        <a href="" class="button button-primary" target="_blank">
                            Read Full Article
                        </a>
                    </div> --}}
                </div>
            </div>
        </div>
    </div>
</body>
</html>