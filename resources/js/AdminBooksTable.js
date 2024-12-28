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
    document.getElementById('editBookForm').action = `/admin/books/${book.id}`;
    toggleModal('editBookModal');
}

function openDeleteModal(bookId) {
    document.getElementById('deleteBookForm').action = `/admin/books/${bookId}`;
    toggleModal('deleteBookModal');
}
