<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>{{ $data['title'] }}</title>
    <style>
        @page {
            margin: 1px;
        }

        img {
            display: block;
            width: 100%;
            margin: 0;
            padding: 0;
        }

        .page-break {
            page-break-after: always;
        }
    </style>
</head>

<body>
    <div>
        <img src="{{ $data['image_1'] }}" style="width:100%; margin:0; padding:0;">
    </div>
    <div class="page-break"></div>
    <div>
        <img src="{{ $data['image_2'] }}" style="width:100%; margin:0; padding:0;">
    </div>
</body>

</html>
