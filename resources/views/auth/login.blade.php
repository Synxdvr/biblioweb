<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
</head>
<body class="flex min-h-screen bg-[#FCF1F1]">

    <!-- Left Side -->
    <div class="bg-[#FCF1F1] w-1/2 flex justify-center items-center">
        <div class="w-96 space-y-6">
            <h1 class="text-3xl font-semibold text-center mb-8">Welcome Back to Biblio</h1>

            <form method="POST" action="{{ route('login.post') }}">
                @csrf

                <!-- Username Field -->
                <div class="mb-6">
                    <label for="username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" id="username" name="username" required autofocus 
                        class="mt-1 p-3 w-full border border-gray-300 rounded-[30px] focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Password Field -->
                <div class="mb-6">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input type="password" id="password" name="password" required
                        class="mt-1 p-3 w-full border border-gray-300 rounded-[30px] focus:ring-blue-500 focus:border-blue-500">
                </div>

                <!-- Role Dropdown (Smaller Size) -->
                <div class="mb-6">
                    <label for="role" class="block text-sm font-medium text-gray-700">Select Role</label>
                    <select id="role" name="role" class="mt-1 p-3 w-1/3.2 border border-gray-300 rounded-[30px] focus:ring-blue-500 focus:border-blue-500">
                        <option value="Admin">Admin</option>
                        <option value="Librarian">Librarian</option>
                        <option value="Borrower">Borrower</option>
                    </select>
                </div>

                <!-- Login Button -->
                <div class="mt-8 text-center">
                    <button type="submit" class="w-full bg-[#222141] text-white py-3 rounded-[30px] hover:bg-[#444]">
                        Login
                    </button>
                </div>

                <!-- Register Link -->
                <div class="mt-4 text-center">
                    <p>Don't have an account? <a href="{{ route('register') }}" class="text-[#222141]">Register</a></p>
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

</body>
</html>
