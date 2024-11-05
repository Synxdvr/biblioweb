<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Register</title>
    </head>
    <body>
        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <label for="username">Username:</label>
                <input id="username" type="text" name="username" required autofocus>
            </div>

            <div>
                <label for="fullname">Full Name:</label>
                <input id="fullname" type="text" name="fullname" required>
            </div>
            

            <div>
                <label for="email">Email:</label>
                <input id="email" type="email" name="email" required>
            </div>

            <div>
                <label for="password">Password:</label>
                <input id="password" type="password" name="password" required>
                <div>
                    <button type="button" id="show_password" onclick="togglePasswordVisibility()">Show Password</button>
                </div>
            </div>

            <div>
                <label for="password_confirmation">Confirm Password:</label>
                <input id="password_confirmation" type="password" name="password_confirmation" required>
                <div>
                    <button type="button" id="show_confirmation" onclick="toggleConfirmPasswordVisibility()">Show Confirm Password</button>
                </div>
            </div>

            <div>
                <button type="submit">Register</button>
            </div>

            <div>
                <p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
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

            function toggleConfirmPasswordVisibility() {
                var confirmPasswordInput = document.getElementById("password_confirmation");
                if (confirmPasswordInput.type === "password") {
                    confirmPasswordInput.type = "text";
                } else {
                    confirmPasswordInput.type = "password";
                }
            }
        </script>
    </body>
</html>