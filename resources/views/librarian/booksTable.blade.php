<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Books Table</title>
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Sans:wght@300;400;600&display=swap" rel="stylesheet">
    @vite('resources/css/app.css')
    @vite('resources/js/LibrarianBooksTable.js')
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
            align-items: center;
            justify-content: center;
        }
        .modal-content {
            background-color: #fefefe;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 400px;
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
            font-size: 18px;
        }
        .modal-content .buttons {
            margin-top: 20px;
            text-align: right;
        }
        .modal-content .buttons button {
            margin-right: 10px;
        }
    </style>
</head>
<body class="bg-[#FCF1F1] text-gray-800 flex h-screen">

    <!-- Sidebar -->
    <nav class="sidebar w-24 bg-[#00001B] text-white flex flex-col items-center py-8 justify-between">
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
    <div class="flex-1 flex flex-col ml-0 overflow-auto">

        <!-- Top Bar -->
        <div class="navbar bg-[#222143] text-white px-6 py-4 flex justify-between items-center shadow-md">
            <h1 class="text-lg font-semibold">Books Table</h1>
        </div>

        <!-- Content Section -->
        <div class="p-6 flex-1">
            <h1 class="text-2xl font-semibold mb-6">Books</h1>
            <!-- Search Bar -->
            <form action="{{ route('librarian.booksTable') }}" method="GET" class="mb-4">
                <input type="text" name="search" placeholder="Search books" class="p-2 border border-gray-300 rounded-lg w=1/2">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Search</button>
            </form>
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

            <!-- Add Book Button -->
            <div class="mb-4">
                <button type="button" onclick="toggleModal('addBookModal')" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Add Book
                </button>
            </div>

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
                        <th class="border border-gray-300 p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($books as $book)
                        <tr>
                            <td class="border border-gray-300 p-2">{{ $book->title }}</td>
                            <td class="border border-gray-300 p-2">{{ $book->author }}</td>
                            <td class="border border-gray-300 p-2">{{ $book->ISBN }}</td>
                            <td class="border border-gray-300 p-2">{{ $book->genre }}</td>
                            <td class="border border-gray-300 p-2">{{ $book->publication_date }}</td>
                            <td class="border border-gray-300 p-2">{{ ucfirst($book->availability_status) }}</td>
                            <td class="border border-gray-300 p-2">
                                <button onclick="openEditModal({{ json_encode($book) }})" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">
                                    Edit
                                </button>
                                <button onclick="openDeleteModal({{ $book->id }})" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Pagination Controls -->
            <div class="pagination-container">
                {{ $books->links() }}
            </div>
        </div>

        <!-- Add Book Modal -->
        <div id="addBookModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="toggleModal('addBookModal')">&times;</span>
                <h2 class="text-xl font-semibold mb-4">Add Book</h2>
                <form action="{{ route('librarian.books.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="title" class="block text-gray-700">Title</label>
                        <input type="text" name="title" id="title" class="w-full p-2 border border-gray-300 rounded-lg">
                    </div>
                    <div class="mb-4">
                        <label for="author" class="block text-gray-700">Author</label>
                        <input type="text" name="author" id="author" class="w-full p-2 border border-gray-300 rounded-lg">
                    </div>
                    <div class="mb-4">
                        <label for="ISBN" class="block text-gray-700">ISBN</label>
                        <input type="text" name="ISBN" id="ISBN" class="w-full p-2 border border-gray-300 rounded-lg">
                    </div>
                    <div class="mb-4">
                        <label for="genre" class="block text-gray-700">Genre</label>
                        <input type="text" name="genre" id="genre" class="w-full p-2 border border-gray-300 rounded-lg">
                    </div>
                    <div class="mb-4">
                        <label for="publication_date" class="block text-gray-700">Publication Date</label>
                        <input type="date" name="publication_date" id="publication_date" class="w-full p-2 border border-gray-300 rounded-lg">
                    </div>
                    <div class="mb-4">
                        <label for="availability_status" class="block text-gray-700">Availability Status</label>
                        <select name="availability_status" id="availability_status" class="w-full p-2 border border-gray-300 rounded-lg">
                            <option value="available">Available</option>
                            <option value="borrowed">Borrowed</option>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2" onclick="toggleModal('addBookModal')">Cancel</button>
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Add</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Edit Book Modal -->
        <div id="editBookModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="toggleModal('editBookModal')">&times;</span>
                <h2 class="text-xl font-semibold mb-4">Edit Book</h2>
                <form id="editBookForm" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="mb-4">
                        <label for="edit_title" class="block text-gray-700">Title</label>
                        <input type="text" name="title" id="edit_title" class="w-full p-2 border border-gray-300 rounded-lg">
                    </div>
                    <div class="mb-4">
                        <label for="edit_author" class="block text-gray-700">Author</label>
                        <input type="text" name="author" id="edit_author" class="w-full p-2 border border-gray-300 rounded-lg">
                    </div>
                    <div class="mb-4">
                        <label for="edit_ISBN" class="block text-gray-700">ISBN</label>
                        <input type="text" name="ISBN" id="edit_ISBN" class="w-full p-2 border border-gray-300 rounded-lg">
                    </div>
                    <div class="mb-4">
                        <label for="edit_genre" class="block text-gray-700">Genre</label>
                        <input type="text" name="genre" id="edit_genre" class="w-full p-2 border border-gray-300 rounded-lg">
                    </div>
                    <div class="mb-4">
                        <label for="edit_publication_date" class="block text-gray-700">Publication Date</label>
                        <input type="date" name="publication_date" id="edit_publication_date" class="w-full p-2 border border-gray-300 rounded-lg">
                    </div>
                    <div class="mb-4">
                        <label for="edit_availability_status" class="block text-gray-700">Availability Status</label>
                        <select name="availability_status" id="edit_availability_status" class="w-full p-2 border border-gray-300 rounded-lg">
                            <option value="available">Available</option>
                            <option value="borrowed">Borrowed</option>
                        </select>
                    </div>
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2" onclick="toggleModal('editBookModal')">Cancel</button>
                        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-lg">Save</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Delete Book Modal -->
        <div id="deleteBookModal" class="modal">
            <div class="modal-content">
                <span class="close" onclick="toggleModal('deleteBookModal')">&times;</span>
                <h2 class="text-xl font-semibold mb-4">Delete Book</h2>
                <p class="mb-4">Are you sure you want to delete this book?</p>
                <form id="deleteBookForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-end">
                        <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2" onclick="toggleModal('deleteBookModal')">Cancel</button>
                        <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">Delete</button>
                    </div>
                </form>
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
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.toggle('hidden');
        }

        function openEditModal(book) {
            document.getElementById('edit_title').value = book.title;
            document.getElementById('edit_author').value = book.author;
            document.getElementById('edit_ISBN').value = book.ISBN;
            document.getElementById('edit_genre').value = book.genre;
            document.getElementById('edit_publication_date').value = book.publication_date;
            document.getElementById('edit_availability_status').value = book.availability_status;
            document.getElementById('editBookForm').action = `/librarian/books/${book.id}`;
            toggleModal('editBookModal');
        }

        function openDeleteModal(bookId) {
            document.getElementById('deleteBookForm').action = `/librarian/books/${bookId}`;
            toggleModal('deleteBookModal');
        }

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
    </script>
</body>
</html>
