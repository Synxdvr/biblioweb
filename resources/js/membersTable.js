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
