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
        .quote-box {
            background-color: rgba(74, 76, 110, 0.8);
            color: white;
            border-radius: 8px;
            padding: 30px; /* Increase padding */
            max-width: 800px; /* Increase max-width */
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            font-size: 1.25rem; /* Increase font size */
            margin-bottom: 20px; /* Add margin between quotes */
        }
        .modal {
            display: none;
            position: fixed;
            z-index: 10000; /* Adjust z-index to ensure modal is on top */
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 1in auto; /* Position the modal 1 inch from the top */
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            border-radius: 8px;
            text-align: center;
            z-index: 10001; /* Ensure modal content is above the modal background */
        }
        .quotes {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            justify-content: center;
            align-items: center; /* Center align items */
            text-align: center; /* Center text */
        }
        .quote {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-bottom: 20px;
            flex: 1 1 calc(33.333% - 20px); /* Adjust width for three columns */
            box-sizing: border-box;
        }
        .quote img {
            max-width: 200px; /* Make images bigger */
            margin-bottom: 10px;
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
            <button id="logoutButton" class="w-16 h-16 flex items-center justify-center hover:bg-white hover:text-[#00001B] rounded-lg transition">
                <span class="text-3xl">&#128682;</span>
            </button>
            <span class="tooltip">Log Out</span>
        </div>
    </nav>

    <!-- Modal for Logout Confirmation -->
    <div id="logoutModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="modal-content">
            <h2 class="text-xl font-semibold mb-4">Confirm Logout</h2>
            <p>Are you sure you want to log out?</p>
            <div class="mt-4 flex justify-end space-x-4">
                <button id="cancelLogout" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Cancel</button>
                <form id="logoutForm" action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">Logout</button>
                </form>
            </div>
        </div>
    </div>

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
        <div class="p-14 flex-1">
            <!-- Quotes Section -->
            <div class="quotes">
                <div class="quote">
                    <img src="{{ asset('images/quote1.jpg') }}" alt="Quote 1">
                    <div class="quote-box">
                        <p>"It is our choices, Harry, that show what we truly are, far more than our abilities."<br><span class="block mt-2 font-semibold">- J.K. Rowling, Harry Potter and the Chamber of Secrets</span></p>
                    </div>
                </div>
                <div class="quote">
                    <img src="{{ asset('images/quote2.jpg') }}" alt="Quote 2">
                    <div class="quote-box">
                        <p>"Not all those who wander are lost."<br><span class="block mt-2 font-semibold">- J.R.R. Tolkien, The Fellowship of the Ring</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('logoutButton').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('logoutModal').classList.remove('hidden');
        });

        document.getElementById('cancelLogout').addEventListener('click', function() {
            document.getElementById('logoutModal').classList.add('hidden');
        });
    </script>

</body>
</html>
