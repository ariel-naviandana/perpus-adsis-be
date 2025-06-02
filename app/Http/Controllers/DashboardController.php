<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        return response()->json([
            'total_users' => User::count(),
            'total_books' => Book::count(),
        ]);
    }
}

