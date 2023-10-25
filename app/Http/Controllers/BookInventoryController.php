<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;

class BookInventoryController extends Controller
{
    public function index(){
        $data = Book::orderBy('title')->get();
        return response()->json(['books' => $data]);
    }
}
