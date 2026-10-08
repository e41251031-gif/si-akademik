<!DOCTYPE html>
<html>
<head>
    <title>Login Admin</title>
</head>
<body>

    <h2>Login Admin</h2>

    <form action="/si-akademik/public/login/process" method="POST">

        <label>Username</label>
        <input type="text" name="username" required>

        <br><br>

        <label>Password</label>
        <input type="password" name="password" required>

        <br><br>

        <button type="submit">Login</button>

    </form>

</body>
</html>