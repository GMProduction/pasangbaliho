<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700&display=swap" rel="stylesheet">
    <title>Document</title>
    <style>
    
    main {
        padding-top: 15px;
        padding-left: 275px;
        padding-right: 25px;
        padding-bottom: 15px;
        min-height: 550px;
    }

    @media only screen and (max-width : 959px) {
       main {
        padding-left: 25px;
        padding-top: 70px;
        padding-right: 25px;
        padding-bottom: 15px;
      }
    }

    body {
            font-family: 'Roboto Light', sans-serif !important;
        }
    </style>
</head>
<body bgcolor="#EEEEEE">
    <div id="root"></div>
    <script src="{{asset ('/js/aplikasi.js')}}"></script>
    
    
</body>
</html>