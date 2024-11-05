<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
    </head>
    <body>
        <form method="POST" action="{{ route('login.post') }}">
            @csrf

            <div>
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required autofocus>
            </div>

            <div>
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
                <div>
                    <button type="button" onclick="togglePasswordVisibility()">Show Password</button>
                </div>
            </div>

            <div>
                <button type="submit">Login</button>
            </div>

            <div>
                <p>Don't have an account? <a href="{{ route('register') }}">Register</a></p>
            </div>
        </form>

        <script>
            function togglePasswordVisibility() {
                var passwordInput = document.getElementById("password");
                if (passwordInput.type === "password") {
                    passwordInput.type = "text";
                } else {
                    passwordInput.type = "password";
                }
            }
        </script>
    </body>
</html>