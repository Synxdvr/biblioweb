<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="flex min-h-screen bg-[#FCF1F1]">

    <!-- Left Side -->
    <div class="bg-[#FCF1F1] w-1/2 flex justify-center items-center">
        <div class="w-96 space-y-6">
            <h1 class="text-3xl font-semibold text-center mb-8">Welcome to Biblio</h1>

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <!-- Username and Full Name Side by Side -->
                <div class="flex space-x-4">
                    <div class="w-[60%]">
                        <label for="member_username" class="block text-sm font-medium text-gray-700">Username</label>
                        <input id="member_username" type="text" name="member_username" autofocus 
                            class="mt-1 p-3 w-full border border-gray-300 rounded-[30px] focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="w-[60%]">
                        <label for="member_fullname" class="block text-sm font-medium text-gray-700">Full Name</label>
                        <input id="member_fullname" type="text" name="member_fullname" 
                            class="mt-1 p-3 w-full border border-gray-300 rounded-[30px] focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Email and Address Side by Side -->
                <div class="flex space-x-4 mt-6">
                    <div class="w-[60%]">
                        <label for="contact_information" class="block text-sm font-medium text-gray-700">Email</label>
                        <input id="contact_information" type="email" name="contact_information" 
                            class="mt-1 p-3 w-full border border-gray-300 rounded-[30px] focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="w-[60%]">
                        <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                        <input id="address" type="text" name="address" 
                            class="mt-1 p-3 w-full border border-gray-300 rounded-[30px] focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

                <!-- Password and Confirm Password Side by Side -->
                <div class="flex space-x-4 mt-6">
                    <div class="w-[60%]">
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <input id="password" type="password" name="password" 
                            class="mt-1 p-3 w-full border border-gray-300 rounded-[30px] focus:ring-blue-500 focus:border-blue-500">
                    </div>
                    <div class="w-[60%]">
                        <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                        <input id="password_confirmation" type="password" name="password_confirmation" 
                            class="mt-1 p-3 w-full border border-gray-300 rounded-[30px] focus:ring-blue-500 focus:border-blue-500">
                    </div>
                </div>

            
                <!-- Submit Button -->
                <div class="mt-8 text-center">
                    <button type="submit" class="w-full bg-[#222141] text-white py-3 rounded-[30px] hover:bg-[#444]">
                        Register
                    </button>
                </div>

                <!-- Login Link -->
                <div class="mt-4 text-center">
                    <p>Already have an account? <a href="{{ route('login') }}" class="text-[#222141]">Login</a></p>
                </div>
            </form>
        </div>
    </div>

    <!-- Right Side -->
    <div class="bg-[#00001B] text-white w-1/2 flex flex-col justify-center items-center rounded-tl-[70px] rounded-bl-[70px]">
        <img src="{{ asset('images/biblio_logo.png') }}" alt="BIBLIO" class="w-40 h-40 mb-6">
        <h1 class="text-4xl font-semibold">BIBLIO</h1>
        <p class="mt-2 text-lg">Knowledge, Simplified Access</p>
    </div>

    <script src="{{ asset('js/toggle-password.js') }}"></script>

</body>
</html>
