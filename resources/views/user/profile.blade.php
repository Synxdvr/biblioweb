<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile</title>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Josefin Sans', sans-serif;
        }
        /* Tooltip Styling */
        .tooltip {
            display: none;
            position: absolute;
            left: 100%;
            margin-left: 8px;
            background-color: white;
            color: #00001B;
            padding: 6px 10px;
            border-radius: 6px;
            white-space: nowrap;
            font-size: 0.875rem;
            font-weight: 600;
            box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.1);
        }
        .group:hover .tooltip {
            display: block;
        }
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
            gap: 2rem; /* Ensure gap is applied */
        }
    </style>
</head>
<body class="bg-[#FCF1F1] text-gray-800 flex h-screen">

    <!-- Sidebar -->
    <nav class="w-24 bg-[#00001B] text-white flex flex-col items-center py-8 justify-between relative">
        <!-- Top Section -->
        <div class="flex flex-col space-y-10">
            <!-- Biblio Logo -->
            <div class="group relative w-16 h-16 flex items-center justify-center">
                <img src="{{ asset('images/biblio_logo.png') }}" alt="Logo" class="w-18 h-18">
                <!-- Tooltip -->
                <span class="tooltip">Biblio</span>
            </div>

            <!-- Navigation Icons -->
            <div class="flex flex-col space-y-8 relative">
                <!-- Dashboard -->
                <div class="group relative flex items-center justify-center">
                    <a href="{{ url('/homepage') }}" class="w-16 h-16 flex items-center justify-center hover:bg-white hover:text-[#00001B] rounded-lg transition">
                        <span class="text-3xl">&#127968;</span>
                    </a>
                    <span class="tooltip">Dashboard</span>
                </div>
                <!-- View List Books -->
                <div class="group relative flex items-center justify-center">
                    <!-- Update the href to point to the 'view-books' route -->
                    <a href="{{ url('/view-books') }}" class="w-16 h-16 flex items-center justify-center hover:bg-white hover:text-[#00001B] rounded-lg transition">
                        <span class="text-3xl">&#128214;</span>
                    </a>
                    <span class="tooltip">View List Books</span>
                </div>
                <!-- View Borrowed Books -->
                <div class="group relative flex items-center justify-center">
                    <a href="{{ route('view.borrowed.books') }}" class="w-16 h-16 flex items-center justify-center hover:bg-white hover:text-[#00001B] rounded-lg transition">
                        <span class="text-3xl">&#128336;</span>
                    </a>
                    <span class="tooltip">View Borrowed Books</span>
                </div>
            </div>
        </div>

         <!-- Log Out Icon at Bottom -->
         <div class="group relative flex items-center justify-center mb-6">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="w-16 h-16 flex items-center justify-center hover:bg-white hover:text-[#00001B] rounded-lg transition">
                    <span class="text-3xl">&#128682;</span>
                </button>
            </form>
            <span class="tooltip">Log Out</span>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

        <!-- Top Bar -->
        <div class="bg-[#222143] text-white px-6 py-4 flex justify-between items-center shadow-md">
            <h1 class="text-lg font-semibold">Welcome, {{ $user->member_username }}</h1>
            <!-- Settings Icon with Hover -->
            <div class="group relative flex items-center justify-center">
            <a href="{{ route('profile.edit') }}" class="w-12 h-12 flex items-center justify-center hover:bg-white hover:text-[#222143] rounded-lg transition">
                <span class="text-2xl">&#9881;</span>
            </a>
        </div>
        </div>

        <!-- Content Section -->
        <div class="p-6 flex-1">
            <h1 class="text-2xl font-semibold mb-6">Edit Profile</h1>
            
            <!-- Display success or error message -->
            @if(session('success'))
                <div class="bg-green-500 text-white p-3 rounded mb-4">
                    {{ session('success') }}
                </div>
            @elseif(session('error'))
                <div class="bg-red-500 text-white p-3 rounded mb-4">
                    {{ session('error') }}
                </div>
            @endif

            <!-- Profile Form -->
            <form action="{{ route('profile.update') }}" method="POST" class="space-y-4">
                @csrf
                <div>
                    <label for="member_username" class="block text-sm font-medium text-gray-700">Username</label>
                    <input type="text" name="member_username" id="member_username" value="{{ old('member_username', $user->member_username) }}" required
                           class="border border-gray-300 p-2 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label for="member_fullname" class="block text-sm font-medium text-gray-700">Full Name</label>
                    <input type="text" name="member_fullname" id="member_fullname" value="{{ old('member_fullname', $user->member_fullname) }}" required
                           class="border border-gray-300 p-2 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label for="contact_information" class="block text-sm font-medium text-gray-700">Contact Information</label>
                    <input type="text" name="contact_information" id="contact_information" value="{{ old('contact_information', $user->contact_information) }}" required
                           class="border border-gray-300 p-2 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Address</label>
                    <input type="text" name="address" id="address" value="{{ old('address', $user->address) }}" required
                           class="border border-gray-300 p-2 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label for="old_password" class="block text-sm font-medium text-gray-700">Old Password</label>
                    <input type="password" name="old_password" id="old_password"
                           class="border border-gray-300 p-2 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">New Password</label>
                    <input type="password" name="password" id="password"
                           class="border border-gray-300 p-2 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm New Password</label>
                    <input type="password" name="password_confirmation" id="password_confirmation"
                           class="border border-gray-300 p-2 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-blue-500" />
                </div>
                <div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                        Update Profile
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>