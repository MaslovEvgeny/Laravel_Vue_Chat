<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function getContacts(Request $request)
    {
        return User::where('id', '!=', $request->authUserId)
            ->orderBy('id')
            ->get(['id','name', 'email']);
    }

}
