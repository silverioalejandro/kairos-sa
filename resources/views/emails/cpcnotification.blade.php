<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CPC Notification</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            background: #f2f2f2;
            padding: 20px;
        }
        .message {
            background: #fff;
            padding: 20px;
            border: 1px solid #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="message">
            <h1>CPC Notification</h1>
            @foreach($details['message'] as $message)
                <p>{{ $message }}</p>
            @endforeach
        </div>
    </div>
</body>
</html>
