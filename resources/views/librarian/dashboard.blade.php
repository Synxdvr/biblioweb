<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Librarian Dashboard</title>
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
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.4);
            justify-content: center;
            align-items: center;
        }
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
            border-radius: 8px;
            text-align: center;
        }
        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }
        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
        }
        .buttons {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        /* Carousel Styling */
        .carousel {
            position: relative;
            width: 100%;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .carousel-inner {
            display: flex;
            transition: transform 0.5s ease;
            width: 100%;
        }
        .carousel-item {
            min-width: 100%;
            box-sizing: border-box;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: center;
        }
        .quote-box {
            background-color: rgba(74, 76, 110, 0.8);
            color: white;
            border-radius: 8px;
            padding: 20px;
            max-width: 600px;
            text-align: center;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .carousel-controls {
            position: absolute;
            top: 50%;
            width: 100%;
            display: flex;
            justify-content: space-between;
            transform: translateY(-50%);
        }
        .carousel-control {
            background-color: rgba(0, 0, 0, 0.5);
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 50%;
            width: 40px;
            height: 40px;
            display: flex;
            justify-content: center;
            align-items: center;
            transition: background-color 0.3s ease;
            visibility: hidden; /* Make the arrow buttons invisible */
        }
        .carousel-control:hover {
            background-color: rgba(0, 0, 0, 0.8);
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
                    <a href="{{ route('librarian.dashboard') }}" class="w-16 h-16 flex items-center justify-center hover:bg-white hover:text-[#00001B] rounded-lg transition">
                        <span class="text-3xl">&#128187;</span>
                    </a>
                    <span class="tooltip">Dashboard</span>
                </div>
                <!-- Books Table -->
                <div class="group relative flex items-center justify-center">
                    <a href="{{ route('librarian.booksTable') }}" class="w-16 h-16 flex items-center justify-center hover:bg-white hover:text-[#00001B] rounded-lg transition">
                        <span class="text-3xl">&#128214;</span>
                    </a>
                    <span class="tooltip">Books</span>
                </div>
                <!-- Book Categories Table -->
                <div class="group relative flex items-center justify-center">
                    <a href="{{ route('librarian.bookCategoriesTable') }}" class="w-16 h-16 flex items-center justify-center hover:bg-white hover:text-[#00001B] rounded-lg transition">
                        <span class="text-3xl">&#128218;</span>
                    </a>
                    <span class="tooltip">Book Categories</span>
                </div>
                <!-- Borrowing Records Table -->
                <div class="group relative flex items-center justify-center">
                    <a href="{{ route('librarian.borrowingRecordsTable') }}" class="w-16 h-16 flex items-center justify-center hover:bg-white hover:text-[#00001B] rounded-lg transition">
                        <span class="text-3xl">&#128221;</span>
                    </a>
                    <span class="tooltip">Borrowing Records</span>
                </div>
            </div>
        </div>

        <!-- Log Out Icon at Bottom -->
        <div class="group relative flex items-center justify-center mb-2 mt-auto">
            <form action="/logout" method="POST">
                @csrf
                <button type="button" id="logoutButton" class="w-16 h-16 flex items-center justify-center hover:bg-white hover:text-[#00001B] rounded-lg transition">
                    <span class="text-3xl">&#128275;</span>
                </button>
            </form>
            <span class="tooltip">Log Out</span>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

        <!-- Top Bar -->
        <div class="bg-[#222143] text-white px-6 py-4 flex justify-between items-center shadow-md">
            <h1 class="text-lg font-semibold">Welcome, Librarian</h1>
        </div>

        <!-- Content Section -->
        <div class="p-14 flex-1 grid grid-cols-1 gap-12">
            <!-- Quotes Carousel -->
            <div class="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item" style="background-image: url('{{ asset('images/quote1.jpg') }}');">
                        <div class="quote-box">
                            <p class="text-xl mb-4">"It is our choices, Harry, that show what we truly are, far more than our abilities."<br><span class="block mt-2 font-semibold">- J.K. Rowling, Harry Potter and the Chamber of Secrets</span></p>
                        </div>
                    </div>
                    <div class="carousel-item" style="background-image: url('{{ asset('images/quote2.jpg') }}');">
                        <div class="quote-box">
                            <p class="text-xl mb-4">"Not all those who wander are lost."<br><span class="block mt-2 font-semibold">- J.R.R. Tolkien, The Fellowship of the Ring</span></p>
                        </div>
                    </div>
                    <div class="carousel-item" style="background-image: url('{{ asset('images/qoute3.jpg') }}');">
                        <div class="quote-box">
                            <p class="text-xl">"The only limit to our realization of tomorrow is our doubts of today."<br><span class="block mt-2 font-semibold">- Franklin D. Roosevelt</span></p>
                        </div>
                    </div>
                </div>
                <div class="carousel-controls">
                    <button class="carousel-control" onclick="prevSlide()">&#10094;</button>
                    <button class="carousel-control" onclick="nextSlide()">&#10095;</button>
                </div>
            </div>
        </div>
    </div>

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

    <script>
        document.getElementById('logoutButton').addEventListener('click', function(event) {
            event.preventDefault();
            document.getElementById('logoutModal').style.display = 'flex';
        });

        document.getElementById('confirmLogoutButton').addEventListener('click', function() {
            document.querySelector('form[action="/logout"]').submit();
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

        let currentSlide = 0;

        function showSlide(index) {
            const slides = document.querySelectorAll('.carousel-item');
            if (index >= slides.length) {
                currentSlide = 0;
            } else if (index < 0) {
                currentSlide = slides.length - 1;
            } else {
                currentSlide = index;
            }
            const offset = -currentSlide * 100;
            document.querySelector('.carousel-inner').style.transform = `translateX(${offset}%)`;
        }

        function nextSlide() {
            showSlide(currentSlide + 1);
        }

        function prevSlide() {
            showSlide(currentSlide - 1);
        }

        // Auto-slide every 5 seconds
        setInterval(nextSlide, 5000);
    </script>

</body>
</html>