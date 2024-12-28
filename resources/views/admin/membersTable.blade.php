<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members Table</title>
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
            <h1 class="text-lg font-semibold">Members Table</h1>
        </div>

        <!-- Content Section -->
        <div class="p-6 flex-1">
            <h1 class="text-2xl font-semibold mb-6">Members</h1>
            
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

            <!-- Add Member Button -->
            <div class="mb-4">
                <button type="button" onclick="toggleModal('addMemberModal')" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600">
                    Add Member
                </button>
            </div>

            <!-- Members Table -->
            <table class="min-w-full table-auto border-collapse border border-gray-300">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="border border-gray-300 p-2">ID</th>
                        <th class="border border-gray-300 p-2">Username</th>
                        <th class="border border-gray-300 p-2">Full Name</th>
                        <th class="border border-gray-300 p-2">Contact Information</th>
                        <th class="border border-gray-300 p-2">Address</th>
                        <th class="border border-gray-300 p-2">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($members as $member)
                        <tr>
                            <td class="border border-gray-300 p-2">{{ $member->member_id }}</td>
                            <td class="border border-gray-300 p-2">{{ $member->member_username }}</td>
                            <td class="border border-gray-300 p-2">{{ $member->member_fullname }}</td>
                            <td class="border border-gray-300 p-2">{{ $member->contact_information }}</td>
                            <td class="border border-gray-300 p-2">{{ $member->address }}</td>
                            <td class="border border-gray-300 p-2">
                                <button onclick="openEditModal({{ json_encode($member) }})" class="bg-yellow-500 text-white px-4 py-2 rounded-lg hover:bg-yellow-600">
                                    Edit
                                </button>
                                <button onclick="openDeleteModal({{ $member->member_id }})" class="bg-red-500 text-white px-4 py-2 rounded-lg hover:bg-red-600">
                                    Delete
                                </button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

            <!-- Add and Edit Members Section -->
            <div class="mt-6">
                <h2 class="text-xl font-semibold mb-4">Add and Edit Members</h2>
                <p class="text-gray-700">You can add new members by clicking the "Add Member" button above. To edit an existing member, click the "Edit" button next to the member's details in the table.</p>
            </div>

           <!-- Pagination Controls -->
          <div class="pagination-container">
                {{ $members->links() }}
            </div>
        </div>
    </div>

    <!-- Add Member Modal -->
    <div id="addMemberModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-xl font-semibold mb-4">Add Member</h2>
            <form action="{{ route('admin.members.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="username" class="block text-gray-700">Username</label>
                    <input type="text" name="username" id="username" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <div class="mb-4">
                    <label for="fullname" class="block text-gray-700">Full Name</label>
                    <input type="text" name="fullname" id="fullname" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <div class="mb-4">
                    <label for="contact_information" class="block text-gray-700">Contact Information</label>
                    <input type="text" name="contact_information" id="contact_information" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <div class="mb-4">
                    <label for="address" class="block text-gray-700">Address</label>
                    <input type="text" name="address" id="address" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <div class="mb-4">
                    <label for="password" class="block text-gray-700">Password</label>
                    <input type="password" name="password" id="password" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2" onclick="toggleModal('addMemberModal')">Cancel</button>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Add</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Edit Member Modal -->
    <div id="editMemberModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-xl font-semibold mb-4">Edit Member</h2>
            <form id="editMemberForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="edit_username" class="block text-gray-700">Username</label>
                    <input type="text" name="username" id="edit_username" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <div class="mb-4">
                    <label for="edit_fullname" class="block text-gray-700">Full Name</label>
                    <input type="text" name="fullname" id="edit_fullname" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <div class="mb-4">
                    <label for="edit_contact_information" class="block text-gray-700">Contact Information</label>
                    <input type="text" name="contact_information" id="edit_contact_information" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <div class="mb-4">
                    <label for="edit_address" class="block text-gray-700">Address</label>
                    <input type="text" name="address" id="edit_address" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <div class="mb-4">
                    <label for="edit_password" class="block text-gray-700">Password</label>
                    <input type="password" name="password" id="edit_password" class="w-full p-2 border border-gray-300 rounded-lg">
                </div>
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2" onclick="toggleModal('editMemberModal')">Cancel</button>
                    <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded-lg">Save</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Delete Member Modal -->
    <div id="deleteMemberModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden">
        <div class="bg-white p-6 rounded-lg shadow-lg w-1/3">
            <h2 class="text-xl font-semibold mb-4">Delete Member</h2>
            <p class="mb-4">Are you sure you want to delete this member?</p>
            <form id="deleteMemberForm" method="POST">
                @csrf
                @method('DELETE')
                <div class="flex justify-end">
                    <button type="button" class="bg-gray-500 text-white px-4 py-2 rounded-lg mr-2" onclick="toggleModal('deleteMemberModal')">Cancel</button>
                    <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded-lg">Delete</button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function toggleModal(modalId) {
            const modal = document.getElementById(modalId);
            modal.classList.toggle('hidden');
        }

        function openEditModal(member) {
            document.getElementById('edit_username').value = member.member_username;
            document.getElementById('edit_fullname').value = member.member_fullname;
            document.getElementById('edit_contact_information').value = member.contact_information;
            document.getElementById('edit_address').value = member.address;
            document.getElementById('editMemberForm').action = `/admin/members/${member.member_id}`;
            toggleModal('editMemberModal');
        }

        function openDeleteModal(memberId) {
            document.getElementById('deleteMemberForm').action = `/admin/members/${memberId}`;
            toggleModal('deleteMemberModal');
        }
    </script>
</body>
</html>