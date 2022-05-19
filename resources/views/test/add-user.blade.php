<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Add User</title>
</head>
<body>
    <form action="{{ route('eloquent.add.user') }}" method="POST">
        @csrf
        <label for="">Username</label>
        <input type="text" name="username">
        <br>
        <label for="">Password</label>
        <input type="password" name="password">
        <br>
        <label for="">Email</label>
        <input type="email" name="email">
        <br>
        <label for="">Phone</label>
        <input type="text" name="phone">
        <br>
        <label for="">Fullname</label>
        <input type="text" name="fullname">
        <br>
        <label for="">Address</label>
        <input type="text" name="address">
        <br>
        <label for="">Birthday</label>
        <input type="date" name="birthday">
        <br>
        <button type="submit" name="btnAdd">Submit</button>
    </form>
</body>
</html>