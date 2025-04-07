<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Получить всех пользователей (id и имя)
    public function index()
    {
        $users = User::select('id', 'name')->get();

        return response()->json($users);
    }
}
