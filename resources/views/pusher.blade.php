{{-- <!DOCTYPE html>
<html>

<head>
    <title>Pusher Test</title>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>
        // Enable pusher logging - don't include this in production
        Pusher.logToConsole = true;

        var pusher = new Pusher('15cd4bdf5592071d8d17', {
            cluster: 'ap2'
        });

        var channel = pusher.subscribe('inform-me');
        channel.bind('inform-me', function(data) {
            $('#h1').show();
            $('#h1').text(JSON.stringify(data['data']));
        });
    </script>
</head>

<body>
    <h1 id="h1" style="display: none">Congrats ---Pusher Test Is done Successfully !</h1>
    <p>
        Try publishing an event to channel <code>my-channel</code>
        with event name <code>my-event</code>.
    </p>
</body>

</html> --}}
