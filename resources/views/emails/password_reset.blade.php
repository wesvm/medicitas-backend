<!DOCTYPE html>
<html>

<head>
    <title>Password Reset</title>
</head>

<body>
    <p>Hi {{ $user->nombres }},</p>
    <p>You requested a password reset, your token reset:</p>
    <span>{{$token}}</span>
</body>

</html>