<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Access;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class BookController extends Controller
{
    // 📘 1. Получить список книг текущего пользователя
    public function index()
    {
        $books = Book::where('user_id', Auth::id())
                     ->where('deleted', false)
                     ->select('id', 'title')
                     ->get();

        return response()->json($books);
    }

    // 📗 2. Создать новую книгу
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'file' => 'nullable|file|mimes:txt',
        ]);

        $text = $request->input('content');

        if ($request->hasFile('file')) {
            $text = file_get_contents($request->file('file')->getRealPath());
        }

        $book = Book::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $text,
        ]);

        return response()->json(['message' => 'Book created', 'book' => $book], 201);
    }

    // 📕 3. Получить книгу по ID
    public function show($id)
    {
        $book = Book::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        return response()->json([
            'title' => $book->title,
            'content' => $book->content,
        ]);
    }

    // 📒 4. Обновить книгу
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $book = Book::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        $book->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return response()->json(['message' => 'Book updated']);
    }

    // 🗑️ 5. Удалить книгу (мягкое удаление)
    public function destroy($id)
    {
        $book = Book::where('id', $id)
                    ->where('user_id', Auth::id())
                    ->firstOrFail();

        $book->update(['deleted' => true]);

        return response()->json(['message' => 'Book soft-deleted']);
    }

    // 👀 6. Получить книги другого пользователя (если есть доступ)
    public function getUserBooks($userId)
    {
        $hasAccess = Access::where('owner_id', $userId)
                           ->where('user_id', Auth::id())
                           ->exists();

        if (! $hasAccess) {
            return response()->json(['message' => 'Access denied'], 403);
        }

        $books = Book::where('user_id', $userId)
                     ->where('deleted', false)
                     ->select('id', 'title')
                     ->get();

        return response()->json($books);
    }

    // 🌐 7. Поиск книг через Google Books API
    public function searchBooks(Request $request)
    {
        $request->validate(['query' => 'required|string']);

        $response = Http::get('https://www.googleapis.com/books/v1/volumes', [
            'q' => $request->query,
        ]);
    }
    // 🔍 8. Восстановление удаленной книги
    public function restore($id)
    {
    $book = Book::where('id', $id)
                ->where('user_id', Auth::id())
                ->where('deleted', true)
                ->firstOrFail();

    $book->update(['deleted' => false]);

    return response()->json(['message' => 'Book restored successfully.']);
    }

}
