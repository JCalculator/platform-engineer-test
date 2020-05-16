<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>@yield('title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
                
        <link rel="stylesheet" href="/css/main.css">
        <!-- Styles -->
        <style>
            * {
                box-sizing: border-box;
            }

            html, body {
                background-color: #FFFFFF;
                color: #67676F;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }
            
            #productionsContainer {
              overflow-y: auto;
              height: 800px;
            }
        </style>
        @csrf
    </head>
    <body>
      <div class="full-height">
        <div class="container mx-auto">
            @yield('content')
        </div>
      </div>
      <script src="/js/app.js"></script>
    </body>
</html>