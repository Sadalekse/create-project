<?php

namespace App\Http\Controllers;

use App\Models\LibraryAccess;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibraryAccessController extends Controller
{
    public function giveAccess(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $access = LibraryAccess::create([
            'owner_id' => Auth::id(),
            'viewer_id' => $request->user_id,
        ]);

        return response()->json(['message' => 'Access granted', 'data' => $access]);
    }
}
