<!-- resources/views/user/borrower.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrower Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        body {
            font-family: 'Josefin Sans', sans-serif;
        }
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
        <div class="flex flex-col space-y-10">
            <div class="group relative w-16 h-16 flex items-center justify-center">
                <img src="{{ asset('images/biblio_logo.png') }}" alt="Logo" class="w-18 h-18">
                <span class="tooltip">Biblio</span>
            </div>

            <div class="flex flex-col space-y-8 relative">
                <div class="group relative flex items-center justify-center">
                    <a href="{{ url('/home') }}" class="w-16 h-16 flex items-center justify-center hover:bg-white hover:text-[#00001B] rounded-lg transition">
                        <span class="text-3xl">&#127968;</span>
                    </a>
                    <span class="tooltip">Dashboard</span>
                </div>
                <div class="group relative flex items-center justify-center">
                    <a href="{{ url('/borrower/books') }}" class="w-16 h-16 flex items-center justify-center hover:bg-white hover:text-[#00001B] rounded-lg transition">
                        <span class="text-3xl">&#128214;</span>
                    </a>
                    <span class="tooltip">View List Books</span>
                </div>
                <div class="group relative flex items-center justify-center">
                    <a href="{{ url('/borrower/borrowed') }}" class="w-16 h-16 flex items-center justify-center hover:bg-white hover:text-[#00001B] rounded-lg transition">
                        <span class="text-3xl">&#128336;</span>
                    </a>
                    <span class="tooltip">View Borrowed Books</span>
                </div>
            </div>
        </div>

        <div class="group relative flex items-center justify-center mb-6">
            <a href="{{ route('logout') }}" class="w-16 h-16 flex items-center justify-center hover:bg-white hover:text-[#00001B] rounded-lg transition">
                <span class="text-3xl">&#128682;</span>
            </a>
            <span class="tooltip">Log Out</span>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col">

        <!-- Top Bar -->
        <div class="bg-[#222143] text-white px-6 py-4 flex justify-between items-center shadow-md">
            <h1 class="text-lg font-semibold">Welcome, {{ Auth::user()->member_username }}</h1>
            <div class="group relative flex items-center justify-center">
                <a href="#" class="w-12 h-12 flex items-center justify-center hover:bg-white hover:text-[#222143] rounded-lg transition">
                    <span class="text-2xl">&#9881;</span>
                </a>
            </div>
        </div>

        <!-- Content Section -->
        <div class="p-14 flex-1 grid grid-cols-1 md:grid-cols-2 gap-12">
            <!-- View Books Table -->
            <div class="bg-[#4A4C6E] text-white rounded-lg p-6 flex flex-col items-center justify-center shadow-md hover:shadow-lg transition">
                <h2 class="text-xl font-semibold mb-6">Available Books</h2>
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-[#222143] text-white">
                            <th class="p-2 text-left">Book Title</th>
                            <th class="p-2 text-left">Author</th>
                            <th class="p-2 text-left">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($availableBooks as $book)
                            <tr class="border-b">
                                <td class="p-2">{{ $book->title }}</td>
                                <td class="p-2">{{ $book->author }}</td>
                                <td class="p-2">
                                    <form action="{{ route('borrow.book.store') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="book_id" value="{{ $book->book_id }}">
                                        <button type="submit" class="bg-[#222143] text-white p-2 rounded-md hover:bg-[#4A4C6E] transition">Borrow</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Borrowed Books Table -->
            <div class="bg-[#4A4C6E] text-white rounded-lg p-6 flex flex-col items-center justify-center shadow-md hover:shadow-lg transition">
                <h2 class="text-xl font-semibold mb-6">Your Borrowed Books</h2>
                <table class="w-full table-auto border-collapse">
                    <thead>
                        <tr class="bg-[#222143] text-white">
                            <th class="p-2 text-left">Book Title</th>
                            <th class="p-2 text-left">Author</th>
                            <th class="p-2 text-left">Borrowed On</th>
                            <th class="p-2 text-left">Due Date</th>
                            <th class="p-2 text-left">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($borrowedBooks as $record)
                            <tr class="border-b">
                                <td class="p-2">{{ $record->book->title }}</td>
                                <td class="p-2">{{ $record->book->author }}</td>
                                <td class="p-2">{{ $record->borrow_date->format('Y-m-d') }}</td>
                                <td class="p-2">{{ $record->due_date->format('Y-m-d') }}</td>
                                <td class="p-2">{{ $record->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</body>
</html>
