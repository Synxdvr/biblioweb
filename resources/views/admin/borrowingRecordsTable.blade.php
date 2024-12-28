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
                    <a href="{{ route('admin.dashboard') }}" class="w-16 h-16 flex items-center justify-center hover:bg-white hover:text-[#00001B] rounded-lg transition">
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
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" id="logoutButton" class="w-16 h-16 flex items-center justify-center hover:bg-white hover:text-[#00001B] rounded-lg transition">
                    <span class="text-3xl">&#128275;</span> <!-- Changed icon -->
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
                                        <form id="update-form-{{ $record->record_id }}" action="{{ route('admin.borrowingRecords.update', $record->record_id) }}" method="POST" onsubmit="return validateForm({{ $record->record_id }})">
                                            @csrf
                                            @method('PUT')
                                            <input type="date" name="return_date" id="return_date_{{ $record->record_id }}" value="{{ $record->return_date ?? '' }}" required>
                                            <select name="status" required>
                                                <option value="borrowed" {{ $record->status == 'borrowed' ? 'selected' : '' }}>Borrowed</option>
                                                <option value="returned" {{ $record->status == 'returned' ? 'selected' : '' }}>Returned</option>
                                            </select>
                                            <button type="button" onclick="showModal({{ $record->record_id }})" class="bg-blue-500 text-white px-4 py-2 rounded">Update</button>
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

    <!-- Modal -->
    <div id="confirmationModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
            <p>Are you sure you want to update this record?</p>
            <div class="buttons">
                <button id="confirmButton" class="bg-blue-500 text-white px-4 py-2 rounded">Yes</button>
                <button class="bg-gray-500 text-white px-4 py-2 rounded" onclick="closeModal()">No</button>
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
        function validateForm(recordId) {
            const returnDate = document.getElementById(`return_date_${recordId}`).value;
            const today = new Date().toISOString().split('T')[0];
            if (returnDate < today) {
                alert('Return date cannot be in the past.');
                return false;
            }
            return true;
        }

        function showModal(recordId) {
            const modal = document.getElementById('confirmationModal');
            const confirmButton = document.getElementById('confirmButton');
            confirmButton.onclick = function() {
                document.getElementById(`update-form-${recordId}`).submit();
            };
            modal.style.display = 'block';
        }

        function closeModal() {
            const modal = document.getElementById('confirmationModal');
            modal.style.display = 'none';
        }

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
            const modal = document.getElementById('confirmationModal');
            const logoutModal = document.getElementById('logoutModal');
            if (event.target == modal) {
                modal.style.display = 'none';
            }
            if (event.target == logoutModal) {
                logoutModal.style.display = 'none';
            }
        }
    </script>

</body>
</html>
