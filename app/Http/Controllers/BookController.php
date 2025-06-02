<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use Illuminate\Support\Facades\Storage;
use Response;

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

        return Book::create($data);
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

    public function download($id)
    {
        $book = Book::findOrFail($id);

        $filePath = $book->file_path;
        $filename = str_replace(' ', '_', $book->title) . '.pdf';

        if (preg_match('/^https?:\/\//', $filePath)) {
            return redirect($filePath);
        }

        if (Storage::disk('public')->exists($filePath)) {
            $fullPath = Storage::disk('public')->path($filePath);
            return Response::download($fullPath, $filename, [
                'Content-Type' => 'application/pdf',
            ]);
        }

        abort(404, 'File tidak ditemukan');
    }
}

