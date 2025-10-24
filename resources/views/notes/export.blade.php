<!DOCTYPE html>
<html>
<head>
    <title>{{ $note->title }}</title>
    <style>
        body { font-family: sans-serif; }
        h1 { font-size: 24px; }
        p { font-size: 14px; line-height: 1.5; }
    </style>
</head>
<body>
    <h1>{{ $note->title }}</h1>
    <div>
        {!! $htmlContent !!}
    </div>
</body>
</html>