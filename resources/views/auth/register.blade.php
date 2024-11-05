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
                <label for="member_username">Username:</label>
                <input id="member_username" type="text" name="member_username" autofocus>
            </div>

            <div>
                <label for="member_fullname">Full Name:</label>
                <input id="member_fullname" type="text" name="member_fullname">
            </div>
            

            <div>
                <label for="contact_information">Email:</label>
                <input id="contact_information" type="email" name="contact_information">
            </div>

            <div>
                <label for="address">Address:</label>
                <input id="address" type="text" name="address">
            </div>

            <div>
                <label for="password">Password:</label>
                <input id="password" type="password" name="password">
                <div>
                    <button type="button" id="show_password" onclick="togglePasswordVisibility()">Show Password</button>
                </div>
            </div>

            <div>
                <label for="password_confirmation">Confirm Password:</label>
                <input id="password_confirmation" type="password" name="password_confirmation">
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