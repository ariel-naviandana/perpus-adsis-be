<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;

class BookController extends Controller
{
    public function index()
    {
        return Book::all();
    }

    public function show($id)
    {
        return Book::findOrFail($id);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'author' => 'required',
            'description' => 'nullable',
            'category' => 'required',
            'file_path' => 'required'
        ]);

        $book = Book::create([
            'title' => $data['title'],
            'author' => $data['author'],
            'description' => $data['description'],
            'category' => $data['category'],
            'file_path' => $data['file_path']
        ]);

        return response()->json($book, 201);
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->only(['title', 'author', 'description', 'category', 'file_path']);

        $book->update($data);

        return response()->json($book);
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        $book->delete();

        return response()->json(['message' => 'Book deleted']);
    }
}

