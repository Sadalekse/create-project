<?php

namespace App\Http\Controllers;

use App\Models\Access;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LibraryAccessController extends Controller
{
    // Выдать доступ к своей библиотеке другому пользователю
    public function grantAccess(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:users,id',
        ]);

        $existing = Access::where('owner_id', Auth::id())
                          ->where('user_id', $request->user_id)
                          ->first();

        if ($existing) {
            return response()->json(['message' => 'Access already granted.'], 200);
        }

        Access::create([
            'owner_id' => Auth::id(),        // текущий пользователь
            'user_id'  => $request->user_id, // кому выдаётся доступ
        ]);

        return response()->json(['message' => 'Access granted successfully.']);
    }
}
