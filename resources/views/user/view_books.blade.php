<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Books</title>
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
        
    </style>
</head>
<body class="bg-[#FCF1F1] text-gray-800 flex h-screen overflow-hidden">

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
            <button id="logoutButton" class="w-16 h-16 flex items-center justify-center hover:bg-white hover:text-[#00001B] rounded-lg transition">
                <span class="text-3xl">&#128682;</span>
            </button>
            <span class="tooltip">Log Out</span>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col overflow-auto">

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
            <h1 class="text-2xl font-semibold mb-6">Available Books</h1>
            
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

            <!-- Search Bar -->
            <form action="{{ route('view.books') }}" method="GET" class="mb-4">
                <input type="text" name="search" value="{{ old('search', $search ?? '') }}" placeholder="Search by title, author, or genre"
                       class="border border-gray-300 p-2 rounded-lg w-full md:w-1/3 focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       pattern="[A-Za-z0-9\s]+" title="Search can only contain letters, numbers, and spaces" />
            </form>

            <!-- Books Table -->
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 p-2">Title</th>
                        <th class="border border-gray-300 p-2">Author</th>
                        <th class="border border-gray-300 p-2">ISBN</th>
                        <th class="border border-gray-300 p-2">Genre</th>
                        <th class="border border-gray-300 p-2">Publication Date</th>
                        <th class="border border-gray-300 p-2">Availability Status</th>
                        <th class="border border-gray-300 p-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($books as $book)
                        <tr>
                            <td class="border border-gray-300 p-2">{{ $book->title }}</td>
                            <td class="border border-gray-300 p-2">{{ $book->author }}</td>
                            <td class="border border-gray-300 p-2">{{ $book->ISBN }}</td>
                            <td class="border border-gray-300 p-2">{{ $book->genre }}</td>
                            <td class="border border-gray-300 p-2">{{ $book->publication_date }}</td>
                            <td class="border border-gray-300 p-2">{{ ucfirst($book->availability_status) }}</td>
                            <td class="border border-gray-300 p-2">
                                @if($book->availability_status === 'available')
                                    <!-- Borrow button -->
                                    <button onclick="showBorrowModal('{{ route('borrow.book', $book->id) }}')" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                                        Borrow
                                    </button>
                                @else
                                    <span class="text-red-500">Not Available</span>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Links -->
            <div class="mt-4">
                {{ $books->links() }}
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div id="borrowModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-xl font-semibold mb-4">Confirm Borrow</h2>
            <p>Are you sure you want to borrow this book?</p>
            <div class="mt-4 flex justify-end space-x-4">
                <button id="cancelBorrow" class="bg-gray-500 text-white px-4 py-2 rounded-lg hover:bg-gray-600">Cancel</button>
                <a id="confirmBorrow" href="#" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">Confirm</a>
            </div>
        </div>
    </div>

    <!-- Modal for Logout Confirmation -->
    <div id="logoutModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg">
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

    <script>
        function showBorrowModal(url) {
            document.getElementById('confirmBorrow').href = url;
            document.getElementById('borrowModal').classList.remove('hidden');
        }

        document.getElementById('cancelBorrow').addEventListener('click', function() {
            document.getElementById('borrowModal').classList.add('hidden');
        });

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