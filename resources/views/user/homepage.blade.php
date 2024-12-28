<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Homepage</title>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
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
                    <a href="#" class="w-16 h-16 flex items-center justify-center hover:bg-white hover:text-[#00001B] rounded-lg transition">
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
        <div class="p-14 flex-1 grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- View Books Box -->
            <div class="bg-[#4A4C6E] text-white rounded-lg p-6 flex flex-col items-center justify-center shadow-md hover:shadow-lg transition">
                <a href="{{ url('/view-books') }}" class="flex flex-col items-center justify-center">
                    <span class="text-7xl mb-4">&#128214;</span>
                    <h2 class="text-lg font-semibold">View List Books</h2>
                </a>
            </div>
            <!-- View Borrowed Books Box -->
            <div class="bg-[#4A4C6E] text-white rounded-lg p-6 flex flex-col items-center justify-center shadow-md hover:shadow-lg transition">
                <a href="{{ route('view.borrowed.books') }}" class="flex flex-col items-center justify-center">
                    <span class="text-6xl mb-4">&#128336;</span>
                    <h2 class="text-lg font-semibold">View Borrowed Books</h2>
                </a>
            </div>
        </div>

        <!-- Quote Section -->
        <div class="bg-[#4A4C6E] text-white mx-12 mb-10 p-14 rounded-lg text-center shadow-lg">
            <p class="text-lg font-light leading-relaxed">
                "A room without books is like a body without a soul."<br>
                <span class="block mt-2 font-semibold">- Marcus Tullius Cicero</span>
            </p>
        </div>
    </div>

</body>
</html>
