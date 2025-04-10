<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;


class BookController extends Controller
{
    public function index(Request $request)
    {
    $user = $request->user();

    $accessibleUserIds = $user->accesses()->pluck('granted_user_id')->toArray();
    $accessibleUserIds[] = $user->id;

    return Book::whereIn('user_id', $accessibleUserIds)->get();
    }

    public function store(Request $request)
    {
    $validated = $request->validate([
        'title' => 'required|string|max:255',
        'author' => 'required|string|max:255',
        'description' => 'nullable|string',
        'published_date' => 'nullable|date',
    ]);

    return Book::create([
        ...$validated,
        'user_id' => $request->user()->id,
    ]);
    }


    public function show(Book $book)
    {
        return $book;
    }

    public function update(Request $request, Book $book)
    {
        $validated = $request->validate([
            'title' => 'sometimes|required|string|max:255',
            'author' => 'sometimes|required|string|max:255',
            'description' => 'nullable|string',
            'published_date' => 'nullable|date',
        ]);

        $book->update($validated);

        return $book;
    }

    public function destroy(Book $book)
    {
    if ($book->user_id !== auth()->id()) {
        return response()->json(['message' => 'Unauthorized'], 403);
    }

    $book->delete();
    return response()->json(['message' => 'Book deleted']);
    }

    public function restore($id)
    {
    $book = Book::withTrashed()->findOrFail($id);

    if (!$book->trashed()) {
        return response()->json(['message' => 'Book is not deleted.'], 400);
    }

    $book->restore();

    return response()->json(['message' => 'Book restored successfully.']);
    }
    public function trashed()
    {
    $trashedBooks = Book::onlyTrashed()->get();
    return response()->json($trashedBooks);
    }


}

