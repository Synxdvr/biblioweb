<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowed Books</title>
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
         <a href="{{ route('profile.edit') }}" class="w-12 h-12 flex items-center justify-center hover:bg-white hover:text-[#222143] rounded-lg transition">
                <span class="text-3xl">&#128682;</span>
            </a>
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
            <h1 class="text-2xl font-semibold mb-6">Borrowed Books</h1>
            
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
                                <!-- Return button -->
                                <a href="{{ route('unborrow.book', $book->id) }}" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                                    Return
                                </a>
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
</body>
</html>