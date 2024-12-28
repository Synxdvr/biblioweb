<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Members;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MemberController extends Controller
{
    public function index()
    {
        $members = Members::paginate(10);
        return view('admin.membersTable', compact('members'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:255|unique:members,member_username',
            'fullname' => 'required|string|max:255',
            'contact_information' => 'required|string|max:255|unique:members,contact_information',
            'address' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        Members::create([
            'member_username' => $request->username,
            'member_fullname' => $request->fullname,
            'contact_information' => $request->contact_information,
            'address' => $request->address,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.membersTable')->with('success', 'Member added successfully.');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'username' => 'required|string|max:255',
            'fullname' => 'required|string|max:255',
            'contact_information' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'password' => 'nullable|string|min:8', // Add password validation
        ]);

        $member = Members::findOrFail($id);
        $member->update([
            'member_username' => $request->username,
            'member_fullname' => $request->fullname,
            'contact_information' => $request->contact_information,
            'address' => $request->address,
            'password' => $request->password ? Hash::make($request->password) : $member->password, // Update password if provided
        ]);

        return redirect()->route('admin.membersTable')->with('success', 'Member updated successfully.');
    }

    public function destroy($id)
    {
        $member = Members::findOrFail($id);
        $member->delete();

        return redirect()->route('admin.membersTable')->with('success', 'Member deleted successfully.');
    }
}
