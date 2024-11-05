<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Members;
use Illuminate\Http\Request;

class AdminPanel extends Controller
{
    public function membersTable()
    {
        $members = Members::all();
        return view('admin.membersTable', compact('members'));
    }
}