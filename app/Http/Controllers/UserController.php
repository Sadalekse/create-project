<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function index(): JsonResponse
    {
        return response()->json(
            User::select('id', 'name', 'email')->get()
        );
    }
    public function grantAccess(User $user)
    {
        if (auth()->id() === $user->id) {
            return response()->json(['message' => 'You cannot grant access to yourself.'], 403);
        }

        auth()->user()->grantedAccesses()->syncWithoutDetaching($user->id);

        return response()->json(['message' => 'Access granted successfully.']);
    }
}
