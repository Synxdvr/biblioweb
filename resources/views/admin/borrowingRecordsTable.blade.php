<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Borrowing Records</title>
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
        
        table {
            width: 100%;
            table-layout: fixed;
        }
        th, td {
            word-wrap: break-word;
        }
        .pagination-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 1rem;
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
                    <a href="{{ route('admin.dashboard') }}" class="w-16 h-16 flex items-center justify-center hover:bg-white hover:text-[#00001B] rounded-lg transition">
                        <span class="text-3xl">&#127968;</span>
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
                    <a href="{{ route('admin.booksTable') }}" class="w-16 h-16 flex items-center justify-center hover:bg-white hover:text-[#00001B] rounded-lg transition">
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
            <form action="/logout" method="POST">
                @csrf
                <button type="submit" class="w-16 h-16 flex items-center justify-center hover:bg-white hover:text-[#00001B] rounded-lg transition">
                    <span class="text-3xl">&#128682;</span>
                </button>
            </form>
            <span class="tooltip">Log Out</span>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="flex-1 flex flex-col ml-0 overflow-auto">

        <!-- Top Bar -->
        <div class="bg-[#222143] text-white px-6 py-4 flex justify-between items-center shadow-md">
            <h1 class="text-lg font-semibold">Borrowing Records</h1>
        </div>

        <!-- Content Section -->
        <div class="p-6 flex-1">
            <h1 class="text-2xl font-semibold mb-6">Borrowing Records</h1>
            
            <!-- Borrowing Records Table -->
            @if ($borrowingRecords->count())
                <table class="min-w-full table-auto border-collapse border border-gray-300">
                    <thead>
                        <tr class="bg-gray-100">
                            <th class="border border-gray-300 p-2">Record ID</th>
                            <th class="border border-gray-300 p-2">Book Title</th> <!-- Change to Book Title -->
                            <th class="border border-gray-300 p-2">Member Name</th>
                            <th class="border border-gray-300 p-2">Borrow Date</th>
                            <th class="border border-gray-300 p-2">Return Date</th>
                            <th class="border border-gray-300 p-2">Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($borrowingRecords as $record)
                            @if($record->status == 'borrowed')
                                <tr>
                                    <td class="border border-gray-300 p-2">{{ $record->record_id }}</td> <!-- Change to record_id -->
                                    <td class="border border-gray-300 p-2">{{ $record->book->title }}</td> <!-- Display book title -->
                                    <td class="border border-gray-300 p-2">{{ $record->member->member_fullname }}</td>
                                    <td class="border border-gray-300 p-2">{{ $record->borrow_date }}</td>
                                    <td class="border border-gray-300 p-2">{{ $record->return_date }}</td>
                                    <td class="border border-gray-300 p-2">
                                        <form action="{{ route('admin.borrowingRecords.update', $record->record_id) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            <input type="date" name="return_date" value="{{ $record->return_date ?? '' }}" required>
                                            <select name="status" required>
                                                <option value="borrowed" {{ $record->status == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                                                <option value="returned" {{ $record->status == 'returned' ? 'selected' : '' }}>Returned</option>
                                            </select>
                                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                    </tbody>
                </table>
                <div class="pagination-container">
                    {{ $borrowingRecords->links() }} <!-- Add pagination links -->
                </div>
            @else
                <p>No borrowing records found.</p>
            @endif
        </div>
    </div>

</body>
</html>
