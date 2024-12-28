<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
        /* Modal Styling */
        .modal {
            display: none;
            position: fixed;
            z-index: 50;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
        }
        .modal-content {
            background-color: #fefefe;
            margin: 10% auto;
            padding: 20px;
            border: 1px solid #888;
            width: 60%;
            max-width: 500px;
            border-radius: 8px;
            position: relative;
        }
        .close {
            color: #aaa;
            position: absolute;
            right: 20px;
            top: 20px;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .modal-content p {
            margin: 0;
            position: absolute;
            top: 20px;
            left: 20px;
            font-size: 18px;
        }
        .modal-content .buttons {
            margin-top: 60px;
            text-align: right;
        }
        .modal-content .buttons button {
            margin-right: 10px;
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
                        <span class="text-3xl">&#128187;</span> <!-- Changed icon -->
                    </a>
                    <span class="tooltip">Dashboard</span>
                </div>
                <!-- Members Table -->
                <div class="group relative flex items-center justify-center">
                    <a href="{{ route('admin.membersTable') }}" class="w-16 h-16 flex items-center justify-center hover:bg-white hover:text-[#00001B] rounded-lg transition">
                        <span class="text-3xl">&#128101;</span>
                    </a>
                    <span class="tooltip">Members</span>
                </div>
                <!-- Books Table -->
                <div class="group relative flex items-center justify-center">
                    <a href="#" class="w-16 h-16 flex items-center justify-center hover:bg-white hover:text-[#00001B] rounded-lg transition">
                        <span class="text-3xl">&#128214;</span>
                    </a>
                    <span class="tooltip">Books</span>
                </div>
                <!-- Book Categories Table -->
                <div class="group relative flex items-center justify-center">
                    <a href="{{ route('admin.bookCategoriesTable') }}" class="w-16 h-16 flex items-center justify-center hover:bg-white hover:text-[#00001B] rounded-lg transition">
                        <span class="text-3xl">&#128218;</span>
                    </a>
                    <span class="tooltip">Book Categories</span>
                </div>
                <!-- Borrowing Records Table -->
                <div class="group relative flex items-center justify-center">
                    <a href="{{ route('admin.borrowingRecordsTable') }}" class="w-16 h-16 flex items-center justify-center hover:bg-white hover:text-[#00001B] rounded-lg transition">
                        <span class="text-3xl">&#128221;</span>
                    </a>
                    <span class="tooltip">Borrowing Records</span>
                </div>
            </div>
        </div>

        <!-- Log Out Icon at Bottom -->
        <div class="group relative flex items-center justify-center mb-2 mt-auto">
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" id="logoutButton" class="w-16 h-16 flex items-center justify-center hover:bg-white hover:text-[#00001B] rounded-lg transition">
                    <span class="text-3xl">&#128275;</span> <!-- Changed icon -->
                </button>
            </form>
            <span class="tooltip">Log Out</span>
        </div>
    </nav>

    <!-- Modal for Logout Confirmation -->
    <div id="logoutModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeLogoutModal()">&times;</span>
            <p>Are you sure you want to log out?</p>
            <div class="buttons">
                <button id="confirmLogoutButton" class="bg-red-500 text-white px-4 py-2 rounded">Yes</button>
                <button class="bg-gray-500 text-white px-4 py-2 rounded" onclick="closeLogoutModal()">No</button>
            </div>
        </div>
    </div>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

        <!-- Top Bar -->
        <div class="bg-[#222143] text-white px-6 py-4 flex justify-between items-center shadow-md">
            <h1 class="text-lg font-semibold">Welcome, Admin</h1>
        </div>

        <!-- Content Section -->
        <div class="p-14 flex-1 grid grid-cols-1 gap-12">
            <!-- Quotes Box -->
            <div class="bg-[#4A4C6E] text-white rounded-lg p-6 flex flex-col items-center justify-center shadow-md hover:shadow-lg transition">
                <p class="text-xl text-center mb-4">"The best way to predict the future is to create it."<br><span class="block mt-2 font-semibold">- Peter Drucker</span></p>
                <p class="text-xl text-center mb-4">"Management is doing things right; leadership is doing the right things."<br><span class="block mt-2 font-semibold">- Peter Drucker</span></p>
                <p class="text-xl text-center">"The function of leadership is to produce more leaders, not more followers."<br><span class="block mt-2 font-semibold">- Ralph Nader</span></p>
            </div>
        </div>
    </div>

    <script>
        document.getElementById('logoutButton').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('logoutModal').style.display = 'block';
        });

        document.getElementById('confirmLogoutButton').addEventListener('click', function() {
            document.querySelector('form[action="{{ route('logout') }}"]').submit();
        });

        function closeLogoutModal() {
            document.getElementById('logoutModal').style.display = 'none';
        }

        window.onclick = function(event) {
            const logoutModal = document.getElementById('logoutModal');
            if (event.target == logoutModal) {
                logoutModal.style.display = 'none';
            }
        }
    </script>

</body>
</html>