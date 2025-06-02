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
            'file' => 'required|mimes:pdf'
        ]);

        $filePath = $request->file('file')->store('books', 'public');

        $book = Book::create([
            'title' => $data['title'],
            'author' => $data['author'],
            'description' => $data['description'],
            'category' => $data['category'],
            'file_path' => $filePath,
        ]);

        return response()->json($book, 201);
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $data = $request->only(['title', 'author', 'description', 'category']);

        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($book->file_path);
            $filePath = $request->file('file')->store('books', 'public');
            $data['file_path'] = $filePath;
        }

        $book->update($data);

        return response()->json($book);
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);
        Storage::disk('public')->delete($book->file_path);
        $book->delete();

        return response()->json(['message' => 'Book deleted']);
    }

    public function download($id)
    {
        $book = Book::findOrFail($id);
        return response()->download(storage_path("app/public/{$book->file_path}"));
    }
}

