<!DOCTYPE html>
<html>
<head>
    <title>New Email</title>
</head>
<body>
    <h3>New Message from {{ $data['name'] }}</h3>
    <p>Email: {{ $data['email'] }}</p>
    <p>Message:</p>
    <p>{{ $data['message'] }}</p>
</body>
</html>
