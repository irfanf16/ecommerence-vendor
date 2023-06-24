<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>401 Unauthorized</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-md-6 m-auto">
                <img src="{{ URL::to('/vendor/images/errors/401.svg') }}" class="w-100"
                    alt="401 Unauthorized">
                <a href="{{ URL::to('/vendor/login') }}" class="btn btn-primary w-50 d-block mx-auto">Please Login
                    First</a>
            </div>
        </div>
    </div>
</body>

</html>
