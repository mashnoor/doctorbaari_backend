<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Pane</title>

</head>
<body>

<h3>Send Notification</h3>
<form action="{{ route('sendnotification') }}" method="post">
    <p>Title:</p>
    <input type="text" name="title" placeholder="Type Title">
    <p>Body:</p>
    <input type="text" name="body" placeholder="Type Body">
    {!! csrf_field() !!}
    <input type="submit" value="Send Notification">

</form>
</body>
</html>
