<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Oga Manager</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">

        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
			
			.footer {
				position:absolute;
				bottom:0px;
				font-weight:bold;
				font-size:14px;
				width:100%;
			}
			
			.footer p {
				padding:0px 5px;
			}
			.footer a {
				text-decoration:none;
			}
			
			.footer .pull-left {
				float:left;
			}
			
			.footer .pull-right {
				float:right;
			}
			
			.footer .copyright {
				text-align:left;
			}
		
			.footer .notice {
				text-align:right;
			}
			
			.footer img {
				width:15px;
			}
        </style>
		
   </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                <div class="title m-b-md">
                    Oga Manager Inventory System
                </div>

                <div class="links">
                    A Free & Simple Inventory Management System For Small Businesses...
                </div>
				
            </div>

			<div class="footer">
				<p class="pull-left copyright">
					&copy; <a href="//facebook.com/ayamwillz" title="William Odiomonafe">William Odiomonafe</a> (<?= date('Y'); ?>)
					- Contribute to this Project via &nbsp; &nbsp; <a href="https://github.com/superwillz/ogamanager"><img src="git_icon.png" />GitHub</a>
				</p>
				<p class="pull-right notice">NOTE: This application IS NOT for commercial purpose.</p>
			</div>

        </div>
    </body>
</html>
